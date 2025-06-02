@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Konversi Dataset</h5>
                <form action="{{ route('konversi.process') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Proses Konversi Dataset</button>
                </form>
            </div>
            <div class="card-body">
                <p>Tekan tombol di atas untuk melakukan konversi dataset awal ke sub kriteria berdasarkan nilai terdekat.
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Hasil Konversi Dataset</h5>
            </div>
            <div class="card-body table-responsive">
                <table id="tabel-konversi" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            <th>Kriteria</th>
                            <th>Sub Kriteria</th>
                            <th>Nilai Sub Kriteria</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($konversis as $konversi)
                            <tr>
                                <td data-sort="{{ intval(substr($konversi->alternatif->sampel, 1)) }}">
                                    {{ $konversi->alternatif->sampel ?? '-' }}
                                </td>
                                <td>{{ $konversi->kriteria->nama ?? '-' }}</td>
                                <td>{{ $konversi->subKriteria->nama ?? '-' }}</td>
                                <td>{{ $konversi->subKriteria->nilai ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data konversi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
