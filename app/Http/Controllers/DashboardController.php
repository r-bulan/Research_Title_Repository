<?php

namespace App\Http\Controllers;

use App\Models\ResearchTitle;

class DashboardController extends Controller
{
    public function index()
    {
        // Total titles (including soft-deleted)
        $totalTitles = ResearchTitle::withTrashed()->count();
        
        // Active titles (not soft-deleted)
        $activeTitles = ResearchTitle::whereNull('deleted_at')->count();
        
        // Soft-deleted titles
        $trashedTitles = ResearchTitle::onlyTrashed()->count();

        return view('dashboard', compact('totalTitles', 'activeTitles', 'trashedTitles'));
    }
}
