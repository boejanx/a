<?php

namespace App\Http\Controllers;

use App\Models\RefJenisKelembagaan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RefJenisKelembagaanController extends Controller
{
    public function index()
    {
        return view('ref-jenis-kelembagaan.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = RefJenisKelembagaan::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    return '
                        <button class="btn btn-sm btn-warning btn-edit-jenis"
                                data-id="' . $row->id . '"
                                data-kode="' . e($row->kode) . '"
                                data-nama="' . e($row->nama) . '">
                                Edit
                        </button>
                        <button class="btn btn-sm btn-danger btn-delete-jenis" data-id="' . $row->id . '">
                                Hapus
                        </button>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:ref_jenis_kelembagaan,nama',
        ]);

        $jenis = RefJenisKelembagaan::create($request->only('kode', 'nama'));

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan.',
            'data' => $jenis
        ]);
    }

    public function update(Request $request, $id)
    {
        $jenis = RefJenisKelembagaan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255|unique:ref_jenis_kelembagaan,nama,' . $id,
        ]);

        $jenis->update($request->only('kode', 'nama'));

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui.',
            'data' => $jenis
        ]);
    }

    public function destroy($id)
    {
        $jenis = RefJenisKelembagaan::findOrFail($id);
        $jenis->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
    }

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
