<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\District;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([MunicipalitySeeder::class]);
        $this->call([DistricSeeder::class]);
        $this->call([SectionSeeder::class]);
    }
}
