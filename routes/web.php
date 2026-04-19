<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::post('/variants', [ProductController::class,'storeVariant'])->name('variants.store');

Route::get('/', function () {
    return view('welcome');
});

Route::post('/stockin/{id}', [ProductController::class,'stockIn']);
Route::post('/stockout/{id}',[ProductController::class,'stockOut']);