<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PajakKaryawanController;
use App\Http\Controllers\JenisPajakController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Routes untuk Perusahaan
    Route::get('/perusahaan', [PerusahaanController::class, 'index'])->name('perusahaan.index');
    Route::post('/perusahaan', [PerusahaanController::class, 'store'])->name('perusahaan.store');
    Route::get('/perusahaan/{id}/edit', [PerusahaanController::class, 'edit'])->name('perusahaan.edit');
    Route::put('/perusahaan/{id}', [PerusahaanController::class, 'update'])->name('perusahaan.update');
    Route::delete('/perusahaan/{id}', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');

    // Routes untuk Pajak Karyawan
    Route::get('/pajak-karyawan', [PajakKaryawanController::class, 'index'])->name('pajak-karyawan.index');
    Route::post('/pajak-karyawan', [PajakKaryawanController::class, 'store'])->name('pajak-karyawan.store');
    Route::get('/pajak-karyawan/{id}/edit', [PajakKaryawanController::class, 'edit'])->name('pajak-karyawan.edit');
    Route::put('/pajak-karyawan/{id}', [PajakKaryawanController::class, 'update'])->name('pajak-karyawan.update');
    Route::delete('/pajak-karyawan/{id}', [PajakKaryawanController::class, 'destroy'])->name('pajak-karyawan.destroy');

    // Routes untuk Jenis Pajak
    Route::get('/jenis-pajak', [JenisPajakController::class, 'index'])->name('jenis-pajak.index');
    Route::post('/jenis-pajak', [JenisPajakController::class, 'store'])->name('jenis-pajak.store');
    Route::get('/jenis-pajak/{id}/edit', [JenisPajakController::class, 'edit'])->name('jenis-pajak.edit');
    Route::put('/jenis-pajak/{id}', [JenisPajakController::class, 'update'])->name('jenis-pajak.update');
    Route::delete('/jenis-pajak/{id}', [JenisPajakController::class, 'destroy'])->name('jenis-pajak.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Routes untuk Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
