@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">Dataset</h5>
                    <p class="card-text mb-0">Daftar data dataset yang tersimpan.</p>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahDataset">
                    Tambah Dataset
                </button>
            </div>

            <div class="card-body">
                <table id="table-dataset" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sampel</th>
                            @foreach ($kriterias as $kriteria)
                                <th>{{ $kriteria->nama }}</th>
                            @endforeach
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatifs as $index => $alt)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $alt->sampel }}</td>
                                @foreach ($kriterias as $kriteria)
                                    @php
                                        $dataset =
                                            $datasets[$alt->id]->firstWhere('kriteria_id', $kriteria->id) ?? null;
                                    @endphp
                                    <td>
                                        {{ $dataset->nilai ?? '-' }}
                                        @if ($dataset)
                                            <div class="mt-1">
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditDataset" data-id="{{ $dataset->id }}"
                                                    data-alternatif_id="{{ $dataset->alternatif_id }}"
                                                    data-kriteria_id="{{ $dataset->kriteria_id }}"
                                                    data-nilai="{{ $dataset->nilai }}">
                                                    <i class="bx bx-pencil"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                @endforeach
                                <td>
                                    <form action="{{ route('alternatif.destroy', $alt->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus alternatif ini beserta semua nilainya?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                class="bx bx-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if ($alternatifs->isEmpty())
                            <tr>
                                <td colspan="{{ 3 + $kriterias->count() }}">Belum ada data alternatif.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Dataset -->
    <div class="modal fade" id="modalTambahDataset" tabindex="-1" aria-labelledby="modalTambahDatasetLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dataset.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahDatasetLabel">Tambah Dataset</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="alternatif_id" class="form-label">Alternatif</label>
                            <select class="form-select" name="alternatif_id" id="alternatif_id" required>
                                <option value="" selected disabled>Pilih Alternatif</option>
                                @foreach ($alternatifs as $alt)
                                    <option value="{{ $alt->id }}">{{ $alt->sampel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kriteria_id" class="form-label">Kriteria</label>
                            <select class="form-select" name="kriteria_id" id="kriteria_id" required>
                                <option value="" selected disabled>Pilih Kriteria</option>
                                @foreach ($kriterias as $kriteria)
                                    <option value="{{ $kriteria->id }}">{{ $kriteria->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nilai" class="form-label">Nilai</label>
                            <input type="number" step="any" class="form-control" id="nilai" name="nilai"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Dataset -->
    <div class="modal fade" id="modalEditDataset" tabindex="-1" aria-labelledby="modalEditDatasetLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEditDataset" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditDatasetLabel">Edit Dataset</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="mb-3">
                            <label for="edit-alternatif_id" class="form-label">Alternatif</label>
                            <select class="form-select" id="edit-alternatif_id" name="alternatif_id" required>
                                <option value="" disabled>Pilih Alternatif</option>
                                @foreach ($alternatifs as $alt)
                                    <option value="{{ $alt->id }}">{{ $alt->sampel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit-kriteria_id" class="form-label">Kriteria</label>
                            <select class="form-select" id="edit-kriteria_id" name="kriteria_id" required>
                                <option value="" disabled>Pilih Kriteria</option>
                                @foreach ($kriterias as $kriteria)
                                    <option value="{{ $kriteria->id }}">{{ $kriteria->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit-nilai" class="form-label">Nilai</label>
                            <input type="number" step="any" class="form-control" id="edit-nilai" name="nilai"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const modalEditDataset = document.getElementById('modalEditDataset');
        modalEditDataset.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const alternatifId = button.getAttribute('data-alternatif_id');
            const kriteriaId = button.getAttribute('data-kriteria_id');
            const nilai = button.getAttribute('data-nilai');

            const form = document.getElementById('formEditDataset');
            form.action = `dashboard/dataset/${id}`;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-alternatif_id').value = alternatifId;
            document.getElementById('edit-kriteria_id').value = kriteriaId;
            document.getElementById('edit-nilai').value = nilai;
        });
    </script>
@endsection
