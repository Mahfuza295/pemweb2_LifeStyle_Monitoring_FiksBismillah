<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Arahkan halaman utama langsung ke dashboard
Route::get('/', [PageController::class, 'dashboard']);

// Navigasi Menu Dashboard
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/aktivitas', [PageController::class, 'aktivitas'])->name('aktivitas');
Route::get('/artikel', [PageController::class, 'artikel'])->name('artikel');
Route::get('/profil', [PageController::class, 'profil'])->name('profil');