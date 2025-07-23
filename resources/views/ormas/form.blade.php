@extends('layouts.app')

@section('page-title', 'Tambah Ormas')

@section('content-main')
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
                    <div class="card-body">
                        <form id="form-user" method="POST">
                            {{-- CSRF Token --}}
                            @csrf
                            <div class="row">
                                {{-- Kolom Kiri --}}
                                <div class="col-md-6">
                                    {{-- Data Ormas --}}
                                    <fieldset class="border p-3 rounded mb-4">
                                        <legend class="w-auto px-2 text-muted h6">Identitas Organisasi</legend>
                                        @php $field = old(); @endphp

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Nama Ormas</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" name="om_nama" placeholder="Nama Organisasi" type="text" value="{{ $field['name_ormas'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Singkatan</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" name="om_singkatan" placeholder="Singkatan" type="text" value="{{ $field['singkatan'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Jenis Organisaasi</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="jenis_kelembagaan" name="om_jenis">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Bidang Kegiatan</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="select-bidang-kegiatan" name="om_bidang" placeholder="Bidang Kegiatan" type="text"
                                                    value="{{ $field['bidang_kegiatan'] ?? '' }}"></select>
                                            </div>
                                        </div>

                                    </fieldset>

                                    <fieldset class="border p-3 rounded">
                                        <legend class="w-auto px-2 text-muted h6">Alamat Sekretariat</legend>
                                        <div class="form-group row  mb-2">
                                            <label class="col-sm-3 col-form-label">Nama Jalan</label>
                                            <div class="col-sm-9">
                                                <input class="form-control mb-2" name="om_alamat_jl" placeholder="Jl. nama Jalan Nomor ...." type="text" value="{{ $field['alamat_jalan'] ?? '' }}">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input class="form-control mb-2" name="alamat_rt" placeholder="RT" type="text" value="{{ $field['alamat_rt'] ?? '' }}">
                                                    </div>
                                                    <div class="col-6">
                                                        <input class="form-control mb-2" name="alamat_rw" placeholder="RW" type="text" value="{{ $field['alamat_rw'] ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label class="col-sm-3 col-form-label">Provinsi</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2-provinsi" data-placeholder="Pilih Provinsi" name="om_alamat_prov">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2">
                                            <label class="col-sm-3 col-form-label">Kabupaten/Kota</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2-kabupaten" data-placeholder="Pilih Kabupaten/Kota" name="om_alamat_kab">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2">
                                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2-kecamatan" data-placeholder="Pilih Kecamatan" name="om_alamat_kec">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2">
                                            <label class="col-sm-3 col-form-label">Kelurahan/Desa</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2-kelurahan" data-placeholder="Pilih Kelurahan/Desa" name="om_alamat_kel">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Telepon</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="om_telepon" placeholder="Telepon Organisasi" type="text" value="{{ old('telepon') }}">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                {{-- Kolom Kanan --}}
                                <div class="col-md-6">
                                    <fieldset class="border p-3 rounded">
                                        <legend class="w-auto px-2 text-muted h6">Data Organisasi</legend>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Tujuan Organisasi</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="om_misi">{{ old('misi') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">KTA</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" name="om_kta" type="text" value="{{ old('kta') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Sumber Dana</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" name="om_sumber_dana" type="text" value="{{ old('sumber_dana') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">NPWP</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" name="om_npwp" type="text" value="{{ $field['npwp'] ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Asas / Ciri</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" name="om_asas_ciri" type="text" value="{{ $field['asas_ciri'] ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Lambang</label>
                                            <div class="col-sm-8">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="om_lambang" name="om_lambang" type="file" value="{{ $field['om_lambang'] ?? '' }}">
                                                    <label class="custom-file-label" for="om_lambang">Pilih file</label>
                                                </div>
                                                <small class="form-text text-muted">
                                                    Format JPG/PNG, ukuran maksimal 1 MB.
                                                </small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Bendera</label>
                                            <div class="col-sm-8">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="om_bendera" name="om_bendera" type="file" value="{{ $field['om_bendera'] ?? '' }}">
                                                    <label class="custom-file-label" for="om_bendera">Pilih file</label>
                                                </div>
                                                <small class="form-text text-muted">
                                                    Format JPG/PNG, ukuran maksimal 1 MB.
                                                </small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Stempel</label>
                                            <div class="col-sm-8">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="om_stempel" name="om_stempel" type="file" value="{{ $field['om_stempel'] ?? '' }}">
                                                    <label class="custom-file-label" for="om_stempel">Pilih file</label>
                                                </div>
                                                <small class="form-text text-muted">
                                                    Format JPG/PNG, ukuran maksimal 1 MB.
                                                </small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Catatan</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="om_catatan">{{ $field['catatan'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-next" data-step="1" type="button">Lanjut</button>
                            <a class="btn btn-secondary mt-3" href="{{ route('ormas.index') }}">Kembali</a>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="step-2" role="tabpanel">
                    <form id="form-contact">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Data Legalitas</h3>
                                <div class="card-tools">
                                    <button class="btn btn-tool" data-card-widget="collapse" type="button"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Legalitas</label>
                                    <div class="col-sm-4">
                                        <input class="ormas-id" name="ormas_id" type="hidden" value="{{ $field['ormas_id'] ?? '' }}">
                                        <input class="radio-control" id="bh" name="bh_tbh" type="radio" value="Y">
                                        <label for="bh">Berbadan Hukum</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="radio-control" id="no-bh" name="bh_tbh" type="radio" value="T">
                                        <label for="no-bh">Tidak Berbadan Hukum</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Nama Notaris</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="notaris_nama" type="text" value="{{ $field['notaris_nama'] ?? '' }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Tanggal Notaris</label>
                                    <div class="col-sm-8">
                                        <input class="form-control tanggal" name="notaris_tanggal" readonly type="text" value="{{ $field['notaris_tanggal'] ?? '' }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">SKKO</label>
                                    <div class="col-sm-8">
                                        <input class="form-control mb-1" name="skko_register" placeholder="Nomor Register" type="text" value="{{ $field['skko_register'] ?? '' }}">
                                        <input class="form-control mb-1" name="skko_ajuan" placeholder="Nomor Ajuan" type="text" value="{{ $field['skko_ajuan'] ?? '' }}">
                                        <input class="form-control mb-1" name="skko_tanggal" type="date" value="{{ $field['skko_tanggal'] ?? '' }}">
                                        <input class="form-control" name="skko_berlaku" type="date" value="{{ $field['skko_berlaku'] ?? '' }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">No. Kemenkumham</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="kemenkumham_nomor" type="text" value="{{ $field['kemenkumham_nomor'] ?? '' }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Tanggal Kemenkumham</label>
                                    <div class="col-sm-8">
                                        <input class="form-control tanggal" name="kemenkumham_tanggal" readonly type="date" value="{{ $field['kemenkumham_tanggal'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Pendaftaran</label>
                                    <div class="col-sm-8">
                                        <input class="form-control mb-1" name="pendaftaran_nomor" placeholder="Nomor" type="text" value="{{ $field['pendaftaran_nomor'] ?? '' }}">
                                        <input class="form-control" name="pendaftaran_tanggal" type="date" value="{{ $field['pendaftaran_tanggal'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-next" data-step="2" type="button">Lanjut</button>
                    </form>
                </div>
                <div class="tab-pane" id="step-3" role="tabpanel">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="mb-0">Daftar Pengurus</h5>
                                <button class="btn btn-sm btn-success mb-2" id="btnTambahPengurus">
                                    <i class="fas fa-plus"></i> Tambah Pengurus
                                </button>
                            </div>
                            <table class="table table-bordered" id="table-pengurus">
                                <thead>
                                    <tr>
                                        <th>no</th>
                                        <th>Jabatan</th>
                                        <th>Nama Pengurus</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-4 justify-content-end d-flex">
                        <button class="btn btn-primary btn-next" data-step="3" type="button">Lanjut</button>
                    </div>

                </div>
                <div class="tab-pane" id="step-4" role="tabpanel">
                    
                    <h5 class="mb-3">Daftar Aset <span class="text-muted mb-3 small"></span></h5>
                    <div class="d-flex justify-content-end">
                    <button class="btn btn-primary mb-2" id="btnTambahAset">Tambah Aset</button>

                    </div>

                    <table class="table table-bordered" id="tableAset">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Kepemilikan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <div class="d-flex justify-content-end">
                        <a class="btn btn-success mt-3" href="{{ route('ormas.index') }}">Kembali</a>
                    </div>
                    
                </div>

                <!-- Modal Form -->
                <div class="modal fade" id="modalAset" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="formModalAset">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Aset</h5>
                                    <button class="close" data-dismiss="modal" type="button">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama Aset</label>
                                        <input class="form-control" maxlength="100" name="aset_nama" required type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input class="form-control" name="aset_jumlah" required type="number">
                                    </div>
                                    <div class="form-group">
                                        <label>Kepemilikan</label>
                                        <input class="form-control" maxlength="50" name="aset_kepemilikan" type="text">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="submit">Simpan Aset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Tambah Pengurus -->
    <div aria-hidden="true" aria-labelledby="modalPengurusLabel" class="modal fade" id="modalPengurus" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formPengurus">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPengurusLabel">Tambah Pengurus</h5>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        @csrf
                        <input class="ormas-id" id="ormas_id" name="ormas_id" type="hidden"> <!-- diisi dari step sebelumnya -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="jabatan">Jabatan</label>
                            <select class="form-control" id="jabatan" name="jabatan" required>
                                <option value="">-- Pilih --</option>
                                <option value="Ketua">Ketua</option>
                                <option value="Wakil Ketua">Wakil Ketua</option>
                                <option value="Sekretaris">Sekretaris</option>
                                <option value="Bendahara">Bendahara</option>
                                <option value="Pendiri">Pendiri</option>
                                <option value="Penasehat">Penasehat</option>
                                <option value="Pembina">Pembina</option>
                            </select>
                        </div>
                        <div class="col md 6"></div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nik">NIK</label>
                            <input class="form-control" id="nik" name="nik" required type="text">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nama">Nama</label>
                            <input class="form-control" id="nama" name="nama" required type="text">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="jk">Jenis Kelamin</label>
                            <select class="form-control" id="jk" name="jk" required>
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="agama">Agama</label>
                            <select class="form-control" id="agama" name="agama" required>
                                <option value="">-- Pilih --</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Konghucu">Konghucu</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="kewarganegaraan">Kewarganegaraan</label>
                            <select class="form-control" id="kewarganegaraan" name="kewarganegaraan" required>
                                <option value="WNI">WNI</option>
                                <option value="WNA">WNA</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="status_perkawinan">Status Perkawinan</label>
                            <select class="form-control" id="status_perkawinan" name="status_perkawinan" required>
                                <option value="Kawin">Kawin</option>
                                <option value="Belum Kawin">Belum Kawin</option>
                                <option value="Duda">Duda</option>
                                <option value="Janda">Janda</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
                            <input class="form-control" id="tempat_lahir" name="tempat_lahir" type="text">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                            <input class="form-control" id="tanggal_lahir" name="tanggal_lahir" type="date">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="telepon">Telepon</label>
                            <input class="form-control" id="telepon" name="telepon" type="text">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="pekerjaan">Pekerjaan</label>
                            <input class="form-control" id="pekerjaan" name="pekerjaan" type="text">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
                    </div>
                </form>
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

    <style>
        .radio-control {
            margin-right: 10px;
        }
    </style>
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        let ormasId = null;
        $(".tanggal").flatpickr();

        function getOrmas() {
            if ($.fn.DataTable.isDataTable('#table-pengurus')) {
                $('#table-pengurus').DataTable().clear().destroy();
            }
            $("#table-pengurus").DataTable({
                processing: true,
                serverSide: true,
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



        $(document).ready(function() {
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
                theme: 'arrows',
                toolbar: {
                    showNextButton: false,
                    showPreviousButton: false
                },
                autoAdjustHeight: true,
                backButtonSupport: true
            });

            $('.btn-next').on('click', function() {
                const step = $(this).data('step');
                let formId = '';
                let endpoint = '';
                let data = {};

                // Step 3 tanpa submit, langsung next
                if (step == 3) {
                    $('#smartwizard').smartWizard("next");
                    return; // berhenti di sini, biar tidak lanjut ke AJAX
                }

                if (step == 1) {
                    formId = '#form-user';
                    endpoint = '/api/data-ormas';
                    data = $(formId).serialize();
                } else if (step == 2) {
                    formId = '#form-contact';
                    endpoint = '/api/data-legalitas';
                    data = $(formId).serialize() + '&ormas_id=' + ormasId;
                }

                $.ajax({
                    url: endpoint,
                    method: 'POST',
                    data: data,
                    success: function(res) {
                        if (step === 1 && res.ormas_id) {
                            ormasId = res.ormas_id;
                            getOrmas();
                            getAset();
                        }
                        toastr.success('Data berhasil disimpan!');
                        $('#smartwizard').smartWizard("next");
                    },
                    error: function(err) {
                        toastr.error('Gagal menyimpan data. Cek kembali isian.');
                        console.error(err.responseText);
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
