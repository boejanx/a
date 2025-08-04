@extends('layouts.app')

@section('page-title', 'Jenis Kelembagaan')

@section('content-main')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Jenis Kelembagaan</h4>
        <button type="button" class="btn btn-primary" id="btn-tambah">+ Tambah Data</button>
    </div>

    <div id="alert-container"></div>

    <table class="table table-bordered" id="table-jenis">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>

    <!-- Modal Tambah/Edit -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Tambah Jenis Kelembagaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formJenis">
                    @csrf
                    <input type="hidden" id="jenis_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode" required maxlength="10">
                            <div class="invalid-feedback" id="error-kode"></div>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                            <div class="invalid-feedback" id="error-nama"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        let table;
        let modal;

        function initTable() {
            table = $('#table-jenis').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('jenis-kelembagaan.data') }}",
                columns: [
                    {  'DT_RowIndex', width: '5%', orderable: false, searchable: false },
                    {  'kode' },
                    {  'nama' },
                    {  'aksi', orderable: false, searchable: false }
                ],
                order: [[2, 'asc']],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
        }

        function openModal(id = null, kode = '', nama = '') {
            document.getElementById('modalLabel').innerText = id ? 'Edit Jenis Kelembagaan' : 'Tambah Jenis Kelembagaan';
            document.getElementById('jenis_id').value = id || '';
            document.getElementById('kode').value = kode || '';
            document.getElementById('nama').value = nama || '';
            document.getElementById('error-kode').innerText = '';
            document.getElementById('error-nama').innerText = '';
            document.getElementById('kode').classList.remove('is-invalid');
            document.getElementById('nama').classList.remove('is-invalid');

            if (!modal) {
                modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('formModal'));
            }
            modal.show();
        }

        $(document).ready(function () {
            initTable();

            $('#btn-tambah').on('click', function () {
                openModal();
            });

            $(document).on('click', '.btn-edit', function () {
                const id = $(this).data('id');
                const kode = $(this).data('kode');
                const nama = $(this).data('nama');
                openModal(id, kode, nama);
            });

            $(document).on('click', '.btn-delete', function () {
                const id = $(this).data('id');
                if (confirm('Yakin ingin menghapus data ini?')) {
                    axios.delete(`{{ url('jenis-kelembagaan') }}/${id}`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(() => {
                        showToast('Data berhasil dihapus.');
                        table.ajax.reload(null, false);
                    })
                    .catch(() => showToast('Gagal menghapus data.', 'danger'));
                }
            });

            $('#formJenis').on('submit', function (e) {
                e.preventDefault();
                const id = $('#jenis_id').val();
                const url = id ? `{{ url('jenis-kelembagaan') }}/${id}` : "{{ route('jenis-kelembagaan.store') }}";
                const method = id ? 'put' : 'post';
                const kode = $('#kode').val();
                const nama = $('#nama').val();

                axios({
                    method: method,
                    url: url,
                    data: { kode, nama },
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(res => {
                    showToast(res.data.message);
                    modal.hide();
                    table.ajax.reload(null, false);
                })
                .catch(err => {
                    const errors = err.response?.data?.errors;
                    if (errors?.kode) {
                        $('#error-kode').text(errors.kode[0]);
                        $('#kode').addClass('is-invalid');
                    }
                    if (errors?.nama) {
                        $('#error-nama').text(errors.nama[0]);
                        $('#nama').addClass('is-invalid');
                    }
                });
            });

            $('#formModal').on('show.bs.modal', function () {
                $('#error-kode, #error-nama').text('');
                $('#kode, #nama').removeClass('is-invalid');
            });

            $('#formModal').on('hidden.bs.modal', function () {
                $('#formJenis')[0].reset();
                $('#jenis_id').val('');
            });
        });

        function showToast(message, type = 'success') {
            const container = document.getElementById('alert-container');
            const alert = document.createElement('div');
            alert.className = `alert alert-${type} alert-dismissible fade show mt-2`;
            alert.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            container.appendChild(alert);
            setTimeout(() => alert.remove(), 3000);
        }
    </script>
@endpush