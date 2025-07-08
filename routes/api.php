<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
<<<<<<< HEAD
use App\Http\Controllers\API\TransactionController;

Route::apiResource('transactions', TransactionController::class);
=======
>>>>>>> d0b1198d88241160778bc1c9999100ca5d441ea5

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (JWT required)
Route::middleware(['auth:api'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
