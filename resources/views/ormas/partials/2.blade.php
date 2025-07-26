<form class="p-4" id="form-contact">
    <div class="">
        <div class="row">
            <div class="col-6">
                <fieldset class="border p-3 rounded mb-4">
                    <legend class="w-auto text-muted h6">Informasi Legalitas</legend>
                    @php $field = old(); @endphp
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <input class="ormas-id" name="ormas_id" type="hidden" value="{{ $field['ormas_id'] ?? '' }}">
                            <input class="radio" id="bh" name="bh_tbh" type="radio" value="Y">
                            <label for="bh">Berbadan Hukum</label>
                        </div>
                        <div class="col-sm-4">
                            <input class="radio" id="no-bh" name="bh_tbh" type="radio" value="T">
                            <label for="no-bh">Tidak Berbadan Hukum</label>
                        </div>
                </fieldset>
                <fieldset class="border p-3 rounded mb-4">
                    <legend class="w-auto text-muted h6">Data Pendaftaran Ormas</legend>
                    <div class="form-group">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nomor Pendaftaran</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="pendaftaran_nomor" type="text" value="{{ $field['pendaftaran_nomor'] ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Pendaftaran</label>
                            <div class="col-sm-8">
                                <input class="form-control tanggal" name="pendaftaran_tanggal" type="text" value="{{ $field['pendaftaran_tanggal'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="border p-3 rounded mb-4">
                    <legend class="w-auto text-muted h6">Akta Notaris</legend>
                    <div class="form-group">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nama Notaris</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="notaris_nama" type="text" value="{{ $field['notaris_nama'] ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nomor Akta Notaris</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="notaris_nomor" type="text" value="{{ $field['notaris_nomor'] ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Notaris</label>
                            <div class="col-sm-8">
                                <input class="form-control tanggal" name="notaris_tanggal" readonly type="text" value="{{ $field['notaris_tanggal'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="border p-3 rounded mb-4">
                    <legend class="w-auto text-muted h6">Dokumen SKKO</legend>
                    <div class="form-group">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nomor Register</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="skko_register" type="text" value="{{ $field['skko_register'] ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nomor Pengajuan</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="skko_ajuan" type="text" value="{{ $field['skko_ajuan'] ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal SKKO</label>
                            <div class="col-sm-8">
                                <input class="form-control tanggal" name="skko_tanggal" readonly type="text" value="{{ $field['skko_tanggal'] ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Berlaku Sampai</label>
                            <div class="col-sm-8">
                                <input class="form-control tanggal" name="skko_berlaku" readonly type="text" value="{{ $field['skko_berlaku'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="border p-3 rounded mb-4">
                    <legend class="w-auto text-muted h6">SK Kemenkumham</legend>
                    <div class="form-group">
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
                    </div>
                </fieldset>
            </div>

        </div>
    </div>
    <button class="btn btn-primary btn-next" data-step="2" type="button">Lanjut</button>
</form>
