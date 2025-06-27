@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-lg border-0 rounded-4 bg-dark text-white">
                <div class="card-header bg-dark text-white rounded-top-4">
                    <h4 class="mb-0">Dashboard Pemakaian Kendaraan</h4>
                </div>
                <div class="card-body">

                    {{-- Grafik Konsumsi BBM --}}
                    <canvas id="bbmChart" height="100"></canvas>

                    {{-- Penjelasan --}}
                    <p class="mt-4">
                        Grafik di atas menunjukkan total konsumsi BBM per kendaraan berdasarkan data pemakaian yang tercatat.
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('bbmChart').getContext('2d');
    const bbmChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Total Konsumsi BBM (liter)',
                data: @json($values),
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                borderRadius: 5,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'white'
                    },
                    grid: {
                        color: 'rgba(255,255,255,0.1)'
                    }
                },
                x: {
                    ticks: {
                        color: 'white'
                    },
                    grid: {
                        color: 'rgba(255,255,255,0.1)'
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'white'
                    }
                }
            }
        }
    });
</script>
@endsection
