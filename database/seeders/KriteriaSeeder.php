<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Berat Badan Menurut Umur (BB/U)',
                'label' => 'C1',
                'type' => 'Benefit',
                'bobot' => '4.00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Tinggi Badan Menurut Umur (TB/U)',
                'label' => 'C2',
                'type' => 'Benefit',
                'bobot' => '4.00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Berat Badan Menurut Tinggi Badan (BB/TB)',
                'label' => 'C3',
                'type' => 'Benefit',
                'bobot' => '4.00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Indeks Massa Tubuh Menurut Umur (IMT/U)',
                'label' => 'C4',
                'type' => 'Cost',
                'bobot' => '1.00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Hitung total bobot
        $totalBobot = collect($data)->sum('bobot');

        foreach ($data as &$kriteria) {
            // Hitung bobot normalisasi
            $kriteria['bobot_normalisasi'] = round($kriteria['bobot'] / $totalBobot, 2);
            $kriteria['created_at'] = now();
            $kriteria['updated_at'] = now();
        }

        DB::table('kriterias')->insert($data);
    }
}
