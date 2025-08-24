@extends('layouts.app')

@section('page-title', 'Data Ormas')

@section('content-main')
    @php
        $isEdit = isset($ormas);
    @endphp

    <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                <li class="pt-2 px-3 bg-success">
                    <h3 class="card-title">{{ $ormas->om_nama }}</h3>
                </li>
                <li class="nav-item">
                    <a aria-controls="custom-tabs-two-home" class="nav-link active" data-toggle="pill" href="#custom-tabs-two-home" id="custom-tabs-two-home-tab" role="tab"> <i class="fas fa-home"></i>
                        Data Utama</a>
                </li>
                <li class="nav-item">
                    <a aria-controls="custom-tabs-two-profile" class="nav-link" data-toggle="pill" href="#custom-tabs-two-profile" id="custom-tabs-two-profile-tab" role="tab"> <i
                            class="fas fa-id-card "></i> Data Legalitas</a>
                </li>
                <li class="nav-item">
                    <a aria-controls="custom-tabs-two-messages" class="nav-link" data-toggle="pill" href="#custom-tabs-two-messages" id="custom-tabs-two-messages-tab" role="tab"> <i
                            class="fas fa-users"></i> Data Pengurus</a>
                </li>
                <li class="nav-item">
                    <a aria-controls="custom-tabs-two-settings" class="nav-link" data-toggle="pill" href="#custom-tabs-two-settings" id="custom-tabs-two-settings-tab" role="tab"><i
                            class="fas fa-building"></i>Data Aset</a>
                </li>
                <li class="nav-item">
                    <a aria-controls="tab-dokumen" class="nav-link" data-toggle="pill" href="#tab-dokumen" id="tab-dokumen-tab" role="tab"><i class="fas fa-cog"></i> Dokumen Ormas</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-two-tabContent">
                <div aria-labelledby="custom-tabs-two-home-tab" class="tab-pane fade show active row" id="custom-tabs-two-home" role="tabpanel">
                    @include('ormas.partials.1', ['isEdit' => $isEdit, 'ormas' => $ormas ?? null])
                    <div class="text-center">
                        <button class="btn btn-success" id="update-data-utama"><i class="fas fa-save"></i> Perbaharui Data</button>
                    </div>
                </div>
                <div aria-labelledby="custom-tabs-two-profile-tab" class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel">
                    @include('ormas.partials.2', ['isEdit' => $isEdit, 'ormas' => $ormas ?? null])
                    <div class="text-center">
                        <button class="btn btn-success" id="update-data-legalitas"><i class="fas fa-save"></i> Perbaharui Data Legalitas</button>
                    </div>
                </div>
                <div aria-labelledby="custom-tabs-two-messages-tab" class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel">
                    @include('ormas.partials.3', ['isEdit' => $isEdit, 'ormas' => $ormas ?? null])
                </div>
                <div aria-labelledby="custom-tabs-two-settings-tab" class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel">
                    @include('ormas.partials.4', ['isEdit' => $isEdit, 'ormas' => $ormas ?? null])
                </div>
                <div aria-labelledby="tab-dokumen" class="tab-pane fade" id="tab-dokumen" role="tabpanel">
                    @include('ormas.partials.5', ['isEdit' => $isEdit, 'ormas' => $ormas ?? null])
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>

@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" rel="stylesheet">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/select2-bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/waitme@1.19.0/waitMe.min.css" rel="stylesheet">
    <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css"
        integrity="sha512-blbRKbSIVjplNrngvZa2X9fOUSBeqpa8pO5HFM4X0E5XyGCN0pcDhvfB4pTof/6F4mk7XxTlM2amhUcTvNIiUw==" referrerpolicy="no-referrer" rel="stylesheet" />
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/waitme@1.19.0/waitMe.min.js"></script>
    <script src="{{ asset('assets/js/1.js') }}"></script>
    <script>
        let ormasId = "{{ $ormas->ormas_id ?? '' }}"; // Ambil ID Ormas jika ada
        $("#satuan").select2({
            placeholder: 'Pilih Satuan',
            theme: 'bootstrap4',
            dropdownParent: $('#modalAset'),

        });
        $(".tanggal").flatpickr({
            dateFormat: "Y-m-d",
            allowInput: false,
            altInput: true,
            altFormat: "d F Y",
            locale: {

                weekdays: {
                    shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                    longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
                },
                months: {
                    shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
                },
                firstDayOfWeek: 1 // Setel hari pertama minggu ke Senin
            }

        });

        function getPengurus() {
            if ($.fn.DataTable.isDataTable('#table-pengurus')) {
                $('#table-pengurus').DataTable().clear().destroy();
            }

            $("#table-pengurus").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,

                ajax: {
                    url: "{{ route('pengurus.get') }}",
                    type: "GET",
                    data: {
                        ormas_id: ormasId, // sisipkan data di sini
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // <--- pastikan CSRF token dikirim
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'pekerjaan',
                        name: 'pekerjaan'
                    },
                    {
                        data: 'telepon',
                        name: 'telepon'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        }

        function getAset() {
            if ($.fn.DataTable.isDataTable('#tableAset')) {
                $('#tableAset').DataTable().clear().destroy();
            }
            $("#tableAset").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('aset.index') }}",
                    type: "GET",
                    data: {
                        ormas_id: ormasId, // sisipkan data di sini
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // <--- pastikan CSRF token dikirim
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'aset_nama'
                    },
                    {
                        data: 'aset_jumlah'
                    },
                    {
                        data: 'aset_kepemilikan'
                    },
                    {
                        data: 'aset_id',
                        render: function(id) {
                            return `
                    <button class="btn btn-sm btn-danger btn-hapus" data-id="${id}">Hapus</button>
                `;
                        },
                        orderable: false
                    }
                ]
            });
        }

        function loader() {
            $('body').waitMe({
                effect: 'ios',
                text: 'Menyimpan data...',
                bg: 'rgba(255,255,255,0.7)',
                color: '#000',
                maxSize: '',
                source: '',
                waitTime: -1,
                textPos: 'vertical',
                fontSize: '',
            });
        }

        function getOrmas() {
            $.ajax({
                url: `/api/data-ormas/${ormasId}`,
                method: "GET",
                success: function(data) {
                    // Input biasa
                    $('input[name="om_nama"]').val(data.om_nama);
                    $('input[name="om_singkatan"]').val(data.om_singkatan);
                    $('input[name="om_alamat_jl"]').val(data.om_alamat_jl);
                    $('input[name="alamat_rt"]').val(data.om_alamat_jl.match(/RT\s*(\d+)/i)?.[1] || '');
                    $('input[name="alamat_rw"]').val(data.om_alamat_jl.match(/RW\s*(\d+)/i)?.[1] || '');
                    $('input[name="om_telepon"]').val(data.om_telepon);
                    $('input[name="om_npwp"]').val(data.om_npwp);
                    $('input[name="om_asas_ciri"]').val(data.om_asas_ciri);
                    $('textarea[name="om_misi"]').val(data.om_misi);
                    $('textarea[name="om_catatan"]').val(data.om_catatan);

                    // Select biasa
                    $('select[name="om_kta"]').val(data.om_kta).trigger('change');
                    $('select[name="om_sumber_dana"]').val(data.om_sumber_dana).trigger('change');

                    // Select2 wilayah - langsung append option + select
                    $('select[name="om_alamat_prov"]').append(new Option(data.om_alamat_prov_text, data.om_alamat_prov, true, true)).trigger('change');
                    $('select[name="om_alamat_kab"]').append(new Option(data.om_alamat_kab_text, data.om_alamat_kab, true, true)).trigger('change');
                    $('select[name="om_alamat_kec"]').append(new Option(data.om_alamat_kec_text, data.om_alamat_kec, true, true)).trigger('change');
                    $('select[name="om_alamat_kel"]').append(new Option(data.om_alamat_kel_text, data.om_alamat_kel, true, true)).trigger('change');
                    $('select[name="om_jenis"]').append(
                        new Option(data.om_jenis_text, data.om_jenis, true, true)
                    ).trigger('change');

                    $('select[name="om_bidang"]').append(
                        new Option(data.om_bidang_text, data.om_bidang, true, true)
                    ).trigger('change');


                    // File preview
                    function setFileLabel(inputId, filePath) {
                        const fileName = filePath.split('/').pop();
                        $('#' + inputId).next('.custom-file-label').text(fileName);
                    }
                    if (data.om_lambang) setFileLabel('om_lambang', data.om_lambang);
                    if (data.om_bendera) setFileLabel('om_bendera', data.om_bendera);
                    if (data.om_stempel) setFileLabel('om_stempel', data.om_stempel);
                },
                error: function(xhr) {
                    console.error("Gagal memuat data ormas:", xhr.responseJSON?.error);
                    alert("Gagal memuat data ormas. Coba lagi.");
                }
            });

            // Update label file input saat ganti file
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').text(fileName);
            });
        }



        function loadLegalitas() {
            $.get(`/api/data-ormas/${ormasId}/legalitas`, function(res) {
                if (res.success) {
                    let d = res.data;



                    $('input[name="bh_tbh"]').iCheck('uncheck'); // reset dulu
                    $('input[name="bh_tbh"][value="' + d.bh_tbh + '"]').iCheck('check');


                    // mapping ke form
                    $('[name="pendaftaran_nomor"]').val(d.surat_permohonan_nomor);
                    $('[name="pendaftaran_tanggal"]')[0]._flatpickr.setDate(d.surat_permohonan_tanggal, true);
                    $('[name="ormas_id"]').val(d.ormas_id);

                    $('[name="notaris_nama"]').val(d.notaris_nama);
                    $('[name="notaris_nomor"]').val(d.notaris_nomor);
                    $('[name="notaris_tanggal"]')[0]._flatpickr.setDate(d.notaris_tanggal, true);

                    $('[name="skko_register"]').val(d.skko_no_registrasi);
                    $('[name="skko_ajuan"]').val(d.skko_no_ajuan);
                    $('[name="skko_tanggal"]')[0]._flatpickr.setDate(d.skko_tanggal_surat, true);
                    $('[name="skko_berlaku"]')[0]._flatpickr.setDate(d.skko_tanggal_expired, true);

                    $('[name="kemenkumham_nomor"]').val(d.sk_kemenkumham_no);
                    $('[name="kemenkumham_tanggal"]')[0]._flatpickr.setDate(d.sk_kemenkumham_tanggal, true);
                }
            }).fail(function() {
                console.log("Data legalitas belum ada");
            });
        }




        $(document).ready(function() {
            // Event handler untuk tombol delete
            $('#table-pengurus').on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                var button = $(this);
                Swal.fire({
                    title: 'Hapus Pengurus?',
                    text: 'Apakah Anda yakin ingin menghapus pengurus ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.value) {
                        button.attr('disabled', true);
                        button.html('<i class="fas fa-spinner fa-spin"></i>');
                        deletePengurus(id, button);
                    }
                });
            });

            // Event handler untuk tombol edit
            $('#table-pengurus').on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                editPengurus(id);
            });

            // Modifikasi submit form untuk handle create dan update
            $('#formPengurus').on('submit', function(e) {
                e.preventDefault();

                let pengurusId = $('#pengurus_id').val();
                let formData = $(this).serialize() + '&ormas_id=' + ormasId;

                if (pengurusId) {
                    // Update existing pengurus
                    updatePengurus(pengurusId, formData);
                } else {
                    // Create new pengurus
                    $.ajax({
                        type: "POST",
                        url: "{{ route('pengurus.store') }}",
                        data: formData,
                        success: function(res) {
                            $('#modalPengurus').modal('hide');
                            $('#formPengurus')[0].reset();
                            toastr.success('Pengurus berhasil ditambahkan!');
                            $('#table-pengurus').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            toastr.error('Gagal menambahkan pengurus. Cek kembali isian.');
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

            // Reset form saat modal ditutup
            $('#modalPengurus').on('hidden.bs.modal', function() {
                $('#formPengurus')[0].reset();
                $('#pengurus_id').val('');
                $('#modalPengurusLabel').text('Tambah Pengurus');
            });


        });

        getPengurus();
        getAset();
        getOrmas();

        $("#custom-tabs-two-profile-tab").click(function() {
            loadLegalitas();
            $('.btn-next[data-step="2"]').remove();
        });
        $('input[type="checkbox"].radio, input[type="radio"].radio').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
        });
        $('#om_npwp').mask('99.999.999.9-999.999');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#btnTambahPengurus').on('click', function() {
            $('#formPengurus')[0].reset();
            $('#modalPengurus').modal('show');
        });

        $('#select-bidang-kegiatan').select2({
            placeholder: 'Pilih Bidang Kegiatan',
            theme: 'bootstrap4',
            ajax: {
                url: '{{ route('select2.bidang-kegiatan') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    }; // keyword pencarian
                },
                processResults: function(data) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            }
        });

        $('#jenis_kelembagaan').select2({
            placeholder: 'Pilih Jenis Kelembagaan',
            theme: 'bootstrap4',
            width: '100%',
            ajax: {
                url: '{{ route('jenis-kelembagaan.select2') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            }
        });

        $('.select2-provinsi').select2({
            theme: 'bootstrap4',
            placeholder: $(this).data('placeholder'),
            ajax: {
                url: '{{ route('wilayah.provinsi') }}',
                dataType: 'json',
                delay: 250,
                data: params => ({
                    q: params.term
                }),
                processResults: data => ({
                    results: data.results
                }),
                cache: true
            }
        });

        // Kabupaten
        $('.select2-kabupaten').select2({
            theme: 'bootstrap4',
            placeholder: $(this).data('placeholder'),
            ajax: {
                url: '{{ route('wilayah.kabupaten') }}',
                dataType: 'json',
                delay: 250,
                data: params => ({
                    q: params.term,
                    provinsi: $('.select2-provinsi').val()
                }),
                processResults: data => ({
                    results: data.results
                }),
                cache: true
            }
        });

        // Kecamatan
        $('.select2-kecamatan').select2({
            theme: 'bootstrap4',
            placeholder: $(this).data('placeholder'),
            ajax: {
                url: '{{ route('wilayah.kecamatan') }}',
                dataType: 'json',
                delay: 250,
                data: params => ({
                    q: params.term,
                    kabupaten: $('.select2-kabupaten').val()
                }),
                processResults: data => ({
                    results: data.results
                }),
                cache: true
            }
        });

        // Kelurahan
        $('.select2-kelurahan').select2({
            theme: 'bootstrap4',
            placeholder: $(this).data('placeholder'),
            ajax: {
                url: '{{ route('wilayah.kelurahan') }}',
                dataType: 'json',
                delay: 250,
                data: params => ({
                    q: params.term,
                    kecamatan: $('.select2-kecamatan').val()
                }),
                processResults: data => ({
                    results: data.results
                }),
                cache: true
            }
        });

        // Reset yang di bawahnya setiap kali pilihan berubah
        $('.select2-provinsi').on('change', function() {
            $('.select2-kabupaten').val(null).trigger('change');
            $('.select2-kecamatan').val(null).trigger('change');
            $('.select2-kelurahan').val(null).trigger('change');
        });

        $('.select2-kabupaten').on('change', function() {
            $('.select2-kecamatan').val(null).trigger('change');
            $('.select2-kelurahan').val(null).trigger('change');
        });

        $('.select2-kecamatan').on('change', function() {
            $('.select2-kelurahan').val(null).trigger('change');
        });

        $('#btnTambahAset').click(function() {
            $('#formModalAset')[0].reset();
            $('#modalAset').modal('show');
        });

        $('#formModalAset').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize() + '&ormas_id=' + ormasId
            $.ajax({
                url: '{{ route('aset.store') }}',
                method: 'POST',
                data: formData,
                success: function(res) {
                    $('#modalAset').modal('hide');
                    getAset(); // refresh data aset
                    toastr.success('Aset berhasil ditambahkan');
                },
                error: function(xhr) {
                    var json = xhr.responseJSON;
                    if (json && json.errors) {
                        $.each(json.errors, (k, v) => toastr.error(v[0]));
                    }
                }
            });
        });

        $('#tableAset').on('click', '.btn-hapus', function() {
            var id = $(this).data('id');
            if (confirm('Yakin mau hapus?')) {
                $.ajax({
                    url: '/api/aset/' + id,
                    method: 'DELETE',
                    success: function() {
                        toastr.success('Aset berhasil dihapus');
                        tableAset.ajax.reload();
                    }
                });
            }
        });

        async function deletePengurus(id, button) {
            try {
                const response = await $.ajax({
                    type: 'DELETE',
                    url: `/api/data-pengurus/${id}`,
                });
                Swal.fire(
                    'Terhapus!',
                    'Pengurus telah dihapus.',
                    'success'
                );
                // Refresh tabel pengurus
                $('#table-pengurus').DataTable().ajax.reload();
                button.attr('disabled', false);
                button.html('Hapus');
            } catch (error) {
                console.error(error);
                Swal.fire(
                    'Gagal!',
                    'Gagal menghapus pengurus.',
                    'error'
                );
                button.attr('disabled', false);
                button.html('Hapus');
            }
        }
        async function editPengurus(id) {
            try {
                const pengurus = await $.ajax({
                    url: `/api/data-pengurus/${id}`,
                    type: 'GET'
                });

                // Isi form dengan data pengurus
                $('#pengurus_id').val(pengurus.pengurus_id);
                $('#jabatan').val(pengurus.jabatan);
                $('#nik').val(pengurus.nik);
                $('#nama').val(pengurus.nama);
                $('#jk').val(pengurus.jk);
                $('#agama').val(pengurus.agama);
                $('#kewarganegaraan').val(pengurus.kewarganegaraan);
                $('#status_perkawinan').val(pengurus.status_perkawinan);
                $('#tempat_lahir').val(pengurus.tempat_lahir);
                $('#tanggal_lahir').val(pengurus.tanggal_lahir);
                $('#telepon').val(pengurus.telepon);
                $('#pekerjaan').val(pengurus.pekerjaan);

                // Ubah judul modal
                $('#modalPengurusLabel').text('Edit Pengurus');

                // Tampilkan modal
                $('#modalPengurus').modal('show');
            } catch (error) {
                console.error(error);
                toastr.error('Gagal memuat data pengurus');
            }
        }
        async function updatePengurus(id, formData) {
            try {
                const response = await $.ajax({
                    type: 'PUT',
                    url: `/api/data-pengurus/${id}`,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#modalPengurus').modal('hide');
                $('#formPengurus')[0].reset();
                toastr.success('Pengurus berhasil diperbarui!');
                $('#table-pengurus').DataTable().ajax.reload();

            } catch (error) {
                console.error(error);
                toastr.error('Gagal memperbarui pengurus');
            }
        }

        $('#update-data-utama').click(function(e) {
            e.preventDefault();

            let form = $('#form-user')[0];
            let formData = new FormData(form);

            $.ajax({
                url: `/api/${ormasId}`, // ganti sesuai route update kamu
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-HTTP-Method-Override': 'PUT' // karena laravel butuh PUT
                },
                beforeSend: function() {
                    loader(); // fungsi waitMe kamu
                },
                success: function(res) {
                    $('body').waitMe('hide');
                    toastr.success(res.message || 'Data utama berhasil diperbarui');
                    getOrmas(); // refresh data input dari API
                },
                error: function(xhr) {
                    $('body').waitMe('hide');
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    } else {
                        toastr.error('Gagal memperbarui data utama');
                    }
                }
            });
        });
        $('#update-data-legalitas').on('click', function(e) {
            e.preventDefault();

            let formData = {
                bh_tbh: $('input[name="bh_tbh"]:checked').val(),
                notaris_nama: $('input[name="notaris_nama"]').val(),
                notaris_nomor: $('input[name="notaris_nomor"]').val(),
                notaris_tanggal: $('input[name="notaris_tanggal"]').val(),
                surat_permohonan_nomor: $('input[name="pendaftaran_nomor"]').val(),
                surat_permohonan_tanggal: $('input[name="pendaftaran_tanggal"]').val(),
                sk_pengurus_nama: $('input[name="sk_pengurus_nama"]').val(),
                sk_pengurus_nomor: $('input[name="sk_pengurus_nomor"]').val(),
                sk_pengurus_tanggal: $('input[name="sk_pengurus_tanggal"]').val(),
                skko_no_ajuan: $('input[name="skko_ajuan"]').val(),
                skko_no_registrasi: $('input[name="skko_register"]').val(),
                skko_tanggal_surat: $('input[name="skko_tanggal"]').val(),
                skko_tanggal_expired: $('input[name="skko_berlaku"]').val(),
                sk_kemenkumham_no: $('input[name="kemenkumham_nomor"]').val(),
                sk_kemenkumham_tanggal: $('input[name="kemenkumham_tanggal"]').val(),
                doc_notaris: $('input[name="doc_notaris"]').val(),
                doc_kepengurusan: $('input[name="doc_kepengurusan"]').val(),
                doc_kemenkumham: $('input[name="doc_kemenkumham"]').val(),
                doc_permohonan: $('input[name="doc_permohonan"]').val(),
                doc_skko: $('input[name="doc_skko"]').val(),
                ormas_id: $('input[name="ormas_id"]').val(),
            };

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data legalitas akan diperbaharui!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/api/update-legalitas/${ormasId}`, // ganti sesuai route update
                        type: 'PUT',
                        data: formData,
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message);
                            } else {
                                toastr.error("Gagal memperbaharui data legalitas");
                            }
                        },
                        error: function(xhr) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = "Terjadi kesalahan saat menyimpan.";
                            if (errors) {
                                errorMessage = Object.values(errors).join("<br>");
                            }
                            toastr.error(errorMessage);
                        }
                    });
                }
            });
        });
    </script>
@endpush
