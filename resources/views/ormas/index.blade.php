@extends('layouts.app')

@section('page-title', 'Manajemen Ormas')

@section('content-main')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Ormas</h3>
        <a href="{{ route('ormas.create') }}" class="btn btn-primary float-end">Tambah Ormas</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="ormas-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Ormas</th>
                    <th>Kecamatan</th>
                    <th>Ketua</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
$(function () {
    $('#ormas-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ormas.index') }}",
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_ormas', name: 'nama_ormas' },
            { data: 'kecamatan', name: 'kecamatan' },
            { data: 'ketua', name: 'ketua' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});
</script>
@endsection
