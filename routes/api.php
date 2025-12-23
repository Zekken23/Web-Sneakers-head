<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

// AuthController biasanya ada di folder Api
Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

// SneakerController biasanya ada di folder Controllers biasa (bukan Api)
// Jadi kita panggil langsung ke alamat aslinya
Route::get('sneakers', [\App\Http\Controllers\SneakerController::class, 'index']);
Route::get('sneakers/{id}', [\App\Http\Controllers\SneakerController::class, 'show']);


// =================================================================
// 2. PROTECTED ROUTES (Harus Login)
// =================================================================
Route::middleware('auth:api')->group(function () {

    // Auth Features
    Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('me', [\App\Http\Controllers\Api\AuthController::class, 'me']);

    // CRUD Sneakers (Arahkan ke SneakerController di folder utama)
    Route::post('sneakers', [\App\Http\Controllers\SneakerController::class, 'store']);
    Route::post('sneakers/{id}', [\App\Http\Controllers\SneakerController::class, 'update']);
    Route::delete('sneakers/{id}', [\App\Http\Controllers\SneakerController::class, 'destroy']);
    Route::middleware('auth:api')->post('/checkout', [OrderController::class, 'checkout']);

});
