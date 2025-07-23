<?php

namespace App\Http\Controllers;

use App\Models\RefJenisKelembagaan;
use Illuminate\Http\Request;

class RefJenisKelembagaanController extends Controller
{
    /**
     * Endpoint untuk Select2
     */
    public function select2(Request $request)
    {
        $search = $request->input('q');

        $query = RefJenisKelembagaan::query();

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
