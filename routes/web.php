<?php

use Illuminate\Support\Facades\Route;
use App\Http\Services\Auth\AuthController;
use App\Http\Services\Admin\ProductController;
use App\Http\Services\Admin\CategoryController;
use App\Http\Services\User\CatalogController;
use App\Http\Services\User\CartController;

// ROOT
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

// CUSTOMER PUBLIC ROUTES
Route::get('/', [CatalogController::class, 'home'])->name('home');
Route::get('/categories', [CatalogController::class, 'categories'])->name('categories.index');
Route::get('/products/{product}', [CatalogController::class, 'show'])->name('products.show');

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

    // CUSTOMER CART
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

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