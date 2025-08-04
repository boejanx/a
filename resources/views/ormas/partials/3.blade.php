<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0">Daftar Pengurus</h5>
            <button class="btn btn-sm btn-success mb-2" id="btnTambahPengurus">
                <i class="fas fa-plus"></i> Tambah Pengurus
            </button>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered w-100" id="table-pengurus" width="100%">
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
