<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// AUTH
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// LANDING
Route::get('/', function () {
    return view('welcome');
});

// ARTIKEL (boleh publik atau auth)
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');


// SEMUA USER (ADMIN + PENGGUNA)
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    Route::get('/aktivitas', [PageController::class, 'aktivitas'])->name('aktivitas');

    Route::post('/aktivitas', [PageController::class, 'storeAktivitas'])->name('aktivitas.store');

    Route::get('/profil', [PageController::class, 'profil'])->name('profil');

});

Route::middleware(['auth', 'admin'])->group(function () {

    // dashboard admin
    Route::get('/dashboard-admin', [AdminController::class, 'dashboard'])
        ->name('dashboard.admin');

    // CRUD ARTIKEL ADMIN
    Route::get('/admin/artikel', [AdminController::class, 'artikelIndex'])->name('admin.artikel.index');
    Route::get('/admin/artikel/create', [AdminController::class, 'artikelCreate'])->name('admin.artikel.create');
    Route::post('/admin/artikel', [AdminController::class, 'artikelStore'])->name('admin.artikel.store');
    Route::get('/admin/artikel/{id}/edit', [AdminController::class, 'artikelEdit'])->name('admin.artikel.edit');
    Route::put('/admin/artikel/{id}', [AdminController::class, 'artikelUpdate'])->name('admin.artikel.update');
    Route::delete('/admin/artikel/{id}', [AdminController::class, 'artikelDelete'])->name('admin.artikel.delete');
});