<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternatifSeeder extends Seeder
{
    public function run()
    {
        $data = [];

        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'sampel' => 'S' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('alternatifs')->insert($data);
    }
}
