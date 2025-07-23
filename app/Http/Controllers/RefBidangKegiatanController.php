<?php

namespace App\Http\Controllers;

use App\Models\RefBidangKegiatan;
use Illuminate\Http\Request;

class RefBidangKegiatanController extends Controller
{
    /**
     * Menyediakan data untuk Select2
     */
    public function select2(Request $request)
    {
        $search = $request->input('q'); 

        $query = RefBidangKegiatan::query();

        if ($search) {
            $query->where('nama', 'like', "%{$search}%");
        }

        $data = $query->orderBy('nama')->limit(20)->get();

        return response()->json([
            'results' => $data->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->nama,
                ];
            }),
        ]);
    }
}
