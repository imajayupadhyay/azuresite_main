<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SupportSubmissionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    
    // Login routes (guest only)
    Route::middleware('guest')->group(function () {
        Route::get('/azureskill-secure-login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/azureskill-secure-login', [AdminAuthController::class, 'login'])->name('login.post');
    });
    
    // Protected admin routes
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // Support submissions
        Route::prefix('support')->name('support.')->group(function () {
            Route::get('/', [SupportSubmissionController::class, 'index'])->name('index');
            Route::get('/{submission}', [SupportSubmissionController::class, 'show'])->name('show');
            Route::put('/{submission}', [SupportSubmissionController::class, 'update'])->name('update');
            Route::delete('/{submission}', [SupportSubmissionController::class, 'destroy'])->name('destroy');
        });
    });
});
