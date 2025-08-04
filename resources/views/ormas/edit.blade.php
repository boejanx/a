@extends('layouts.app')

@section('page-title', 'Data Ormas')

@section('content-main')
    @php
        $isEdit = isset($ormas);
    @endphp

    <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3 bg-success"><h3 class="card-title">{{ $ormas->om_nama }}</h3></li>
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home"> <i class="fas fa-home"></i> Data Utama</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile"> <i class="fas fa-id-card "></i> Data Legalitas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages"> <i class="fas fa-users"></i> Data Pengurus</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings"><i class="fas fa-building"></i>Data Aset</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tab-dokumen-tab" data-toggle="pill" href="#tab-dokumen" role="tab" aria-controls="tab-dokumen"><i class="fas fa-cog"></i> Dokumen Ormas</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                    @include('ormas.partials.1', ['isEdit' => $isEdit, 'ormas' => $ormas ?? null]) 
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                    @include('ormas.partials.2', ['isEdit' => $isEdit, 'ormas' => $ormas ?? null])
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                    @include('ormas.partials.3', ['isEdit' => $isEdit, 'ormas' => $ormas ?? null])
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                    @include('ormas.partials.4', ['isEdit' => $isEdit, 'ormas' => $ormas ?? null])
                  </div>
                    <div class="tab-pane fade" id="tab-dokumen" role="tabpanel" aria-labelledby="tab-dokumen">
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

        function getOrmas() {
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



        $(document).ready(function() {
            getOrmas();
            getAset();

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
                autoAdjustHeightMode: 'auto',
                backButtonSupport: false,
                transition: {
                    animation: 'fade', // fade, slide-horizontal, slide-vertical
                    speed: '400' // durasi transisi dalam milidetik
                },
                toolbarSettings: {
                    toolbarPosition: 'none' // Hilangkan toolbar bawah
                }

            });

            // 1. Paksa ukur ulang setiap kali pindah tab
            $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection) {
                // Panggil 'fixHeight' untuk menyesuaikan tinggi dengan konten tab yang baru
                $(this).smartWizard('fixHeight');
            });

            $('.btn-next').on('click', function() {
                const step = $(this).data('step');
                let formId = '';
                let endpoint = '';
                let formData;
                const button = $(this);
                const originalButtonText = button.html();

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
                        button.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
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
                        button.prop('disabled', false).html(originalButtonText);
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

        // 2. Pasang "mata-mata" (MutationObserver) untuk perubahan dinamis di dalam tab
        // Dibungkus dalam IIFE (Immediately Invoked Function Expression) agar rapi
        (function() {
            // Fungsi untuk memantau perubahan konten dan menyesuaikan tinggi SmartWizard
            const setupHeightObserver = (targetNode) => {
                let resizeTimer;
                const config = {
                    childList: true,
                    subtree: true
                };

                const callback = function(mutationsList, observer) {
                    // Gunakan debounce untuk mencegah pemanggilan berlebihan saat banyak perubahan
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(() => {
                        $('#smartwizard').smartWizard('fixHeight');
                    }, 150); // tunggu 150ms setelah perubahan terakhir
                };

                const observer = new MutationObserver(callback);
                observer.observe(targetNode, config);
            };

            // Terapkan observer ke setiap tab-pane
            $('.tab-pane').each(function() {
                setupHeightObserver(this);
            });
        })();
    </script>
@endpush
