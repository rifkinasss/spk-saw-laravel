<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubKriteriaSeeder extends Seeder
{
    public function run()
    {
        // Ambil ID dari kriteria berdasarkan label
        $c1 = DB::table('kriterias')->where('label', 'C1')->first()->id;
        $c2 = DB::table('kriterias')->where('label', 'C2')->first()->id;
        $c3 = DB::table('kriterias')->where('label', 'C3')->first()->id;
        $c4 = DB::table('kriterias')->where('label', 'C4')->first()->id;

        $data = [
            // C1 - BB/U
            ['nama' => 'Gizi Buruk', 'nilai' => 1, 'kriteria_id' => $c1],
            ['nama' => 'Gizi Kurang', 'nilai' => 2, 'kriteria_id' => $c1],
            ['nama' => 'Gizi Baik', 'nilai' => 3, 'kriteria_id' => $c1],
            ['nama' => 'Gizi Lebih', 'nilai' => 4, 'kriteria_id' => $c1],

            // C2 - TB/U
            ['nama' => 'Sangat Pendek', 'nilai' => 1, 'kriteria_id' => $c2],
            ['nama' => 'Pendek', 'nilai' => 2, 'kriteria_id' => $c2],
            ['nama' => 'Normal', 'nilai' => 3, 'kriteria_id' => $c2],
            ['nama' => 'Tinggi', 'nilai' => 4, 'kriteria_id' => $c2],

            // C3 - BB/TB
            ['nama' => 'Sangat Kurus', 'nilai' => 1, 'kriteria_id' => $c3],
            ['nama' => 'Kurus', 'nilai' => 2, 'kriteria_id' => $c3],
            ['nama' => 'Normal', 'nilai' => 3, 'kriteria_id' => $c3],
            ['nama' => 'Gemuk', 'nilai' => 4, 'kriteria_id' => $c3],

            // C4 - IMT/U
            ['nama' => 'Sangat Kurus', 'nilai' => 1, 'kriteria_id' => $c4],
            ['nama' => 'Kurus', 'nilai' => 2, 'kriteria_id' => $c4],
            ['nama' => 'Normal', 'nilai' => 3, 'kriteria_id' => $c4],
            ['nama' => 'Gemuk', 'nilai' => 4, 'kriteria_id' => $c4],
        ];

        foreach ($data as $item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
            DB::table('sub_kriterias')->insert($item);
        }
    }
}
