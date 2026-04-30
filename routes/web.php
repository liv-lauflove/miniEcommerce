<?php

use Illuminate\Support\Facades\Route;
use App\Http\Services\Auth\AuthController;

// Kalau buka root langsung diarahkan ke login
Route::get('/', function () {
    return redirect('/login');
});

// URL yang bisa diakses kalau BELUM LOGIN
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

// URL yang HANYA BISA DIAKSES KALAU SUDAH LOGIN
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});