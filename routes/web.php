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
Route::get('/show-product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/update-product/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

//soft delete
Route::get('/deleted-products', [ProductController::class, 'trash'])->name('product.trash');
Route::post('/restore-product/{id}', [ProductController::class, 'restoreProduct'])->name('product.restore');

Route::delete('/permanent-delete-product/{id}', [ProductController::class, 'destroyParement'])->name('product.destroyParement');
