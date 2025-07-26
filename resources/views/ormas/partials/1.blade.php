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
                            <select name="om_kta" id="om_kta" class="form-control">
                                <option value="Y">Ya</option>
                                <option value="T">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Sumber Dana</label>
                        <div class="col-sm-8">
                            <select name="om_sumber_dana" id="om_sumber_dana" class="form-control">
                                <option value="Dalam Negeri">Dalam Negeri</option>
                                <option value="Luar Negeri">Luar Negeri</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">NPWP</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="om_npwp" id="om_npwp" type="text" value="{{ $field['npwp'] ?? '' }}" placeholder="99.999.999.9-999.999">
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

        
    </form>
</div>
