<?php

namespace App\Http\Controllers;

use App\Models\OrmasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrmas = OrmasModel::count();

        // Data jumlah ormas per kecamatan (untuk grafik bar/kecamatan)
        // Bergabung dengan tabel kecamatan untuk mendapatkan nama kecamatan
        // Menggunakan DB::raw() untuk mengatasi masalah "Illegal mix of collations".
        // Ini memaksa kolom `kode_kecamatan` untuk menggunakan collation `utf8mb4_unicode_ci`
        // selama query ini dieksekusi, sehingga cocok dengan collation dari `om_alamat_kec`.
        $dataKecamatan = OrmasModel::join('ref_kecamatan', 'db_profil_ormas.om_alamat_kec', '=', DB::raw('ref_kecamatan.kode_kecamatan COLLATE utf8mb4_unicode_ci'))
            ->select('ref_kecamatan.nama_kecamatan', DB::raw('count(db_profil_ormas.ormas_id) as jumlah'))
            ->groupBy('ref_kecamatan.nama_kecamatan')
            ->orderBy('ref_kecamatan.nama_kecamatan')
            ->pluck('jumlah', 'nama_kecamatan');

        // Hitung berbadan hukum berdasarkan relasi ke tabel legalitas
        $berbadanHukum = OrmasModel::whereHas('legalitas', function ($query) {
            $query->where('bh_tbh', 'Y');
        })->count();

        // Tidak berbadan hukum adalah sisanya
        $tidakBerbadanHukum = $totalOrmas - $berbadanHukum;

        return view('dashboard', compact('totalOrmas', 'dataKecamatan', 'berbadanHukum', 'tidakBerbadanHukum'));
    }
}
