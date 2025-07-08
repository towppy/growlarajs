<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Models\Product;

<<<<<<< HEAD
//mga adminside
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;





=======
>>>>>>> d0b1198d88241160778bc1c9999100ca5d441ea5
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/search/products', [ShopController::class, 'liveSearch'])->name('search.products');
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
<<<<<<< HEAD

    //admin shop 
    Route::get('/admin/shop', [ShopController::class, 'adminIndex'])->name('shop.admin');

   //admin products 

Route::get('/admin/prod-management', [ProductController::class, 'index'])->name('prod.management');
Route::get('/admin/prod-management/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/admin/prod-management/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/admin/prod-management/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/admin/prod-management/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/admin/prod-management/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

  // ADMIN USER MANAGEMENT
    Route::get('/admin/user-management', [UserController::class, 'index'])->name('user.management');
    Route::get('/admin/user-management/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/user-management/{id}', [UserController::class, 'update'])->name('users.update');
    Route::patch('/admin/user-management/{id}/toggle', [UserController::class, 'toggleStatus'])->name('users.toggle');

//Admin transaction management
Route::get('/admin/transaction-management', function () {
    return view('crud-admin.transaction-management');
})->name('transaction.management');

=======
>>>>>>> d0b1198d88241160778bc1c9999100ca5d441ea5
    
});

require __DIR__.'/auth.php';
