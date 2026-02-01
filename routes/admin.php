<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\NewsletterSubscriptionController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController;
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

        // Newsletter subscriptions
        Route::prefix('newsletter')->name('newsletter.')->group(function () {
            Route::get('/', [NewsletterSubscriptionController::class, 'index'])->name('index');
            Route::get('/export', [NewsletterSubscriptionController::class, 'export'])->name('export');
            Route::put('/{subscription}', [NewsletterSubscriptionController::class, 'update'])->name('update');
            Route::delete('/{subscription}', [NewsletterSubscriptionController::class, 'destroy'])->name('destroy');
        });

        // Customers management
        Route::prefix('customers')->name('customers.')->group(function () {
            Route::get('/', [CustomerController::class, 'index'])->name('index');
            Route::get('/export', [CustomerController::class, 'export'])->name('export');
            Route::get('/{customer}', [CustomerController::class, 'show'])->name('show');
            Route::put('/{customer}', [CustomerController::class, 'update'])->name('update');
            Route::put('/{customer}/reset-password', [CustomerController::class, 'resetPassword'])->name('reset-password');
            Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('destroy');
        });

        // Service categories management
        Route::prefix('services/categories')->name('services.categories.')->group(function () {
            Route::get('/', [ServiceCategoryController::class, 'index'])->name('index');
            Route::post('/', [ServiceCategoryController::class, 'store'])->name('store');
            Route::put('/{category}', [ServiceCategoryController::class, 'update'])->name('update');
            Route::put('/{category}/toggle-status', [ServiceCategoryController::class, 'toggleStatus'])->name('toggle-status');
            Route::post('/reorder', [ServiceCategoryController::class, 'reorder'])->name('reorder');
            Route::delete('/{category}', [ServiceCategoryController::class, 'destroy'])->name('destroy');
        });

        // Services management
        Route::prefix('services')->name('services.')->group(function () {
            Route::get('/', [ServiceController::class, 'index'])->name('index');
            Route::post('/', [ServiceController::class, 'store'])->name('store');
            Route::put('/{service}', [ServiceController::class, 'update'])->name('update');
            Route::put('/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('toggle-status');
            Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('destroy');
        });
    });
});
