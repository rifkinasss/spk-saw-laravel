<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AlternatifSeeder::class,
            KriteriaSeeder::class,
            SubKriteriaSeeder::class,
            DatasetSeeder::class,
            NormalisasiSeeder::class
        ]);
    }
}
