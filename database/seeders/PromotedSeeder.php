<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Promoted;

class PromotedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promoteds = [
            [
                'name' => 'Promovido',

                'last_name' => 'Apellido',
                'phone_number' => '1234567890',
                'email' => 'promovido1@example.com',

                'adress' => 'Calle Ficticia 123',
                'electoral_key' => Str::random(18),
                'curp' => Str::random(18),
                'latitude' => '19.432608',
                'longitude' => '-99.133209',
                'section_id' => 1,
                'promotor_id' => 1, // Asegúrate de que este ID exista en la tabla 'sections'
            ],
            [
                'name' => 'Promovido',

                'last_name' => 'Apellido',
                'phone_number' => '0987654321',
                'email' => 'promovido2@example.com',

                'adress' => 'Calle Ficticia 456',
                'electoral_key' => Str::random(18),
                'curp' => Str::random(18),
                'latitude' => '19.432608',
                'longitude' => '-99.133209',
                'section_id' => 1,
                'promotor_id' => 1, // Asegúrate de que este ID exista en la tabla 'sections'
            ],
        ];

        foreach ($promoteds as $promoted) {
            DB::table('promoteds')->insert($promoted);
        }

        Promoted::factory(10000)->create();
    }
}
