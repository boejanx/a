@extends('layouts.app')

@section('page-title', 'Manajemen Ormas')

@section('content-main')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Ormas</span>
                    <span class="info-box-number">
                        {{ $totalOrmas ?? 0 }}
                        <small>Organisasi Masyarakat</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ormas Berbadan Hukum</span>
                    <span class="info-box-number">{{ $berbadanHukum ?? 0 }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ormas Tidak Berbadan Hukum</span>
                    <span class="info-box-number">{{ $tidakBerbadanHukum ?? 0 }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">New Members</span>
                    <span class="info-box-number">0</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Ormas</h3>
            <div class="card-tools">
                <button class="btn btn-sm btn-primary" onclick="window.location.href='{{ route('ormas.create') }}'" type="button">
                    <i class="fas fa-plus"></i> Tambah
                </button>
                <button class="btn btn-sm bg-success" data-target="#exportModal" data-toggle="modal" type="button">
                    <i class="fas fa-file-excel"></i> Export
                </button>
            </div>
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
    <div aria-hidden="true" aria-labelledby="exportModalLabel" class="modal fade" id="exportModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Export Data Ormas</h5>
                    <button aria-label="Tutup" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('ormas.export') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label><input class="checkbox" id="cek_semua_kecamatan" type="checkbox"> Semua Kecamatan</label>
                            <select class="form-control select2" id="filter_kecamatan" multiple name="kecamatan[]" style="width: 100%;">
                                @foreach ($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->kode_kecamatan }}">{{ $kecamatan->nama_kecamatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input checked="" class="checkbox" id="checkboxPrimary1" name="data_utama" type="checkbox">
                                <label for="checkboxPrimary1"> Data Utama
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input class="checkbox" id="checkboxPrimary2" name="legalitas" type="checkbox">
                                <label for="checkboxPrimary2"> Legalitas
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input class="checkbox" disabled="" id="checkboxPrimary3" name="pengurus" type="checkbox">
                                <label for="checkboxPrimary3">
                                    Pengurus
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">Batal</button>
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@push('css')
    <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css" rel="stylesheet">
    <link href="https://adminlte.io/themes/v3/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="https://adminlte.io/themes/v3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" rel="stylesheet" />
@endpush
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: "Semua Kecamatan",
                allowClear: true,
                dropdownParent: $('#exportModal'),
                width: '100%',
                multiple: true,
            }).on('change', function(e) {
                let selected = $(this).val();

                // Kalau "SEMUA" dipilih, hilangkan pilihan lain
                if (selected && selected.includes("semua")) {
                    $(this).val(["semua"]).trigger("change");
                }
            });

            $('#cek_semua_kecamatan').on('ifChecked', function() {
                $('#filter_kecamatan')
                    .prop('disabled', true)
                    .val(null)
                    .trigger('change'); // Clear & update select2 (atau plugin lain)
            });

            $('#cek_semua_kecamatan').on('ifUnchecked', function() {
                $('#filter_kecamatan').prop('disabled', false);
            });





            $('#exportModal').on('shown.bs.modal', function() {
                $('input[type="checkbox"].checkbox, input[type="checkbox"].radio').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });
            });
        });
        $(function() {
            $('#ormas-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ormas.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'om_nama',
                        name: 'nama_ormas'
                    },
                    {
                        data: 'om_singkatan',
                        name: 'singkatan'
                    },
                    {
                        data: 'nama_ketua',
                        name: 'ketua'
                    },
                    {
                        data: 'nama_kecamatan',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
