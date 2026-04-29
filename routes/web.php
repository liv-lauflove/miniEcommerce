<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// URL yang bisa diakses kalau BELUM LOGIN
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// URL yang HANYA BISA DIAKSES KALAU SUDAH LOGIN
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
