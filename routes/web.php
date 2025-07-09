<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Public Routes (no login required)
|--------------------------------------------------------------------------
*/

Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/search/products', [ShopController::class, 'liveSearch'])->name('search.products');
Route::get('/autocomplete', [SearchController::class, 'autocomplete'])->name('autocomplete');

/*
|--------------------------------------------------------------------------
| Authenticated Routes (login required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'active'])->group(function () {

    // 🛒 Cart
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // 👤 User Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🧭 Dashboard (shared by users & admins)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 🚀 Role-based dashboards (redirects only)
    Route::get('/admin-dashboard', fn () => redirect()->route('dashboard'))
        ->name('admin.dashboard')->middleware('is_admin');

    Route::get('/user-dashboard', fn () => redirect()->route('dashboard'))
        ->name('user.dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN Routes (protected by "can:isAdmin" or "is_admin")
    |--------------------------------------------------------------------------
    */
    Route::middleware(['can:isAdmin'])->group(function () {

        // 🛍️ Admin Shop Overview
        Route::get('/admin/shop', [ShopController::class, 'adminIndex'])->name('shop.admin');

        // 📦 Product Management
        Route::get('/admin/prod-management', [ProductController::class, 'index'])->name('prod.management');
        Route::get('/admin/prod-management/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/admin/prod-management/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/admin/prod-management/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/admin/prod-management/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/admin/prod-management/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

        // 👥 User Management
        Route::get('/crud-admin/user-management', [UserController::class, 'index'])->name('admin.user-management');
        Route::put('/crud-admin/user-management/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/crud-admin/user-management/{id}/toggle', [UserController::class, 'toggleStatus'])->name('users.toggle');

        // 💳 Transaction Management
        Route::get('/admin/transaction-management', function () {
            return view('crud-admin.transaction-management');
        })->name('transaction.management');
    });
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Login, Register, etc.)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
