<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

// ── HOME ──
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ── REGISTER (3-step) ──
Route::get('/register',         [RegisterController::class, 'step1'])->name('register.step1');
Route::post('/register',        [RegisterController::class, 'step1Store'])->name('register.step1.store');

Route::get('/register/step2',   [RegisterController::class, 'step2'])->name('register.step2');
Route::post('/register/step2',  [RegisterController::class, 'step2Store'])->name('register.step2.store');

Route::get('/register/step3',   [RegisterController::class, 'step3'])->name('register.step3');
Route::post('/register/step3',  [RegisterController::class, 'step3Store'])->name('register.step3.store');

Route::get('/register/success', [RegisterController::class, 'success'])->name('register.success');

// ── LOGIN ──
Route::get('/login',  [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

// ── LOGOUT ──
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// ── REPORTS (protected) ──
Route::get('/reports', function () {
    return view('reports');
})->middleware('auth')->name('reports');

// ── DASHBOARD (protected) ──
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

