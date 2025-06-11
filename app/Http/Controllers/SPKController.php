<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\SubKriteria;
use App\Models\Dataset;
use App\Models\NormalisasiDataset;
use App\Models\KonversiDataset;
use Illuminate\Http\Request;

class SPKController extends Controller
{
    // --- Dashboard utama ---
    public function index()
    {
        $title = 'Dashboard';
        $criteria = Kriteria::count();
        $alternatif = Alternatif::count();
        $subKriteria = SubKriteria::count();
        $dataset = Dataset::count();

        // Hitung hasil SAW
        $alternatifs = Alternatif::with('datasets')->get();
        $kriterias = Kriteria::all();

        $normalisasi = [];

        foreach ($kriterias as $kriteria) {
            $nilaiKriteria = [];

            foreach ($alternatifs as $alt) {
                $nilai = $alt->datasets->firstWhere('kriteria_id', $kriteria->id)->nilai ?? 0;
                $nilaiKriteria[] = $nilai;
            }

            $max = max($nilaiKriteria);
            $min = min($nilaiKriteria);

            foreach ($alternatifs as $alt) {
                foreach ($kriterias as $kriteria) {
                    $normalisasiDb = NormalisasiDataset::where('alternatif_id', $alt->id)
                        ->where('kriteria_id', $kriteria->id)
                        ->first();

                    $nilaiNormal = $normalisasiDb->nilai_normalisasi ?? 0;
                    $bobotNormalisasi = $kriteria->bobot_normalisasi;

                    $normalisasi[$alt->id][$kriteria->id] = $nilaiNormal * $bobotNormalisasi;
                }
            }
        }

        $hasil = [];
        foreach ($alternatifs as $alt) {
            $total = array_sum($normalisasi[$alt->id]);
            $hasil[] = [
                'alternatif' => $alt->sampel,
                'nilai' => round($total, 2),
            ];
        }

        // Urutkan dan ambil 5 besar
        usort($hasil, fn($a, $b) => $b['nilai'] <=> $a['nilai']);
        $top5 = array_slice($hasil, 0, 5);
        return view('dashboard', compact('title', 'criteria', 'alternatif', 'subKriteria', 'dataset', 'top5', 'hasil'));
    }

    // --- Kriteria ---
    public function index_criteria()
    {
        $kriterias = Kriteria::all();

        return view('criteria', [
            'title' => 'Criteria',
            'kriterias' => $kriterias,
        ]);
    }

    public function store_criteria(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'label' => 'required|string|max:10',
            'type' => 'required|string|max:10',
        ]);

        Kriteria::create($request->only('nama', 'label', 'type'));

        return redirect()->back()->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function update_criteria(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'label' => 'required|string|max:10',
            'type' => 'required|string|max:10',
        ]);

        $kriteria = Kriteria::findOrFail($id);
        $kriteria->update($request->only('nama', 'label', 'type'));

        return redirect()->back()->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy_criteria($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        return redirect()->route('dashboard.criteria')->with('success', 'Kriteria berhasil dihapus.');
    }

    // --- Sub Kriteria ---
    public function index_sub_criteria()
    {
        $title = 'Sub Criteria';
        $subkriterias = SubKriteria::with('kriteria')->get();
        $kriterias = Kriteria::all();

        return view('sub-criteria', compact('subkriterias', 'kriterias', 'title'));
    }

    public function store_sub_criteria(Request $request)
    {
        $request->validate([
            'kriteria_id' => 'required|exists:kriterias,id',
            'nama' => 'required|string|max:100',
            'nilai' => 'required|numeric',
        ]);

        SubKriteria::create($request->only('kriteria_id', 'nama', 'nilai'));

        return redirect()->back()->with('success', 'Sub Kriteria berhasil ditambahkan.');
    }

    public function update_sub_criteria(Request $request, $id)
    {
        $request->validate([
            'kriteria_id' => 'required|exists:kriterias,id',
            'nama' => 'required|string|max:100',
            'nilai' => 'required|numeric',
        ]);

        $subkriteria = SubKriteria::findOrFail($id);
        $subkriteria->update($request->only('kriteria_id', 'nama', 'nilai'));

        return redirect()->back()->with('success', 'Sub Kriteria berhasil diperbarui.');
    }

    public function destroy_sub_criteria($id)
    {
        $subkriteria = SubKriteria::findOrFail($id);
        $subkriteria->delete();

        return redirect()->back()->with('success', 'Sub Kriteria berhasil dihapus.');
    }

    // --- Alternatif ---
    public function index_alternatif()
    {
        $title = 'Alternatif';
        $alternatifs = Alternatif::with(['penilaians.kriteria', 'penilaians.subKriteria'])->get();

        return view('alternatif', compact('alternatifs', 'title'));
    }

    public function store_alternatif(Request $request)
    {
        $request->validate([
            'sampel' => 'required|string|max:255',
        ]);

        Alternatif::create($request->only('sampel'));

        return redirect()->route('dashboard.alternatif')->with('success', 'Data alternatif berhasil ditambahkan.');
    }

    public function update_alternatif(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'sampel' => 'required|string|max:255',
        ]);

        $alternatif->update($request->only('sampel'));

        return redirect()->route('dashboard.alternatif')->with('success', 'Data alternatif berhasil diperbarui.');
    }

    public function destroy_alternatif(Alternatif $alternatif)
    {
        $alternatif->delete();

        return redirect()->route('dashboard.alternatif')->with('success', 'Data alternatif berhasil dihapus.');
    }

    public function destroy_alternatif_2($id)
    {
        // Hapus semua dataset yang berhubungan dengan alternatif ini
        Dataset::where('alternatif_id', $id)->delete();

        // Hapus alternatif itu sendiri
        Alternatif::destroy($id);

        return redirect()->back()->with('success', 'Alternatif dan semua datanya berhasil dihapus.');
    }

    // --- Dataset ---
    public function index_dataset()
    {
        $title = 'Dataset';
        $datasets = Dataset::all()->groupBy('alternatif_id');
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();

        return view('dataset', compact('datasets', 'alternatifs', 'kriterias', 'title'));
    }

    public function store_dataset(Request $request)
    {
        $request->validate([
            'alternatif_id' => 'required|exists:alternatifs,id',
            'kriteria_id' => 'required|exists:kriterias,id',
            'nilai' => 'required|numeric',
        ]);

        Dataset::create($request->only('alternatif_id', 'kriteria_id', 'nilai'));

        return redirect()->back()->with('success', 'Dataset berhasil disimpan.');
    }

    public function update_dataset(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|numeric',
        ]);

        $dataset = Dataset::findOrFail($id);
        $dataset->update(['nilai' => $request->nilai]);

        return redirect()->back()->with('success', 'Dataset berhasil diperbarui.');
    }

    public function destroy_dataset($id)
    {
        $dataset = Dataset::findOrFail($id);
        $dataset->delete();

        return redirect()->back()->with('success', 'Dataset berhasil dihapus.');
    }




    // --- Normalisasi Dataset ---
    public function index_normalisasi()
    {
        $title = 'Normalisasi Dataset';
        $normalisasi = NormalisasiDataset::with(['alternatif', 'kriteria'])->get()->groupBy('alternatif_id');

        return view('normalisasi-dataset', compact('normalisasi', 'title'));
    }

    public function normalisasi_dataset()
    {
        $kriterias = Kriteria::all();

        foreach ($kriterias as $kriteria) {
            $max = Dataset::where('kriteria_id', $kriteria->id)->max('nilai');
            $datasets = Dataset::where('kriteria_id', $kriteria->id)->get();

            foreach ($datasets as $dataset) {
                $nilai_normalisasi = $max > 0 ? ($dataset->nilai / $max) : 0;

                NormalisasiDataset::updateOrCreate(
                    [
                        'alternatif_id' => $dataset->alternatif_id,
                        'kriteria_id' => $kriteria->id,
                    ],
                    [
                        'nilai_normalisasi' => $nilai_normalisasi,
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Normalisasi dataset selesai.');
    }

    // --- Konversi Dataset ---
    public function index_konversi()
    {
        $title = 'Konversi Dataset';
        $konversis = KonversiDataset::with(['alternatif', 'kriteria', 'subKriteria'])->get();

        return view('konversi-dataset', compact('konversis', 'title'));
    }

    public function konversi_dataset()
    {
        $datasets = Dataset::all();

        foreach ($datasets as $dataset) {
            $subs = SubKriteria::where('kriteria_id', $dataset->kriteria_id)
                ->orderBy('nilai', 'asc')
                ->get();

            $subDipilih = null;

            foreach ($subs as $sub) {
                if ($dataset->nilai <= $sub->nilai) {
                    $subDipilih = $sub;
                    break;
                }
            }

            if (!$subDipilih) {
                $subDipilih = $subs->last();
            }

            if ($subDipilih) {
                KonversiDataset::updateOrCreate(
                    [
                        'alternatif_id' => $dataset->alternatif_id,
                        'kriteria_id' => $dataset->kriteria_id,
                    ],
                    [
                        'sub_kriteria_id' => $subDipilih->id,
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Konversi dataset selesai.');
    }

    // --- Hasil ---
    public function hasilSAW()
    {
        $title = 'Hasil SAW';

        $alternatifs = Alternatif::with('datasets')->get();
        $kriterias = Kriteria::all();

        $normalisasi = [];

        foreach ($kriterias as $kriteria) {
            $nilaiKriteria = [];

            foreach ($alternatifs as $alt) {
                $nilai = $alt->datasets->firstWhere('kriteria_id', $kriteria->id)->nilai ?? 0;
                $nilaiKriteria[] = $nilai;
            }

            $max = max($nilaiKriteria);
            $min = min($nilaiKriteria);

            foreach ($alternatifs as $alt) {
                foreach ($kriterias as $kriteria) {
                    $normalisasiDb = NormalisasiDataset::where('alternatif_id', $alt->id)
                        ->where('kriteria_id', $kriteria->id)
                        ->first();

                    $nilaiNormal = $normalisasiDb->nilai_normalisasi ?? 0;
                    $bobotNormalisasi = $kriteria->bobot_normalisasi; // pastikan ini field di database dan model Kriteria

                    $normalisasi[$alt->id][$kriteria->id] = $nilaiNormal * $bobotNormalisasi;
                }
            }
        }

        $hasil = [];
        foreach ($alternatifs as $alt) {
            $total = array_sum($normalisasi[$alt->id]);
            $hasil[] = [
                'alternatif' => $alt->sampel,
                'nilai' => round($total, 2),
            ];
        }

        usort($hasil, fn($a, $b) => $b['nilai'] <=> $a['nilai']);

        return view('hasil-saw', compact('hasil', 'title'));
    }
}
