<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Vaciar la tabla primero si es necesario
        DB::table('municipals')->delete();

        $municipals = [
            ['id' => 1, 'name' => 'COMONDU'],
            ['id' => 2, 'name' => 'MULEGE'],
            ['id' => 3, 'name' => 'LA PAZ'],
            ['id' => 5, 'name' => 'LORETO'],
            ['id' => 4, 'name' => 'LOS CABOS']
        ];

        foreach ($municipals as $municipal) {
            DB::table('municipals')->insert([
                'id' => $municipal['id'],
                'name' => $municipal['name']
            ]);
        }
    }
}
