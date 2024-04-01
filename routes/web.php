<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\ProjekController;
use App\Http\Controllers\TahapanController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KodeSuratController;
use App\Http\Controllers\PerusahaanController;

Route::redirect('/', '/dashboard');

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
    Route::get('/perusahaan/{perusahaan}/edit', [PerusahaanController::class, 'edit'])->name('perusahaan.edit');
    Route::put('/perusahaan/{perusahaan}', [PerusahaanController::class, 'update'])->name('perusahaan.update');
    Route::delete('/perusahaan/{perusahaan}', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');
    //karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('/profile', [KaryawanController::class, 'show'])->name('profile');
    Route::get('/karyawan/{karyawan}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::put('/karyawan/{karyawan}', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::delete('/karyawan/{karyawan}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
    //Instansi
    Route::get('/instansi', [InstansiController::class, 'index'])->name('instansi.index');
    Route::get('/instansi/create', [InstansiController::class, 'create'])->name('instansi.create');
    Route::post('/instansi', [InstansiController::class, 'store'])->name('instansi.store');
    Route::get('/instansi/{instansi}/edit', [InstansiController::class, 'edit'])->name('instansi.edit');
    Route::put('/instansi/{instansi}', [InstansiController::class, 'update'])->name('instansi.update');
    Route::delete('/instansi/{instansi}', [InstansiController::class, 'destroy'])->name('instansi.destroy');
    Route::delete('/perusahaan/{perusahaan}', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');
    //Instansi
    Route::get('/tahapan', [TahapanController::class, 'index'])->name('tahapan.index');
    Route::get('/tahapan/create', [TahapanController::class, 'create'])->name('tahapan.create');
    Route::post('/tahapan', [TahapanController::class, 'store'])->name('tahapan.store');
    Route::get('/tahapan/{tahapan}/edit', [TahapanController::class, 'edit'])->name('tahapan.edit');
    Route::put('/tahapan/{tahapan}', [TahapanController::class, 'update'])->name('tahapan.update');
    Route::delete('/tahapan/{tahapan}', [TahapanController::class, 'destroy'])->name('tahapan.destroy');
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
    //Surat
    Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
    Route::get('/surat/create', [SuratController::class, 'create'])->name('surat.create');
    Route::post('/surat', [SuratController::class, 'store'])->name('surat.store');
    Route::get('/surat/{surat}/edit', [SuratController::class, 'edit'])->name('surat.edit');
    Route::put('/surat/{surat}', [SuratController::class, 'update'])->name('surat.update');
    Route::delete('/surat/{surat}', [SuratController::class, 'destroy'])->name('surat.destroy');

    Route::get('/get-projek/{id_perusahaan}', [SuratController::class, 'getProjectsByPerusahaan'])->name('get-projek');
});

