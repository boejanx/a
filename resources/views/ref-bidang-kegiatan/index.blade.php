    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Bidang Kegiatan</h4>
        <button type="button" class="btn btn-primary" id="btn-tambah">+ Tambah Data</button>
    </div>

    <div id="alert-container"></div>

    <table class="table table-bordered" id="table-bidang">
        <thead class="table-light">
            <tr>
                <th>ID</th>
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
                    <h5 class="modal-title" id="modalLabel">Tambah Bidang Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formBidang">
                    @csrf
                    <input type="hidden" id="bidang_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Bidang Kegiatan</label>
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

@push('js')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables CSS & JS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        let table;
        let modal;

        // Inisialisasi DataTable dengan Yajra
        function initTable() {
            table = $('#table-bidang').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('bidang-kegiatan.data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%', orderable: false, searchable: false },
                    { data: 'nama', name: 'nama' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
                ],
                order: [[1, 'asc']],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
        }

        // Buka modal tambah/edit
        function openModal(id = null, nama = '') {
            document.getElementById('modalLabel').innerText = id ? 'Edit Bidang Kegiatan' : 'Tambah Bidang Kegiatan';
            document.getElementById('bidang_id').value = id || '';
            document.getElementById('nama').value = nama || '';
            document.getElementById('error-nama').innerText = '';
            document.getElementById('nama').classList.remove('is-invalid');

            if (!modal) {
                modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('formModal'));
            }
            modal.show();
        }

        // Event DOM Ready
        $(document).ready(function () {
            initTable();

            // Tombol Tambah
            $('#btn-tambah').on('click', function () {
                openModal();
            });

            // Edit
            $(document).on('click', '.btn-edit', function () {
                const id = $(this).data('id');
                const nama = $(this).data('nama');
                openModal(id, nama);
            });

            // Delete
            $(document).on('click', '.btn-delete', function () {
                const id = $(this).data('id');
                if (confirm('Yakin ingin menghapus data ini?')) {
                    axios.delete(`{{ url('bidang-kegiatan') }}/${id}`, {
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

            // Submit form
            $('#formBidang').on('submit', function (e) {
                e.preventDefault();
                const id = $('#bidang_id').val();
                const url = id ? `{{ url('bidang-kegiatan') }}/${id}` : "{{ route('bidang-kegiatan.store') }}";
                const method = id ? 'put' : 'post';
                const nama = $('#nama').val();

                axios({
                    method: method,
                    url: url,
                    data: { nama: nama },
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
                    if (errors?.nama) {
                        $('#error-nama').text(errors.nama[0]);
                        $('#nama').addClass('is-invalid');
                    } else {
                        showToast('Terjadi kesalahan.', 'danger');
                    }
                });
            });

            // Reset error saat modal dibuka
            $('#formModal').on('show.bs.modal', function () {
                $('#error-nama').text('');
                $('#nama').removeClass('is-invalid');
            });

            // Reset form saat modal ditutup
            $('#formModal').on('hidden.bs.modal', function () {
                $('#formBidang')[0].reset();
                $('#bidang_id').val('');
            });
        });

        // Toast
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