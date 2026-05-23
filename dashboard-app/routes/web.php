<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArtikelController;

//halaman utama langsung ke dashboard
Route::get('/', [PageController::class, 'dashboard']);

//navigasi Menu Dashboard
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/aktivitas', [PageController::class, 'aktivitas'])->name('aktivitas');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/profil', [PageController::class, 'profil'])->name('profil');


