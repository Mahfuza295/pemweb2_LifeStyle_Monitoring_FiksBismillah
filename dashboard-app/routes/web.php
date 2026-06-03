<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArtikelController;

Route::get('/', [PageController::class, 'dashboard']);

Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/aktivitas', [PageController::class, 'aktivitas'])->name('aktivitas');
Route::post('/aktivitas', [PageController::class, 'storeAktivitas'])->name('aktivitas.store');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/profil', [PageController::class, 'profil'])->name('profil');
