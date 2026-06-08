<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController; // TAMBAHKAN

// =====================
// AUTH
// =====================

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =====================
// HALAMAN UTAMA
// =====================

Route::get('/', [PageController::class, 'dashboard']);

Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/aktivitas', [PageController::class, 'aktivitas'])->name('aktivitas');
Route::post('/aktivitas', [PageController::class, 'storeAktivitas'])->name('aktivitas.store');

Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/profil', [PageController::class, 'profil'])->name('profil');
