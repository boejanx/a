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
                  10
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
                <span class="info-box-number">41,410</span>
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
                <span class="info-box-number">760</span>
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
                <span class="info-box-number">2,000</span>
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
      <button type="button" class="btn btn-sm btn-primary" onclick="window.location.href='{{ route('ormas.create') }}'">
        <i class="fas fa-plus"></i> Tambah
      </button>
      <button type="button" class="btn btn-sm bg-success" data-toggle="modal" data-target="#exportModal">
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
<div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exportModalLabel">Export Data Ormas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form action="" method="GET" target="_blank">
        <div class="modal-body">
          <div class="form-group">
            <label for="filter_kecamatan">Kecamatan</label>
            <select name="kecamatan" id="filter_kecamatan" class="form-control select2" style="width: 100%;">
              
            </select>
          </div>

          <div class="form-group">
            <label for="filter_jenis">Jenis Ormas</label>
            <select name="jenis" id="filter_jenis" class="form-control select2" style="width: 100%;">
              <option value="">Semua Jenis</option>
              <option value="Ormas">Ormas</option>
              <option value="LSM">LSM</option>
              <option value="OKP">OKP</option>
              <option value="Komunitas">Komunitas</option>
              <!-- Tambah jenis lain jika perlu -->
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">
            <i class="fas fa-download"></i> Export
          </button>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection

@section('js')
<script>
$(function () {
    $('#ormas-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ormas.index') }}",
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_ormas', name: 'nama_ormas' },
            { data: 'kecamatan', name: 'kecamatan' },
            { data: 'ketua', name: 'ketua' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});

$(function () {
    $('.select2').select2({
      theme: 'bootstrap4',
      placeholder: "Pilih Opsi",
      allowClear: true
    });
  });
</script>
@endsection
