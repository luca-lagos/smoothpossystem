<?php

use App\Http\Controllers\brandController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\presentationController;
use App\Http\Controllers\productController;
use App\Http\Controllers\saleController;
use App\Http\Controllers\shopController;
use App\Http\Controllers\supplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [homeController::class, 'index'])->name('dashboard');

Route::get('generate-shop-pdf/{id}', [shopController::class, 'generateShopPDF'])->name('generate-shop-pdf');

Route::get('generate-sale-pdf/{id}', [saleController::class, 'generateSalePDF'])->name('generate-sale-pdf');

Route::resources([
    'categories' => categoryController::class,
    'brands' => brandController::class,
    'presentations' => presentationController::class,
    'products' => productController::class,
    'suppliers' => supplierController::class,
    'clients' => clientController::class,
    'shops' => shopController::class,
    'sales' => saleController::class
]);

Route::get('/login', [loginController::class, 'index'])->name('login');
Route::post('/login', [loginController::class, 'login']);
Route::get('/logout', [loginController::class, 'logout'])->name('logout');
Route::get('/401', function () {
    return view('pages.errors.401');
});

Route::get('/404', function () {
    return view('pages.errors.404');
});

Route::get('/500', function () {
    return view('pages.errors.500');
});
