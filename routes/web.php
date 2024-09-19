<?php

use App\Http\Controllers\brandController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\presentationController;
use App\Http\Controllers\productController;
use App\Http\Controllers\shopController;
use App\Http\Controllers\supplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('template');
});

Route::view('/dashboard', 'dashboard.index')->name('dashboard');

Route::resources([
    'categories' => categoryController::class,
    'brands' => brandController::class,
    'presentations' => presentationController::class,
    'products' => productController::class,
    'suppliers' => supplierController::class,
    'clients' => clientController::class,
    'shops' => shopController::class,
]);

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
