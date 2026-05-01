<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Staff\StaffDashboardController;

Route::middleware(['auth'])->group(function () {

    // DASHBOARDS
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard')
        ->middleware('role:admin');

    Route::get('/admin/audit-logs', [AdminDashboardController::class, 'logs'])
        ->name('admin.logs')
        ->middleware('role:admin');

    Route::get('/staff/dashboard', [StaffDashboardController::class, 'index'])
        ->name('staff.dashboard')
        ->middleware('role:staff');

    // =========================
    // SHARED INVENTORY (IMPORTANT)
    // =========================

    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::post('/stockin/{id}', [ProductController::class, 'stockIn'])
        ->name('products.stockin');

    Route::post('/stockout/{id}', [ProductController::class, 'stockOut'])
        ->name('products.stockout');

    // ADMIN ONLY ACTIONS
    Route::middleware('role:admin')->group(function () {

        Route::get('/products/create', [ProductController::class, 'create'])
            ->name('products.create');

        Route::post('/products', [ProductController::class, 'store'])
            ->name('products.store');

        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
            ->name('products.edit');

        Route::put('/products/{product}', [ProductController::class, 'update'])
            ->name('products.update');

        Route::delete('/products/{product}', [ProductController::class, 'destroy'])
            ->name('products.destroy');
    });

    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');
});
// Home
Route::get('/', function () {
    return view('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});



