<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ResearchTitleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Categories
    Route::resource('categories', CategoryController::class);
    
    // Research Titles - Export route MUST come before resource route
    Route::get('/research_titles/export', [ResearchTitleController::class, 'export'])->name('research_titles.export');
    Route::resource('research_titles', ResearchTitleController::class);
    
    // Trash
    Route::get('/trash', [ResearchTitleController::class, 'trash'])->name('research_titles.trash');
    Route::post('/trash/{id}/restore', [ResearchTitleController::class, 'restore'])->name('research_titles.restore');
    Route::delete('/trash/{id}/force-delete', [ResearchTitleController::class, 'forceDelete'])->name('research_titles.forceDelete');
});


require __DIR__.'/settings.php';
