<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;

Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('shop.show');

Route::middleware('auth')->group(function () {
    // Cart
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard view (used for clicking "Dashboard" in navbar)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // After-login redirects
    Route::get('/admin-dashboard', function () {
        return redirect()->route('dashboard');
    })->name('admin.dashboard')->middleware('is_admin');

    Route::get('/user-dashboard', function () {
        return redirect()->route('dashboard');
    })->name('user.dashboard');
});

require __DIR__.'/auth.php';
