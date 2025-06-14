<?php

namespace App\Http\Controllers;

use App\Models\Ormas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrmas = Ormas::count();

        // Data jumlah ormas per kecamatan (untuk grafik bar/kecamatan)
        $dataKecamatan = Ormas::select('kecamatan', DB::raw('count(*) as jumlah'))
            ->groupBy('kecamatan')
            ->pluck('jumlah', 'kecamatan');

        // Hitung berbadan hukum (sk_kemenkumham tidak kosong)
        $berbadanHukum = Ormas::whereNotNull('sk_kemenkumham')
            ->where('sk_kemenkumham', '<>', '')
            ->count();

        // Tidak berbadan hukum (sk_kemenkumham kosong atau null)
        $tidakBerbadanHukum = $totalOrmas - $berbadanHukum;

        return view('dashboard', compact('totalOrmas', 'dataKecamatan', 'berbadanHukum', 'tidakBerbadanHukum'));
    }
}
