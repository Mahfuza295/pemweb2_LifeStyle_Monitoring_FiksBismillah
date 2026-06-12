<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// =======================
// AUTH
// =======================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =======================
// LANDING
// =======================
Route::get('/', function () {
    return view('welcome');
});


// =======================
// ARTIKEL PUBLIK
// =======================
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');


// =======================
// USER + ADMIN (AUTH)
// =======================
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    Route::get('/aktivitas', [PageController::class, 'aktivitas'])->name('aktivitas');
    Route::post('/aktivitas', [PageController::class, 'storeAktivitas'])->name('aktivitas.store');

    Route::get('/riwayat-aktivitas', [PageController::class, 'riwayatIndex'])->name('riwayat.index');

    Route::get('/profil', [PageController::class, 'profil'])->name('profil');
});


// =======================
// ADMIN ONLY
// =======================
Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', [PageController::class, 'adminDashboard'])
        ->name('admin.dashboard');

    Route::get('/users', [PageController::class, 'kelolaUser'])
        ->name('admin.users');

    Route::get('/artikel', [AdminController::class, 'artikelIndex'])
        ->name('admin.artikel.index');

    Route::get('/artikel/create', [AdminController::class, 'artikelCreate'])
        ->name('admin.artikel.create');

    Route::post('/artikel', [AdminController::class, 'artikelStore'])
        ->name('admin.artikel.store');

    Route::get('/artikel/{id}/edit', [AdminController::class, 'artikelEdit'])
        ->name('admin.artikel.edit');

    Route::put('/artikel/{id}', [AdminController::class, 'artikelUpdate'])
        ->name('admin.artikel.update');

    Route::delete('/artikel/{id}', [AdminController::class, 'artikelDelete'])
        ->name('admin.artikel.delete');
});


// =======================
// EXPORT
// =======================
Route::get('/riwayat/export/pdf', [PageController::class, 'exportPdf'])
    ->name('riwayat.export.pdf');

Route::get('/riwayat/export/excel', [PageController::class, 'exportExcel'])
    ->name('riwayat.export.excel');