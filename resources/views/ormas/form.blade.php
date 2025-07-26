@extends('layouts.app')

@section('page-title', 'Tambah Ormas')

@section('content-main')
@php
    $isEdit = isset($ormas);
@endphp

    <div class="card">
        <div id="smartwizard">
            <ul class="nav">
                <li><a class="nav-link" href="#step-1">Profil Ormas</a></li>
                <li><a class="nav-link" href="#step-2">Legalitas</a></li>
                <li><a class="nav-link" href="#step-3">Pengurus</a></li>
                <li><a class="nav-link" href="#step-4">Aset</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane" id="step-1" role="tabpanel">
                    @include('ormas.partials.1')
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-danger mx-2" href="{{ route('ormas.index') }}">Kembali</a>
                            <button class="btn btn-primary me-2 btn-next" data-step="1" type="button">Lanjut <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="step-2" role="tabpanel">
                    @include('ormas.partials.2')
                </div>
                <div class="tab-pane" id="step-3" role="tabpanel">
                    @include('ormas.partials.3')

                    <div class="mt-4 justify-content-end d-flex">
                        <button class="btn btn-primary btn-next" data-step="3" type="button">Lanjut</button>
                    </div>
                </div>
                <div class="tab-pane" id="step-4" role="tabpanel">
                    @include('ormas.partials.4')

                    <div class="d-flex justify-content-end">
                        <a class="btn btn-success mt-3" href="{{ route('ormas.index') }}">Selesai</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" rel="stylesheet">
    <link href="https://adminlte.io/themes/v3/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="https://adminlte.io/themes/v3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" rel="stylesheet" />
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
    <script>
        let ormasId = {!! json_encode($isEdit ? $ormas->ormas_id : null) !!};
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

        function getOrmas() {
            if ($.fn.DataTable.isDataTable('#table-pengurus')) {
                $('#table-pengurus').DataTable().clear().destroy();
            }
            $("#table-pengurus").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
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



        $(document).ready(function() {

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

            $('#formPengurus').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize() + '&ormas_id=' + ormasId;

                $.ajax({
                    type: "POST",
                    url: "{{ route('pengurus.store') }}", // ganti sesuai rute penyimpanan
                    data: formData,
                    success: function(res) {
                        $('#modalPengurus').modal('hide');
                        $('#formPengurus')[0].reset();
                        toastr.success('Pengurus berhasil ditambahkan!');
                        $('#table-pengurus').DataTable().ajax.reload(); // reload table
                        getOrmas(); // refresh data ormas
                    },
                    error: function(xhr) {
                        toastr.error('Gagal menambahkan pengurus. Cek kembali isian.');
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#smartwizard').smartWizard({
                theme: 'basic',
                toolbar: {
                    showNextButton: false,
                    showPreviousButton: false
                },
                autoAdjustHeight: true,
                backButtonSupport: false,
                transition: {
                    animation: 'fade', // fade, slide-horizontal, slide-vertical
                    speed: '400' // durasi transisi dalam milidetik
                },
                toolbarSettings: {
                    toolbarPosition: 'none' // Hilangkan toolbar bawah
                }

            });

            $('.btn-next').on('click', function() {
                const step = $(this).data('step');
                let formId = '';
                let endpoint = '';
                let formData;

                if (step === 3) {
                    $('#smartwizard').smartWizard("next");
                    return;
                }

                if (step === 1) {
                    formId = '#form-user';
                    endpoint = '/api/data-ormas';
                    formData = new FormData($(formId)[0]);
                } else if (step === 2) {
                    formId = '#form-contact';
                    endpoint = '/api/data-legalitas';
                    formData = new FormData($(formId)[0]);
                    formData.append('ormas_id', ormasId);
                }

                $.ajax({
                    url: endpoint,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        loader(); // Tampilkan loader
                    },
                    success: function(res) {
                        if (step === 1 && res.ormas_id) {
                            ormasId = res.ormas_id;
                            getOrmas();
                            getAset();
                        }
                        toastr.success('Data berhasil disimpan!');
                        $('#smartwizard').smartWizard("next");
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            for (let field in errors) {
                                toastr.error(errors[field][0]);
                            }
                        } else {
                            toastr.error('Gagal menyimpan data. Cek kembali isian.');
                        }

                        console.error(xhr.responseText);
                    },
                    complete: function() {
                        $('body').waitMe('hide'); // Sembunyikan loader
                    }
                });
            });



            $('.btn-finish').on('click', function() {
                let data = $('#form-experience').serialize() + '&user_id=' + userId;
                $.post('/api/form-experience', data, function(res) {
                    alert("Data berhasil disimpan semua!");
                    window.location.href = '/selesai';
                }).fail(function() {
                    alert("Gagal menyimpan data pengalaman.");
                });
            });
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
    </script>
@endpush
