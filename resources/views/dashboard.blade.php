{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('page-title', 'Beranda')

@section('content-main')
<div class="row">
    <div class="col-md-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalOrmas }}</h3>
                <p>Total Ormas</p>
            </div>
            <div class="icon"><i class="fas fa-building"></i></div>
        </div>
        <div class="card">
    
    <div class="card-body">
        <canvas id="pieChart"></canvas>
    </div>
</div>

    </div>
    <div class="col-md-8">
        <div class="card">
    <div class="card-header"><h3 class="card-title">Grafik Ormas per Kecamatan</h3></div>
    <div class="card-body">
        <canvas id="grafikKecamatan"></canvas>
    </div>
</div>
    </div>
</div>


@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>

<script>
    const ctx = document.getElementById('grafikKecamatan').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($dataKecamatan->keys()) !!},
            datasets: [{
                label: 'Jumlah Ormas',
                data: {!! json_encode($dataKecamatan->values()) !!},
                backgroundColor: '#28a745'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: false },
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    color: '#000',
                    font: {
                        weight: 'bold',
                        size: 12
                    },
                    formatter: (value) => value
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        },
        plugins: [ChartDataLabels]
    });
</script>
<script>
     const cty = document.getElementById('pieChart').getContext('2d');

    const pieChart = new Chart(cty, {
        type: 'pie',
        data: {
            labels: ['Berbadan Hukum', 'Tidak Berbadan Hukum'],
            datasets: [{
                data: [{{ $berbadanHukum }}, {{ $tidakBerbadanHukum }}],
                backgroundColor: ['#28a745', '#dc3545'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Perbandingan Ormas Berdasarkan Status Badan Hukum'
                },
                datalabels: {
                    color: '#fff',
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    formatter: (value, context) => {
                        return value; // tampilkan nilai angka
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });
</script>

@endsection