@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Perhitungan Metode SAW</h5>
                <a href="{{ route('dashboard.hasil') }}" class="btn btn-primary">Refresh Perhitungan</a>
            </div>
            <div class="card-body">
                <p>Berikut adalah hasil akhir perhitungan menggunakan metode Simple Additive Weighting (SAW). Nilai
                    ditampilkan dalam bentuk ranking berdasarkan skor tertinggi.</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Hasil Ranking Alternatif</h5>
            </div>
            <div class="card-body table-responsive">
                <table id="tabel-hasil" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Ranking</th>
                            <th>Alternatif</th>
                            <th>Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($hasil as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td data-sort="{{ intval(substr($item['alternatif'], 1)) }}">{{ $item['alternatif'] }}</td>
                                <td>{{ $item['nilai'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Belum ada data hasil perhitungan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
