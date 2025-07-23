<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function getProvinsi(Request $request)
    {
        $search = $request->input('q');

        $query = Provinsi::query();
        if ($search) {
            $query->where('nama_provinsi', 'like', "%{$search}%");
        }

        $results = $query->orderBy('nama_provinsi')->limit(20)->get();

        return response()->json([
            'results' => $results->map(fn ($item) => [
                'id' => $item->kode_provinsi,
                'text' => $item->nama_provinsi,
            ]),
        ]);
    }

    public function getKabupaten(Request $request)
    {
        $provinsi = $request->input('provinsi');
        $search = $request->input('q');

        $query = Kabupaten::query();
        if ($provinsi) {
            $query->where('kode_provinsi', $provinsi);
        }
        if ($search) {
            $query->where('nama_kabupaten', 'like', "%{$search}%");
        }

        $results = $query->orderBy('nama_kabupaten')->limit(20)->get();

        return response()->json([
            'results' => $results->map(fn ($item) => [
                'id' => $item->kode_kabupaten,
                'text' => $item->nama_kabupaten,
            ]),
        ]);
    }

    public function getKecamatan(Request $request)
    {
        $kabupaten = $request->input('kabupaten');
        $search = $request->input('q');

        $query = Kecamatan::query();
        if ($kabupaten) {
            $query->where('kode_kabupaten', $kabupaten);
        }
        if ($search) {
            $query->where('nama_kecamatan', 'like', "%{$search}%");
        }

        $results = $query->orderBy('nama_kecamatan')->limit(20)->get();

        return response()->json([
            'results' => $results->map(fn ($item) => [
                'id' => $item->kode_kecamatan,
                'text' => $item->nama_kecamatan,
            ]),
        ]);
    }

    public function getKelurahan(Request $request)
    {
        $kecamatan = $request->input('kecamatan');
        $search = $request->input('q');

        $query = Kelurahan::query();
        if ($kecamatan) {
            $query->where('kode_kecamatan', $kecamatan);
        }
        if ($search) {
            $query->where('nama_desa', 'like', "%{$search}%");
        }

        $results = $query->orderBy('nama_desa')->limit(20)->get();

        return response()->json([
            'results' => $results->map(fn ($item) => [
                'id' => $item->kode_desa,
                'text' => $item->nama_desa,
            ]),
        ]);
    }
}
