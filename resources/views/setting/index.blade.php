@extends('layouts.app')

@section('page-title', 'Settings')

@section('content-main')

    <div class="row">
        <!-- Bidang Kegiatan -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Bidang Kegiatan</h5>
                </div>
                <div class="card-body">
                    @include('ref-bidang-kegiatan.table')
                </div>
            </div>
        </div>

        <!-- Jenis Kelembagaan -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Jenis Kelembagaan</h5>
                </div>
                <div class="card-body">
                    @include('ref-jenis-kelembagaan.table')
                </div>
            </div>
        </div>
    </div>

    <!-- Modal akan dimasukkan sekali, tapi dua versi -->
    @include('ref-bidang-kegiatan.modal')
    @include('ref-jenis-kelembagaan.modal')
@endsection
@push('js')
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Fungsi untuk mengelola modal dan datatable secara umum
        const setupModal = (config) => {
            const {
                modalId,
                formId,
                tableId,
                dataUrl,
                columns,
                addBtnId,
                editBtnClass,
                entityName,
                fields,
                deleteBtnClass, // Tambahkan parameter ini
                baseUrl // Kita akan butuh ini untuk URL hapus
            } = config;

            let table = $(`#${tableId}`).DataTable({
                processing: true,
                serverSide: true,
                ajax: dataUrl,
                columns: columns,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });

            const modal = new bootstrap.Modal(document.getElementById(modalId));
            const form = $(`#${formId}`);
            const modalTitle = $(`#${modalId} .modal-title`);

            const resetForm = () => {
                form[0].reset();
                form.find('input[type=hidden]').val('');
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.invalid-feedback').text('');
            };

            $(`#${addBtnId}`).on('click', () => {
                resetForm();
                modalTitle.text(`Tambah ${entityName}`);
                modal.show();
            });

            $(document).on('click', `.${editBtnClass}`, function() {
                resetForm();
                modalTitle.text(`Edit ${entityName}`);
                const data = $(this).data();
                form.find('input[type=hidden]').val(data.id);
                fields.forEach(field => form.find(`#${config.prefix}_${field}`).val(data[field]));
                modal.show();
            });

            form.on('submit', (e) => {
                e.preventDefault();
                const id = form.find('input[type=hidden]').val();
                const url = id ? `${config.baseUrl}/${id}` : config.storeUrl;
                const method = id ? 'put' : 'post';
                let data = {};
                fields.forEach(field => data[field] = $(`#${config.prefix}_${field}`).val());

                axios({
                        method, url, data
                    })
                    .then(res => {
                        modal.hide();
                        table.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    })
                    .catch(err => {
                        const errors = err.response?.data?.errors;
                        if (errors) {
                            form.find('.is-invalid').removeClass('is-invalid');
                            form.find('.invalid-feedback').text('');
                            Object.keys(errors).forEach(key => {
                                $(`#${config.prefix}_${key}`).addClass('is-invalid');
                                $(`#error-${config.prefix}-${key}`).text(errors[key][0]);
                            });
                        } else {
                            const message = err.response?.data?.message || 'Terjadi kesalahan.';
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: message
                            });
                        }
                    });
            });

            $(`#${modalId}`).on('hidden.bs.modal', resetForm);

            // Tambahkan event listener untuk tombol hapus
            $(document).on('click', `.${deleteBtnClass}`, function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Data ${entityName} yang dihapus tidak dapat dikembalikan!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus saja!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`${baseUrl}/${id}`)
                            .then(res => {
                                table.ajax.reload();
                                Swal.fire(
                                    'Dihapus!',
                                    res.data.message,
                                    'success'
                                );
                            })
                            .catch(err => {
                                const message = err.response?.data?.message || 'Terjadi kesalahan saat menghapus data.';
                                Swal.fire('Gagal!', message, 'error');
                            });
                    }
                });
            });
        };

        $(document).ready(() => {
            // Konfigurasi untuk Bidang Kegiatan
            setupModal({
                modalId: 'modalBidang',
                formId: 'formBidang',
                tableId: 'table-bidang',
                dataUrl: "{{ route('bidang-kegiatan.data') }}",
                storeUrl: "{{ route('bidang-kegiatan.store') }}",
                baseUrl: "{{ url('bidang-kegiatan') }}",
                columns: [{
                    data: 'id',
                    width: '5%'
                }, {
                    data: 'nama'
                }, {
                    data: 'aksi',
                    orderable: false,
                    searchable: false
                }],
                addBtnId: 'btn-tambah-bidang',
                editBtnClass: 'btn-edit-bidang',
                deleteBtnClass: 'btn-delete-bidang',
                entityName: 'Bidang Kegiatan',
                prefix: 'bidang',
                fields: ['nama']
            });

            // Konfigurasi untuk Jenis Kelembagaan
            setupModal({
                modalId: 'modalJenis',
                formId: 'formJenis',
                tableId: 'table-jenis',
                dataUrl: "{{ route('jenis-kelembagaan.data') }}",
                storeUrl: "{{ route('jenis-kelembagaan.store') }}",
                baseUrl: "{{ url('jenis-kelembagaan') }}",
                columns: [{
                    data: 'id',
                    width: '5%'
                }, {
                    data: 'nama'
                }, {
                    data: 'aksi',
                    orderable: false,
                    searchable: false
                }],
                addBtnId: 'btn-tambah-jenis',
                editBtnClass: 'btn-edit-jenis',
                deleteBtnClass: 'btn-delete-jenis',
                entityName: 'Jenis Kelembagaan',
                prefix: 'jenis',
                fields: ['kode', 'nama']
            });
        });
    </script>
@endpush