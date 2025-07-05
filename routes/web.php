<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;

// 👋 Landing page: shop instead of "welcome"
Route::get('/', [ShopController::class, 'index'])->name('shop.index');

// 🛍 View a single product (optional)
Route::get('/product/{id}', [ShopController::class, 'show'])->name('shop.show');

// 🛒 Cart (protected with auth middleware)
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'view'])->name('cart.view');

    // 👤 Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Optional: protected dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');
});

// 👤 Auth routes (login, register, logout, etc.)
require __DIR__.'/auth.php';
