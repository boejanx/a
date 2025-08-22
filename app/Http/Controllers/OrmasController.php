<?php

namespace App\Http\Controllers;

use App\Models\Ormas;
use App\Models\OrmasModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use App\Exports\OrmasExport;

class OrmasController extends Controller
{

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = OrmasModel::with(['ketua', 'kecamatan']);

            // Filter Nama Ormas (opsional)
            if ($request->filled('nama_ormas')) {
                $data->where('om_nama', 'like', '%' . $request->nama_ormas . '%');
            }

            // Filter Dropdown Kecamatan (pakai kode om_alamat_kec)
            if ($request->filled('kecamatan_id')) {
                $data->where('om_alamat_kec', $request->kecamatan_id);
            }

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('nama_ketua', fn($row) => $row->ketua->nama ?? '-')
                ->addColumn('nama_kecamatan', fn($row) => $row->kecamatan->nama_kecamatan ?? '-')
                ->editColumn('status', fn($row) => ucfirst($row->status))
                ->addColumn('action', function ($row) {
                    $editUrl = route('ormas.edit', $row->ormas_id);
                    $deleteUrl = route('ormas.destroy', $row->ormas_id);
                    return view('ormas.partials.actions', compact('editUrl', 'deleteUrl'))->render();
                })
                ->make(true);
        }
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Ambil data dengan eager loading
            $data = OrmasModel::with(['ketua', 'kecamatan']);

            if ($request->filled('nama_ormas')) {
                $data->where('om_nama', 'like', '%' . $request->nama_ormas . '%');
            }

            // Filter Dropdown Kecamatan (pakai kode om_alamat_kec)
            if ($request->filled('kecamatan_id')) {
                $data->where('om_alamat_kec', $request->kecamatan_id);
            }


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

        // Get data for info boxes
        $totalOrmas = OrmasModel::count();

        // Hitung berbadan hukum berdasarkan relasi ke tabel legalitas
        $berbadanHukum = OrmasModel::whereHas('legalitas', function ($query) {
            $query->where('bh_tbh', 'Y');
        })->count();

        // Tidak berbadan hukum adalah sisanya
        $tidakBerbadanHukum = $totalOrmas - $berbadanHukum;

        // Get kecamatan data for export filter
        $kecamatans = \App\Models\Kecamatan::orderBy('nama_kecamatan')->get();

        return view('ormas.index', compact('totalOrmas', 'berbadanHukum', 'tidakBerbadanHukum', 'kecamatans'));
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

        return view('ormas.edit', [
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

    public function export(Request $request)
    {
        $kecamatan = $request->get('kecamatan');
        $jenis = $request->get('jenis');

        return Excel::download(new OrmasExport($kecamatan, $jenis), 'data_ormas.xlsx');
    }
}
