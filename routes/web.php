<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PajakKaryawanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/perusahaan', [PerusahaanController::class, 'index'])->name('perusahaan.index');
    Route::post('/perusahaan', [PerusahaanController::class, 'store'])->name('perusahaan.store');
    Route::get('/perusahaan/{id}/edit', [PerusahaanController::class, 'edit'])->name('perusahaan.edit');
    Route::put('/perusahaan/{id}', [PerusahaanController::class, 'update'])->name('perusahaan.update');
    Route::delete('/perusahaan/{id}', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/pajak-karyawan', [PajakKaryawanController::class, 'index'])->name('pajak-karyawan.index');
    Route::post('/pajak-karyawan', [PajakKaryawanController::class, 'store'])->name('pajak-karyawan.store');
    Route::get('/pajak-karyawan/{id}/edit', [PajakKaryawanController::class, 'edit'])->name('pajak-karyawan.edit');
    Route::put('/pajak-karyawan/{id}', [PajakKaryawanController::class, 'update'])->name('pajak-karyawan.update');
    Route::delete('/pajak-karyawan/{id}', [PajakKaryawanController::class, 'destroy'])->name('pajak-karyawan.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
