<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('template');
});

Route::view('/dashboard', 'dashboard.index')->name('dashboard');

Route::resource('categories', App\Http\Controllers\categoryController::class);

Route::view('/categories', 'categories.index')->name('categories');

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/401', function () {
    return view('pages.errors.401');
});

Route::get('/404', function () {
    return view('pages.errors.404');
});

Route::get('/500', function () {
    return view('pages.errors.500');
});

