<?php

use App\Http\Controllers\TutorialController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', fn () => Inertia::render('Homepage/Index'));

// Tutorials
Route::get('/tutorials', [TutorialController::class, 'index']);
Route::get('/tutorials/{slug}', [TutorialController::class, 'show']);

// Certifications
Route::get('/certifications', fn () => Inertia::render('Certifications/Index'));

// Live Training
Route::get('/live-training', fn () => Inertia::render('LiveTraining/Index'));

// Support
Route::get('/support', fn () => Inertia::render('Support/Index'));
