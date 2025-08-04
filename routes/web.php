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
use App\Http\Controllers\Settings;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\ContactController;


Route::get('/', function () {
    return view('frontend.index');
});
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/reload-captcha', [ContactController::class, 'reloadCaptcha'])->name('reload.captcha');
Route::get('/ormas/data', [OrmasController::class, 'data'])->name('ormas.data');
Route::get('/ormas/data/{id}', [OrmasController::class, 'showdata'])->name('ormas.show');



// Ubah default root ke dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('ormas')->group(function () {
        Route::get('/', [OrmasController::class, 'index'])->name('ormas.index');
        Route::get('/create', [OrmasController::class, 'create'])->name('ormas.create');
        Route::post('/', [OrmasController::class, 'store'])->name('ormas.store');
        Route::get('/{id}', [OrmasController::class, 'show'])->name('ormas.show');
        Route::get('/{id}/edit', [OrmasController::class, 'edit'])->name('ormas.edit');
        Route::put('/{id}', [OrmasController::class, 'update'])->name('ormas.update');
        Route::delete('/{id}', [OrmasController::class, 'destroy'])->name('ormas.destroy');
        Route::post('/export', [OrmasController::class, 'export'])->name('ormas.export');
    });

    Route::prefix('api')->group(function () {
        Route::post('/data-ormas', [ApiController::class, 'store'])->name('api.data-ormas.store');
        Route::post('/data-legalitas', [ApiController::class, 'legalitas'])->name('api.legalitas.store');
        Route::post('/data-pengurus', [ApiController::class, 'pengurus'])->name('pengurus.store');
        Route::get('/data-pengurus', [ApiController::class, 'get_pengurus'])->name('pengurus.get');
        Route::post('/data-aset', [ApiController::class, 'storeAset'])->name('aset.store');
    });

    Route::resource('users', UserController::class);

    Route::get('/select2/bidang-kegiatan', [RefBidangKegiatanController::class, 'select2'])->name('select2.bidang-kegiatan');
    Route::get('/select2/ref-jenis-kelembagaan', [RefJenisKelembagaanController::class, 'select2'])->name('jenis-kelembagaan.select2');

    Route::get('/aset', [ApiController::class, 'getAset'])->name('aset.index');
    Route::post('/aset', [ApiController::class, 'storeAset']);
    Route::get('/aset/{id}', [ApiController::class, 'showAset']);
    Route::put('/aset/{id}', [ApiController::class, 'updateAset']);
    Route::delete('/aset/{id}', [ApiController::class, 'deleteAset']);
    Route::get('/settings', [Settings::class, 'index'])->name('settings.index');
    route::get('inbox',[InboxController::class, 'index'])->name('inbox.index');
    route::get('inbox/{inbox}',[InboxController::class, 'show'])->name('inbox.show');
    
    Route::prefix('wilayah')->group(function () {
        Route::get('provinsi', [WilayahController::class, 'getProvinsi'])->name('wilayah.provinsi');
        Route::get('kabupaten', [WilayahController::class, 'getKabupaten'])->name('wilayah.kabupaten');
        Route::get('kecamatan', [WilayahController::class, 'getKecamatan'])->name('wilayah.kecamatan');
        Route::get('kelurahan', [WilayahController::class, 'getKelurahan'])->name('wilayah.kelurahan');
    });


    Route::prefix('bidang-kegiatan')->group(function () {
        Route::get('/', [RefBidangKegiatanController::class, 'index'])->name('bidang-kegiatan.index');
        Route::get('/data', [RefBidangKegiatanController::class, 'data'])->name('bidang-kegiatan.data');
        Route::post('/', [RefBidangKegiatanController::class, 'store'])->name('bidang-kegiatan.store');
        Route::put('/{id}', [RefBidangKegiatanController::class, 'update'])->name('bidang-kegiatan.update');
        Route::delete('/{id}', [RefBidangKegiatanController::class, 'destroy'])->name('bidang-kegiatan.destroy');
        Route::get('/select2', [RefBidangKegiatanController::class, 'select2'])->name('bidang-kegiatan.select2');
    });

    Route::prefix('jenis-kelembagaan')->group(function () {
        Route::get('/', [RefJenisKelembagaanController::class, 'index'])->name('jenis-kelembagaan.index');
        Route::get('/data', [RefJenisKelembagaanController::class, 'data'])->name('jenis-kelembagaan.data');
        Route::post('/', [RefJenisKelembagaanController::class, 'store'])->name('jenis-kelembagaan.store');
        Route::put('/{id}', [RefJenisKelembagaanController::class, 'update'])->name('jenis-kelembagaan.update');
        Route::delete('/{id}', [RefJenisKelembagaanController::class, 'destroy'])->name('jenis-kelembagaan.destroy');
    });
});

require __DIR__ . '/auth.php';
