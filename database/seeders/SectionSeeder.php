<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numberOfSections = 10; // Ajusta este número según sea necesario

        for ($i = 1; $i <= $numberOfSections; $i++) {
            DB::table('sections')->insert([
                'number' => (string)$i, // El número de la sección como string
                'district_id' => 1, // ID del distrito asignado a 1
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
