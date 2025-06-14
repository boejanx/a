@extends('layouts.app')

@section('page-title', 'Detail Ormas')

@section('content-main')
<div class="card">
    <div class="card-header">
        <h5>{{ $ormas->nama_ormas }}</h5>
    </div>
    <div class="card-body">
        <p><strong>Kecamatan:</strong> {{ $ormas->kecamatan }}</p>
        <p><strong>Ketua:</strong> {{ $ormas->ketua }}</p>
        <p><strong>Berlaku SKKO:</strong> {{ $ormas->berlaku_skko?->format('d-m-Y') }}</p>
        <p><strong>Status:</strong>
            @if($ormas->berlaku_skko < now())
                <span class="badge bg-danger">Tidak Aktif</span>
            @else
                <span class="badge bg-success">Aktif</span>
            @endif
        </p>
        <!-- Tambahkan info lainnya -->
        <a href="{{ route('ormas.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
