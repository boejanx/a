<?php

namespace App\Http\Controllers;

use App\Models\RefBidangKegiatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RefBidangKegiatanController extends Controller
{
    public function index()
    {
        return view('ref-bidang-kegiatan.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = RefBidangKegiatan::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    return '
                        <button class="btn btn-sm btn-warning btn-edit-bidang" 
                                data-id="' . $row->id . '" 
                                data-nama="' . e($row->nama) . '">
                                Edit
                        </button>
                        <button class="btn btn-sm btn-danger btn-delete-bidang" 
                                data-id="' . $row->id . '">
                                Hapus
                        </button>';
                })
                ->rawColumns(['aksi']) // agar HTML di kolom aksi tidak di-escape
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:ref_bidang_kegiatan,nama',
        ]);

        $bidang = RefBidangKegiatan::create($request->only('nama'));

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan.',
            'data' => $bidang
        ]);
    }

    public function update(Request $request, $id)
    {
        $bidang = RefBidangKegiatan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255|unique:ref_bidang_kegiatan,nama,' . $id,
        ]);

        $bidang->update($request->only('nama'));

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui.',
            'data' => $bidang
        ]);
    }

    public function destroy($id)
    {
        $bidang = RefBidangKegiatan::findOrFail($id);
        $bidang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
    }

    public function select2(Request $request)
    {
        $search = $request->input('q');
        $data = RefBidangKegiatan::when($search, fn($q) => $q->where('nama', 'like', "%{$search}%"))
            ->orderBy('nama')
            ->limit(20)
            ->get()
            ->map(fn($item) => ['id' => $item->id, 'text' => $item->nama]);

        return response()->json(['results' => $data]);
    }
}