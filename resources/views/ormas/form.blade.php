@extends('layouts.app')

@section('page-title', isset($ormas) ? 'Edit Ormas' : 'Tambah Ormas')

@section('content-main')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ isset($ormas) ? route('ormas.update', $ormas->id) : route('ormas.store') }}">
            @csrf
            @if(isset($ormas))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label>Nama Ormas</label>
                <input type="text" name="nama_ormas" class="form-control" value="{{ old('nama_ormas', $ormas->nama_ormas ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label>Kecamatan</label>
                <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan', $ormas->kecamatan ?? '') }}">
            </div>
            <div class="mb-3">
                <label>Berlaku SKKO</label>
                <input type="date" name="berlaku_skko" class="form-control" value="{{ old('berlaku_skko', isset($ormas) ? $ormas->berlaku_skko->format('Y-m-d') : '') }}">
            </div>
            <div class="mb-3">
                <label>Ketua</label>
                <input type="text" name="ketua" class="form-control" value="{{ old('ketua', $ormas->ketua ?? '') }}">
            </div>
            <!-- Tambahkan field lainnya sesuai kebutuhan -->

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('ormas.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
