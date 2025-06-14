<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrmasController;
use App\Http\Controllers\UserController;

//Hapus welcome page default
Route::get('/', function () {
    return view('frontend.index');
});
Route::get('/ormas/data', [OrmasController::class, 'data'])->name('ormas.data');
Route::get('/ormas/data/{id}', [OrmasController::class, 'showdata'])->name('ormas.show');

// Ubah default root ke dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Index - Tampilkan semua ormas
    Route::get('/ormas', [OrmasController::class, 'index'])->name('ormas.index');

    // Create - Tampilkan form tambah ormas
    Route::get('/ormas/create', [OrmasController::class, 'create'])->name('ormas.create');

    // Store - Simpan data baru
    Route::post('/ormas', [OrmasController::class, 'store'])->name('ormas.store');

    // Show - Tampilkan detail ormas
    Route::get('/ormas/{id}', [OrmasController::class, 'show'])->name('ormas.show');

    // Edit - Tampilkan form edit
    Route::get('/ormas/{id}/edit', [OrmasController::class, 'edit'])->name('ormas.edit');

    // Update - Simpan perubahan
    Route::put('/ormas/{id}', [OrmasController::class, 'update'])->name('ormas.update');

    // Destroy - Hapus data
    Route::delete('/ormas/{id}', [OrmasController::class, 'destroy'])->name('ormas.destroy');
});

require __DIR__ . '/auth.php';
