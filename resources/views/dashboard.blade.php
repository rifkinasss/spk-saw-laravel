@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Header Card -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card bg-light border-0 shadow-sm">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title text-success">Selamat Datang Admin SCPK 1! 🎉</h4>
                                <p class="mb-0">
                                    Kamu berhasil menerapkan metode <strong>Simple Additive Weighting (SAW)</strong>
                                    menggunakan <strong>Laravel Framework</strong>. 🚀
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 text-end pe-3">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" alt="Admin SAW"
                                height="120">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 mb-4">
            <!-- Dataset -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('assets/img/icons/unicons/database.png') }}" width="30" class="me-2">
                            <span class="fw-semibold">Dataset</span>
                        </div>
                        <h3 class="mb-0">{{ $dataset }}</h3>
                    </div>
                </div>
            </div>

            <!-- Criteria -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('assets/img/icons/unicons/kriteria.png') }}" width="30" class="me-2">
                            <span class="fw-semibold">Criteria</span>
                        </div>
                        <h3 class="mb-0">{{ $criteria }}</h3>
                    </div>
                </div>
            </div>

            <!-- Sub Criteria -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('assets/img/icons/unicons/sub-kriteria.png') }}" width="30"
                                class="me-2">
                            <span class="fw-semibold">Sub Criteria</span>
                        </div>
                        <h3 class="mb-0">{{ $subKriteria }}</h3>
                    </div>
                </div>
            </div>

            <!-- Alternatif -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('assets/img/icons/unicons/alternatif.png') }}" width="30" class="me-2">
                            <span class="fw-semibold">Alternatif</span>
                        </div>
                        <h3 class="mb-0">{{ $alternatif }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top 5 SAW -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-1">Top 5 Hasil SAW</h5>
                        <small class="text-muted">Alternatif dengan nilai tertinggi</small>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($top5 as $rank => $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $item['alternatif'] }}</h6>
                                        <small class="text-muted">Nilai: {{ $item['nilai'] }}</small>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">#{{ $rank + 1 }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Grafik Semua Alternatif -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-1">Visualisasi Nilai SAW Seluruh Alternatif</h5>
                        <small class="text-muted">Perbandingan skor masing-masing alternatif</small>
                    </div>
                    <div class="card-body">
                        <canvas id="sawChart" height="120"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tanggal Update -->
        <div class="text-end mt-3">
            <small class="text-muted">Terakhir diperbarui: {{ now()->translatedFormat('d F Y, H:i') }}</small>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('sawChart').getContext('2d');

        const sawChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_column($hasil, 'alternatif')) !!},
                datasets: [{
                    label: 'Nilai SAW',
                    data: {!! json_encode(array_column($hasil, 'nilai')) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 1
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endsection
