<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SneakerController;
use App\Http\Controllers\AuthController;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::get('sneakers', [SneakerController::class, 'index']); // Get All
Route::get('sneakers/{id}', [SneakerController::class, 'show']);


Route::middleware(['auth:api'])->group(function () {

    // Auth Protected
    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
    });

    Route::post('sneakers', [SneakerController::class, 'store']);       // Create
    Route::put('sneakers/{id}', [SneakerController::class, 'update']);  // Update
    Route::delete('sneakers/{id}', [SneakerController::class, 'destroy']); // Delete

});
