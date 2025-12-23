<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SneakerController; // Import Controller Utama
use App\Http\Controllers\Api\AuthController; // Import Auth Controller

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- 1. PUBLIC ROUTES (Tanpa Login) ---

// Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Sneakers (Read Only)
Route::get('sneakers', [SneakerController::class, 'index']);
Route::get('sneakers/{id}', [SneakerController::class, 'show']);

// --- 2. PROTECTED ROUTES (Harus Login) ---
Route::middleware('auth:api')->group(function () {

    // Auth Features
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);

    // CRUD Sneakers (Admin Features)
    Route::post('sneakers', [SneakerController::class, 'store']);
    Route::post('sneakers/{id}', [SneakerController::class, 'update']); // Pakai POST untuk update data + file
    Route::delete('sneakers/{id}', [SneakerController::class, 'destroy']);
    Route::get('brands', [SneakerController::class, 'getBrands']);
    // Checkout
    Route::post('/checkout', [OrderController::class, 'checkout']);

});
