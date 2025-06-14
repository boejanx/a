<?php

namespace App\Http\Controllers;

use App\Models\Ormas;
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
                    } elseif ($request->status === 'tidak_aktif') {
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
            $data = Ormas::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return $row->berlaku_skko < now() ? '<span class="badge bg-danger">Tidak Aktif</span>' : '<span class="badge bg-success">Aktif</span>';
                })
                ->addColumn('action', function ($row) {
                    return view('ormas.partials.actions', compact('row'))->render();
                })
                ->rawColumns(['status', 'action'])
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

    public function edit($id)
    {
        $ormas = Ormas::findOrFail($id);
        return view('ormas.form', compact('ormas'));
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
