<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResearchTitleRequest;
use App\Http\Requests\UpdateResearchTitleRequest;
use App\Models\Category;
use App\Models\ResearchTitle;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResearchTitleController extends Controller
{
    public function index(Request $request)
    {
        $query = ResearchTitle::whereNull('deleted_at')->with('category');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('author_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $researchTitles = $query->paginate(10);
        $categories = Category::all();

        return view('research_titles.index', compact('researchTitles', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('research_titles.create', compact('categories'));
    }

    public function store(StoreResearchTitleRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('research_photos', 'public');
        }

        ResearchTitle::create($data);

        return redirect()->route('research_titles.index')->with('success', 'Research title created successfully.');
    }

    public function show(ResearchTitle $researchTitle)
    {
        return view('research_titles.show', compact('researchTitle'));
    }

    public function edit(ResearchTitle $researchTitle)
    {
        $categories = Category::all();
        return view('research_titles.edit', compact('researchTitle', 'categories'));
    }

    public function update(UpdateResearchTitleRequest $request, ResearchTitle $researchTitle)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($researchTitle->photo) {
                Storage::disk('public')->delete($researchTitle->photo);
            }
            $data['photo'] = $request->file('photo')->store('research_photos', 'public');
        }

        $researchTitle->update($data);

        return redirect()->route('research_titles.index')->with('success', 'Research title updated successfully.');
    }

    public function destroy(ResearchTitle $researchTitle)
    {
        $researchTitle->delete(); // Soft delete
        return redirect()->route('research_titles.index')->with('success', 'Research title moved to trash.');
    }

    public function trash(Request $request)
    {
        $query = ResearchTitle::onlyTrashed()->with('category');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('author_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $researchTitles = $query->paginate(10);
        $categories = Category::all();

        return view('research_titles.trash', compact('researchTitles', 'categories'));
    }

    public function restore($id)
    {
        $researchTitle = ResearchTitle::withTrashed()->findOrFail($id);
        $researchTitle->restore(); // Restore from trash

        return redirect()->route('research_titles.trash')->with('success', 'Research title restored successfully.');
    }

    public function forceDelete($id)
    {
        $researchTitle = ResearchTitle::withTrashed()->findOrFail($id);
        
        if ($researchTitle->photo) {
            Storage::disk('public')->delete($researchTitle->photo);
        }
        
        $researchTitle->forceDelete(); // Permanent delete

        return redirect()->route('research_titles.trash')->with('success', 'Research title permanently deleted.');
    }

    public function export(Request $request)
    {
        $query = ResearchTitle::whereNull('deleted_at')->with('category');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('author_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        // Apply category filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $researchTitles = $query->get();
        $totalCount = ResearchTitle::whereNull('deleted_at')->count();
        $exportDate = Carbon::now();
        $filename = 'ccs_research_titles_' . $exportDate->format('YmdHis') . '.pdf';

        $pdf = Pdf::loadView('research_titles.export_pdf', compact('researchTitles', 'totalCount', 'exportDate'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download($filename);
    }
}
