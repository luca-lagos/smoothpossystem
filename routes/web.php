<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('template');
});

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

