<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrmasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\RefBidangKegiatanController;
use App\Http\Controllers\RefJenisKelembagaanController;
use App\Http\Controllers\WilayahController;


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

    Route::post('/api/data-ormas', [ApiController::class, 'store'])->name('api.data-ormas.store');
    Route::post('/api/data-legalitas', [ApiController::class, 'legalitas'])->name('api.legalitas.store');
    Route::post('/api/data-pengurus', [ApiController::class, 'pengurus'])->name('pengurus.store');
    Route::get('/api/data-pengurus', [ApiController::class, 'get_pengurus'])->name('pengurus.get');
    Route::post('/api/data-aset', [ApiController::class, 'storeAset'])->name('aset.store');

    Route::resource('users', UserController::class);

    Route::get('/select2/bidang-kegiatan', [RefBidangKegiatanController::class, 'select2'])->name('select2.bidang-kegiatan');
    Route::get('/select2/ref-jenis-kelembagaan', [RefJenisKelembagaanController::class, 'select2'])->name('jenis-kelembagaan.select2');

    Route::get('/aset', [ApiController::class, 'getAset'])->name('aset.index');
    Route::post('/aset', [ApiController::class, 'storeAset']);
    Route::get('/aset/{id}', [ApiController::class, 'showAset']);
    Route::put('/aset/{id}', [ApiController::class, 'updateAset']);
    Route::delete('/aset/{id}', [ApiController::class, 'deleteAset']);

    Route::prefix('wilayah')->group(function () {
        Route::get('provinsi', [WilayahController::class, 'getProvinsi'])->name('wilayah.provinsi');
        Route::get('kabupaten', [WilayahController::class, 'getKabupaten'])->name('wilayah.kabupaten');
        Route::get('kecamatan', [WilayahController::class, 'getKecamatan'])->name('wilayah.kecamatan');
        Route::get('kelurahan', [WilayahController::class, 'getKelurahan'])->name('wilayah.kelurahan');
    });
});

require __DIR__ . '/auth.php';
