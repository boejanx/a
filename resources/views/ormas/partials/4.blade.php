<div class="d-flex justify-content-end">
    <button class="btn btn-primary mb-2" id="btnTambahAset">Tambah Aset</button>
</div>

<table class="table table-bordered table-responsive" id="tableAset" width="100%">
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
                                        <label>Satuan</label>
                                        <select class="form-control" id="satuan" name="satuan">
                                            <option value="">-- Pilih Satuan --</option>
                                            <option value="detik">Detik</option>
                                            <option value="menit">Menit</option>
                                            <option value="jam">Jam</option>
                                            <option value="hari">Hari</option>
                                            <option value="minggu">Minggu</option>
                                            <option value="bulan">Bulan</option>
                                            <option value="tahun">Tahun</option>

                                            <option value="orang">Orang</option>
                                            <option value="pegawai">Pegawai</option>
                                            <option value="peserta">Peserta</option>
                                            <option value="narasumber">Narasumber</option>
                                            <option value="instruktur">Instruktur</option>
                                            <option value="panitia">Panitia</option>
                                            <option value="tenaga ahli">Tenaga Ahli</option>
                                            <option value="tim">Tim</option>

                                            <option value="unit">Unit</option>
                                            <option value="buah">Buah</option>
                                            <option value="lembar">Lembar</option>
                                            <option value="buku">Buku</option>
                                            <option value="paket">Paket</option>
                                            <option value="set">Set</option>
                                            <option value="roll">Roll</option>
                                            <option value="lusin">Lusin</option>
                                            <option value="botol">Botol</option>
                                            <option value="dus">Dus</option>
                                            <option value="kotak">Kotak</option>
                                            <option value="batang">Batang</option>
                                            <option value="pasang">Pasang</option>
                                            <option value="karung">Karung</option>

                                            <option value="m²">m² (Meter Persegi)</option>
                                            <option value="m³">m³ (Meter Kubik)</option>
                                            <option value="liter">Liter</option>
                                            <option value="ml">ml (Mililiter)</option>
                                            <option value="kg">kg (Kilogram)</option>
                                            <option value="gram">Gram</option>
                                            <option value="ton">Ton</option>

                                            <option value="km">km (Kilometer)</option>
                                            <option value="perjalanan">Perjalanan</option>
                                            <option value="trayek">Trayek</option>
                                            <option value="tiket">Tiket</option>
                                            <option value="mobil">Mobil</option>
                                            <option value="motor">Motor</option>
                                            <option value="kendaraan">Kendaraan</option>

                                            <option value="kali">Kali</option>
                                            <option value="sesi">Sesi</option>
                                            <option value="kegiatan">Kegiatan</option>
                                            <option value="pertemuan">Pertemuan</option>
                                            <option value="agenda">Agenda</option>
                                            <option value="event">Event</option>

                                            <option value="layanan">Layanan</option>
                                            <option value="transaksi">Transaksi</option>
                                            <option value="aplikasi">Aplikasi</option>
                                            <option value="lembar kerja">Lembar Kerja</option>
                                            <option value="formulir">Formulir</option>
                                        </select>

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
