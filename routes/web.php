<?php

use Illuminate\Support\Facades\Route;
use App\Http\Services\Auth\AuthController;
use App\Http\Services\Admin\ProductController;
use App\Http\Services\Admin\CategoryController;

// ROOT
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});


// ROUTE UNTUK USER YANG BELUM LOGIN
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});


// ROUTE UNTUK USER YANG SUDAH LOGIN
Route::middleware('auth')->group(function () {

    // LOGOUT
    // Cukup satu saja, jangan dobel.
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    // 1. ROUTE CUSTOMER / USER
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // 2. ROUTE KARYAWAN / ADMIN
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class);

        Route::resource('categories', CategoryController::class)
            ->except(['create', 'show']);
    });


    // 3. ROUTE OWNER / SUPER ADMIN
    Route::get('/owner/dashboard', function () {
        return view('owner.dashboard');
    })->name('owner.dashboard');
});