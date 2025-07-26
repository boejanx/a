<?php

namespace App\Http\Controllers;

use App\Models\Ormas;
use App\Models\OrmasModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class OrmasController extends Controller
{

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Ormas::query();

            // Filter Nama Ormas
            if ($request->filled('nama_ormas')) {
                $data->where('nama_ormas', 'like', '%' . $request->nama_ormas . '%');
            }

            // Filter Status
            if ($request->filled('status')) {
                $data->where(function ($q) use ($request) {
                    $today = Carbon::today();
                    if ($request->status === 'aktif') {
                        $q->whereDate('berlaku_skko', '>=', $today);
                    } elseif ($request->status === 'Kadaluarsa') {
                        $q->whereDate('berlaku_skko', '<', $today);
                    }
                });
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $today = Carbon::today();
                    return Carbon::parse($row->berlaku_skko)->lt($today)
                        ? '<span class="badge bg-danger">Tidak Aktif</span>'
                        : '<span class="badge bg-success">Aktif</span>';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="/ormas/' . $row->id . '" class="btn btn-sm btn-info">Detail</a>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Ambil data dengan eager loading
            $data = OrmasModel::with(['ketua', 'kecamatan']);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_ketua', function ($row) {
                    return $row->ketua->nama ?? '-';
                })
                ->addColumn('nama_kecamatan', function ($row) {
                    return $row->kecamatan->nama_kecamatan ?? '-';
                })
                ->editColumn('om_nama', fn($row) => $row->om_nama)
                ->editColumn('om_singkatan', fn($row) => $row->om_singkatan)
                ->addColumn('action', function ($row) {
                    $editUrl = route('ormas.edit', $row->ormas_id);
                    $deleteUrl = route('ormas.destroy', $row->ormas_id);
                    return view('ormas.partials.actions', compact('editUrl', 'deleteUrl'))->render();
                })
                ->make(true);
        }

        return view('ormas.index');
    }


    public function showdata($id)
    {
        $ormas = Ormas::findOrFail($id);
        return response()->json($ormas);
    }

    public function show($id)
    {
        $ormas = Ormas::findOrFail($id);
        return view('ormas.show', compact('ormas'));
    }


    public function create()
    {
        return view('ormas.form');
    }

    public function edit($id = null)
    {
        $ormas = null;

        if ($id) {
            $ormas = OrmasModel::with(['legalitas'])->findOrFail($id);
        }

        return view('ormas.form', [
            'ormas' => $ormas,
            'isEdit' => true,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ormas' => 'required|string|max:255',
            'berlaku_skko' => 'nullable|date',
        ]);

        Ormas::create($request->all());

        return redirect()->route('ormas.index')->with('success', 'Data ormas berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ormas' => 'required|string|max:255',
            'berlaku_skko' => 'nullable|date',
        ]);

        Ormas::update($request->all());

        return redirect()->route('ormas.index')->with('success', 'Data ormas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Ormas::destroy($id);


        //dd('Data ormas berhasil dihapus!');

        return redirect()->route('ormas.index')->with('success', 'Data ormas berhasil dihapus.');
    }
}
