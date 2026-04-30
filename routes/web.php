<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

// Home
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth', 'role:admin')->group(function () {

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('products', ProductController::class);

    Route::post('/stockin/{id}', [ProductController::class, 'stockIn']);
    Route::post('/stockout/{id}', [ProductController::class, 'stockOut']);
});

Route::middleware(['auth', 'role:staff'])->group(function () {

    Route::post('/stockin/{id}', [ProductController::class, 'stockIn']);
    Route::post('/stockout/{id}', [ProductController::class, 'stockOut']);

});


