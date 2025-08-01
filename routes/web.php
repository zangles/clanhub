<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('guest.registerform');
    Route::post('/register', [AuthController::class, 'register'])->name('guest.register');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('guest.loginForm');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

// Rutas protegidas
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
