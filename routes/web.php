<?php

use Illuminate\Support\Facades\Route;
use App\Http\Services\Auth\AuthController; 
use App\Http\Controllers\OrderController;

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    
    // 1. Rute Customer
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    });
    Route::get('/profile', [OrderController::class, 'profile'])->name('profile');

    // 2. Rute Karyawan (Admin)
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    // 3. Rute Owner (Super Admin)
    Route::get('/owner/dashboard', function () {
        return view('owner.dashboard');
    });
    
    Route::post('/logout', [AuthController::class, 'logout']);
});