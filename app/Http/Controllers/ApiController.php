<?php

namespace App\Http\Controllers;

use App\Models\OrmasModel;
use App\Models\Legalitas;
use App\Models\Pengurus;
use App\Models\Aset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;


class ApiController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'om_nama'         => 'required|string|max:200',
            'om_singkatan'    => 'nullable|string|max:100',
            'om_bidang'       => 'required|string|max:15',
            'om_jenis'        => 'required|string|max:15',
            'om_alamat_prov'  => 'required|string|max:15',
            'om_alamat_kab'   => 'required|string|max:15',
            'om_alamat_kec'   => 'required|string|max:15',
            'om_alamat_kel'   => 'required|string|max:15',
            'om_alamat_jl'    => 'nullable|string|max:100',
            'om_visi'         => 'nullable|string',
            'om_misi'         => 'nullable|string',
            'om_telepon'      => 'nullable|string|max:15',
            'om_kta'          => 'nullable|string|max:10',
            'om_sumber_dana'  => 'nullable|string',
            'om_npwp'         => 'nullable|string|max:50',
            'om_asas_ciri'    => 'nullable|string',
            'om_lambang'      => 'nullable|string|max:36',
            'om_bendera'      => 'nullable|string|max:36',
            'om_stempel'      => 'nullable|string|max:36',
            'om_catatan'      => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = OrmasModel::create($request->all());
        return response()->json([
            'message'   => 'Data ormas berhasil disimpan',
            'ormas_id'  => $data->ormas_id,
            'data'      => $data
        ], 201);
    }

    public function legalitas(Request $request)
    {
        $validated = $request->validate([
            'ormas_id' => 'required|uuid|exists:db_profil_ormas,ormas_id',
            'bh_tbh' => 'required|in:Y,T',
            'notaris_nama' => 'nullable|string|max:100',
            'notaris_nomor' => 'nullable|string|max:50',
            'notaris_tanggal' => 'nullable|date',
            'surat_permohonan_nomor' => 'nullable|string|max:50',
            'surat_permohonan_tanggal' => 'nullable|date',
            'sk_pengurus_nama' => 'nullable|string|max:100',
            'sk_pengurus_nomor' => 'nullable|string|max:50',
            'sk_pengurus_tanggal' => 'nullable|date',
            'skko_no_ajuan' => 'nullable|string|max:50',
            'skko_no_registrasi' => 'nullable|string|max:50',
            'skko_tanggal_surat' => 'nullable|date',
            'skko_tanggal_expired' => 'nullable|date',
            'sk_kemenkumham_no' => 'nullable|string|max:50',
            'sk_kemenkumham_tanggal' => 'nullable|date',
            'doc_notaris' => 'nullable|string|max:36',
            'doc_kepengurusan' => 'nullable|string|max:36',
            'doc_kemenkumham' => 'nullable|string|max:36',
            'doc_permohonan' => 'nullable|string|max:36',
            'doc_skko' => 'nullable|string|max:36',
        ]);

        $validated['legalitas_id'] = Str::uuid();

        $legalitas = Legalitas::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data legalitas berhasil disimpan',
            'legalitas_id' => $legalitas->legalitas_id,
        ]);
    }

    public function pengurus(Request $request)
    {
        $validated = $request->validate([
            'jabatan' => 'required|string|max:50',
            'ormas_id' => 'required|uuid|exists:db_profil_ormas,ormas_id',
            'nik' => 'required|string|max:32',
            'nama' => 'required|string|max:100',
            'jk' => 'required|in:L,P',
            'agama' => 'required',
            'kewarganegaraan' => 'required',
            'status_perkawinan' => 'required',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'telepon' => 'nullable|max:14',
            'pekerjaan' => 'nullable|string|max:50',
        ]);

        $validated['pengurus_id'] = (string) Str::uuid();
        $validated['status'] = 'aktif';

        Pengurus::create($validated);

        return response()->json(['message' => 'Success']);
    }

    function get_pengurus(Request $request)
    {
        if ($request->ajax()) {
            $query = Pengurus::where('ormas_id', $request->ormas_id);

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-sm btn-warning btn-edit" data-id="' . $row->pengurus_id . '">Edit</button>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->pengurus_id . '">Hapus</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function delete_pengurus(Request $request)
    {
        $pengurus = Pengurus::findOrFail($request->id);
        $pengurus->delete();

        return response()->json(['message' => 'Pengurus berhasil dihapus']);
    }

    public function update_pengurus(Request $request)
    {
        $pengurus = Pengurus::findOrFail($request->id);
        $pengurus->update($request->all());

        return response()->json(['message' => 'Pengurus berhasil diperbarui']);
    }

    public function get_pengurus_by_id($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        return response()->json($pengurus);
    }

    public function getAset(Request $request)
    {
        if ($request->ajax()) {
            $query = Aset::where('ormas_id', $request->ormas_id);

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->aset_id . '">Hapus</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    // Simpan aset baru
    public function storeAset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ormas_id' => 'required|string|exists:db_profil_ormas,ormas_id',
            'aset_nama' => 'required|string|max:100',
            'aset_jumlah' => 'required|numeric',
            'aset_kepemilikan' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $aset = Aset::create($request->all());

        return response()->json(['status' => true, 'data' => $aset]);
    }

    // Detail aset
    public function showAset($id)
    {
        $aset = Aset::find($id);
        if (!$aset) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['status' => true, 'data' => $aset]);
    }

    // Hapus aset (soft delete)
    public function deleteAset($id)
    {
        $aset = Aset::find($id);
        if (!$aset) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $aset->delete();

        return response()->json(['status' => true, 'message' => 'Data berhasil dihapus']);
    }
}
