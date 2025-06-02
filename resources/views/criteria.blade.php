@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">Criteria</h5>
                    <p class="card-text mb-0">Daftar kriteria yang tersedia.</p>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah Kriteria
                </button>
            </div>

            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Nama</th>
                            <th>Label</th>
                            <th>Type</th>
                            <th>Bobot</th>
                            <th>Bobot Normalisasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriterias as $kriteria)
                            <tr>
                                <td>{{ $kriteria->nama }}</td>
                                <td class="text-center">{{ $kriteria->label }}</td>
                                <td class="text-center">{{ $kriteria->type }}</td>
                                <td class="text-center">{{ $kriteria->bobot }}</td>
                                <td class="text-center">{{ $kriteria->bobot_normalisasi }}</td>
                                <td class="text-center">
                                    <a href="{{ route('dashboard.update-criteria', $kriteria->id) }}"
                                        class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit"
                                        data-id="{{ $kriteria->id }}" data-nama="{{ $kriteria->nama }}"
                                        data-label="{{ $kriteria->label }}" data-type="{{ $kriteria->type }}">
                                        Edit</a>

                                    <form action="{{ route('dashboard.destroy-criteria', $kriteria->id) }}" method="POST"
                                        style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kriteria -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard.store-criteria') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahLabel">Tambah Kriteria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="label" class="form-label">Label</label>
                            <input type="text" class="form-control" id="label" name="label" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="type" required>
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

    <!-- Modal Edit Kriteria -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEdit" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel">Edit Kriteria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit-id">
                        <div class="mb-3">
                            <label for="edit-nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="edit-nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-label" class="form-label">Label</label>
                            <input type="text" class="form-control" id="edit-label" name="label" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-type" class="form-label">Type</label>
                            <input type="text" class="form-control" id="edit-type" name="type" required>
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
        const modalEdit = document.getElementById('modalEdit');
        modalEdit.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            const label = button.getAttribute('data-label');
            const type = button.getAttribute('data-type');

            const form = document.getElementById('formEdit');
            form.action = '/dashboard/criteria/' + id;

            document.getElementById('edit-nama').value = nama;
            document.getElementById('edit-label').value = label;
            document.getElementById('edit-type').value = type;
        });
    </script>
@endsection
