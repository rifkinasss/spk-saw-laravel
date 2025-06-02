<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NormalisasiDataset;

class NormalisasiSeeder extends Seeder
{
    public function run(): void
    {
        $kriteriaMap = [
            'BB/U'   => Kriteria::where('nama', 'Berat Badan Menurut Umur (BB/U)')->value('id'),
            'TB/U'   => Kriteria::where('nama', 'Tinggi Badan Menurut Umur (TB/U)')->value('id'),
            'BB/TB'  => Kriteria::where('nama', 'Berat Badan Menurut Tinggi Badan (BB/TB)')->value('id'),
            'IMT/U'  => Kriteria::where('nama', 'Indeks Massa Tubuh Menurut Umur (IMT/U)')->value('id'),
        ];

        // Dataset normalisasi
        $data = [
            ['S1', 1.00, 0.50, 1.00, 0.50],
            ['S2', 0.50, 0.75, 0.25, 0.25],
            ['S3', 0.25, 0.75, 1.00, 0.33],
            ['S4', 0.50, 1.00, 1.00, 0.50],
            ['S5', 0.25, 0.25, 0.75, 0.50],
            ['S6', 0.25, 1.00, 0.25, 0.50],
            ['S7', 0.75, 0.50, 0.25, 0.25],
            ['S8', 0.25, 0.25, 0.25, 0.50],
            ['S9', 1.00, 0.50, 1.00, 0.50],
            ['S10', 0.50, 0.25, 0.25, 0.50],
            ['S11', 0.50, 0.25, 0.75, 1.00],
            ['S12', 0.75, 0.75, 0.75, 0.33],
            ['S13', 0.25, 0.75, 0.25, 0.50],
            ['S14', 0.50, 1.00, 1.00, 1.00],
            ['S15', 0.25, 1.00, 0.25, 0.33],
            ['S16', 0.75, 1.00, 0.25, 1.00],
            ['S17', 1.00, 0.50, 1.00, 1.00],
            ['S18', 0.25, 1.00, 0.75, 1.00],
            ['S19', 0.50, 0.50, 0.75, 0.50],
            ['S20', 0.75, 0.25, 0.50, 0.50],
            ['S21', 1.00, 1.00, 0.75, 0.50],
            ['S22', 0.50, 1.00, 0.25, 1.00],
            ['S23', 0.25, 1.00, 0.75, 0.50],
            ['S24', 0.75, 0.25, 0.25, 0.33],
            ['S25', 0.50, 0.75, 0.75, 0.33],
            ['S26', 0.50, 1.00, 0.25, 0.50],
            ['S27', 1.00, 0.50, 0.25, 0.25],
            ['S28', 1.00, 1.00, 0.25, 1.00],
            ['S29', 0.75, 0.50, 0.75, 0.33],
            ['S30', 0.75, 1.00, 0.25, 0.33],
            ['S31', 1.00, 0.50, 0.75, 0.50],
            ['S32', 0.75, 1.00, 0.50, 0.25],
            ['S33', 1.00, 0.50, 1.00, 0.33],
            ['S34', 0.75, 0.75, 0.25, 0.50],
            ['S35', 0.25, 0.25, 1.00, 0.50],
            ['S36', 0.50, 0.25, 0.75, 1.00],
            ['S37', 0.25, 1.00, 0.75, 0.50],
            ['S38', 0.75, 1.00, 0.25, 1.00],
            ['S39', 0.75, 1.00, 0.50, 1.00],
            ['S40', 0.75, 0.75, 0.75, 0.50],
            ['S41', 0.25, 0.25, 0.75, 0.33],
            ['S42', 0.50, 0.25, 0.50, 0.50],
            ['S43', 0.75, 0.25, 0.50, 1.00],
            ['S44', 0.25, 0.75, 0.75, 0.25],
            ['S45', 0.50, 0.50, 0.75, 0.25],
            ['S46', 0.25, 0.75, 1.00, 1.00],
            ['S47', 0.25, 0.75, 0.25, 0.50],
            ['S48', 1.00, 0.50, 1.00, 0.25],
            ['S49', 0.75, 0.75, 1.00, 0.50],
            ['S50', 0.50, 1.00, 1.00, 0.25],
        ];

        foreach ($data as [$sampel, $bb_u, $tb_u, $bb_tb, $imt_u]) {
            $alternatif = Alternatif::where('sampel', $sampel)->first();

            if (!$alternatif) {
                info("Alternatif dengan sampel $sampel tidak ditemukan.");
                continue;
            }

            $values = [
                ['kode' => 'BB/U', 'nilai' => $bb_u],
                ['kode' => 'TB/U', 'nilai' => $tb_u],
                ['kode' => 'BB/TB', 'nilai' => $bb_tb],
                ['kode' => 'IMT/U', 'nilai' => $imt_u],
            ];

            foreach ($values as $val) {
                if (!isset($kriteriaMap[$val['kode']])) {
                    info("Kriteria {$val['kode']} tidak ditemukan.");
                    continue;
                }

                NormalisasiDataset::updateOrCreate(
                    [
                        'alternatif_id' => $alternatif->id,
                        'kriteria_id' => $kriteriaMap[$val['kode']],
                    ],
                    [
                        'nilai_normalisasi' => $val['nilai'],
                    ]
                );
            }
        }
    }
}
