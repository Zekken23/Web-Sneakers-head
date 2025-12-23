<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

// Halaman Register & Login
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Halaman Dashboard (Admin)
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/dashboard/sneakers/create', function () {
    return view('admin.sneakers.create');
});

// Kita gunakan parameter ?id=... di URL nanti untuk edit
Route::get('/dashboard/sneakers/edit', function () {
    return view('admin.sneakers.edit');
});
