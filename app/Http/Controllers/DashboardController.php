<?php

namespace App\Http\Controllers;

use App\Models\ResearchTitle;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTitles = ResearchTitle::withTrashed()->count();
        $activeTitles = ResearchTitle::whereNull('deleted_at')->count();
        $trashedTitles = ResearchTitle::onlyTrashed()->count();

        return view('dashboard', compact('totalTitles', 'activeTitles', 'trashedTitles'));
    }
}
