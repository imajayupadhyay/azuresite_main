<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Homepage/Index');
});

Route::get('/tutorials', function () {
    return Inertia::render('Tutorials/Index');
});

Route::get('/support', function () {
    return Inertia::render('Support/Index');
});
