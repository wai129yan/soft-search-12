<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/create-product', [ProductController::class, 'create'])->name('product.create');
Route::post('/store-product', [ProductController::class, 'store'])->name('product.store');