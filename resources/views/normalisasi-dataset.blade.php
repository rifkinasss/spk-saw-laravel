@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">{{ $title }}</h5>
                <form action="{{ route('normalisasi.process') }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin melakukan normalisasi ulang?')" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        Generate Normalisasi
                    </button>
                </form>
            </div>
            <div class="card-body">
                <p class="card-text mb-0">Data dataset yang sudah dinormalisasi ditampilkan berdasarkan sampel dan
                    kriteria.</p>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped text-center datatable-normalisasi">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sampel</th>
                            <th>BB/U</th>
                            <th>TB/U</th>
                            <th>BB/TB</th>
                            <th>IMT/U</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($normalisasi as $grouped)
                            @php
                                $sampel = $grouped->first()->alternatif->sampel ?? '-';
                                $nilai = $grouped->keyBy(fn($item) => $item->kriteria->nama);
                            @endphp
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $sampel }}</td>
                                <td>{{ number_format($nilai['Berat Badan Menurut Umur (BB/U)']->nilai_normalisasi ?? 0, 2) }}
                                </td>
                                <td>{{ number_format($nilai['Tinggi Badan Menurut Umur (TB/U)']->nilai_normalisasi ?? 0, 2) }}
                                </td>
                                <td>{{ number_format($nilai['Berat Badan Menurut Tinggi Badan (BB/TB)']->nilai_normalisasi ?? 0, 2) }}
                                </td>
                                <td>{{ number_format($nilai['Indeks Massa Tubuh Menurut Umur (IMT/U)']->nilai_normalisasi ?? 0, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data normalisasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
