<?php

use App\Http\Controllers\CertificationController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TutorialController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', fn () => Inertia::render('Homepage/Index'))->name('home');

// Tutorials
Route::get('/tutorials', [TutorialController::class, 'index']);
Route::get('/tutorials/{slug}', [TutorialController::class, 'show']);

// Certifications
Route::get('/certifications', [CertificationController::class, 'index']);
Route::get('/certifications/{slug}', [CertificationController::class, 'show']);

// Live Training
Route::get('/live-training', fn () => Inertia::render('LiveTraining/Index'));

// Support
Route::get('/support', fn () => Inertia::render('Support/Index'));
Route::post('/support', [SupportController::class, 'store'])->name('support.store');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Customer Authentication
Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register');
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login');
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout')->middleware('auth:customer');

// Customer Profile (protected)
Route::middleware('auth:customer')->group(function () {
    Route::get('/profile', [CustomerAuthController::class, 'profile'])->name('customer.profile');
    Route::put('/profile', [CustomerAuthController::class, 'updateProfile'])->name('customer.profile.update');
    Route::put('/profile/password', [CustomerAuthController::class, 'updatePassword'])->name('customer.password.update');
});
