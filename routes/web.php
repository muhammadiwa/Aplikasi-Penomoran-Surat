<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjekController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KodeSuratController;
use App\Http\Controllers\PerusahaanController;

// Rute untuk login dan forgot password
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'proccessForgotPassword']);


Route::middleware(['auth'])->group(function () {
    // Rute yang membutuhkan autentikasi
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    //Perusahaan
    Route::get('/perusahaan', [PerusahaanController::class, 'index'])->name('perusahaan.index');
    Route::get('/perusahaan/create', [PerusahaanController::class, 'create'])->name('perusahaan.create');
    Route::post('/perusahaan', [PerusahaanController::class, 'store'])->name('perusahaan.store');
    Route::get('/perusahaan/{perusahaan}', [PerusahaanController::class, 'show'])->name('perusahaan.show');
    Route::get('/perusahaan/{perusahaan}/edit', [PerusahaanController::class, 'edit'])->name('perusahaan.edit');
    Route::put('/perusahaan/{perusahaan}', [PerusahaanController::class, 'update'])->name('perusahaan.update');
    Route::delete('/perusahaan/{perusahaan}', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');
    //Instansi
    Route::get('/instansi', [InstansiController::class, 'index'])->name('instansi.index');
    Route::get('/instansi/create', [InstansiController::class, 'create'])->name('instansi.create');
    Route::post('/instansi', [InstansiController::class, 'store'])->name('instansi.store');
    Route::get('/instansi/{instansi}/edit', [InstansiController::class, 'edit'])->name('instansi.edit');
    Route::put('/instansi/{instansi}', [InstansiController::class, 'update'])->name('instansi.update');
    Route::delete('/instansi/{instansi}', [InstansiController::class, 'destroy'])->name('instansi.destroy');
    //Kode Surat
    Route::get('/kodesurat', [KodeSuratController::class, 'index'])->name('kodesurat.index');
    Route::get('/kodesurat/create', [KodeSuratController::class, 'create'])->name('kodesurat.create');
    Route::post('/kodesurat', [KodeSuratController::class, 'store'])->name('kodesurat.store');
    Route::get('/kodesurat/{kodesurat}/edit', [KodeSuratController::class, 'edit'])->name('kodesurat.edit');
    Route::put('/kodesurat/{kodesurat}', [KodeSuratController::class, 'update'])->name('kodesurat.update');
    Route::delete('/kodesurat/{kodesurat}', [KodeSuratController::class, 'destroy'])->name('kodesurat.destroy');
    //Projek
    Route::get('/projek', [ProjekController::class, 'index'])->name('projek.index');
    Route::get('/projek/create', [ProjekController::class, 'create'])->name('projek.create');
    Route::post('/projek', [ProjekController::class, 'store'])->name('projek.store');
    Route::get('/projek/{projek}/edit', [ProjekController::class, 'edit'])->name('projek.edit');
    Route::put('/projek/{projek}', [ProjekController::class, 'update'])->name('projek.update');
    Route::delete('/projek/{projek}', [ProjekController::class, 'destroy'])->name('projek.destroy');
});

