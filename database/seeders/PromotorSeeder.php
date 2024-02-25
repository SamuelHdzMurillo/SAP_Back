<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Promotor;


class PromotorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promotors = [
            [
                'name' => 'Promotor Uno',
                'email' => 'promotor1@example.com',
                'phone_number' => '1111111111',
                'position' => 'Promotor Position 1',
                'profile_path' => '/path/to/promotor1.jpg',
                'ine_path' => '/path/to/promotor1_ine.jpg',

                'password' => Hash::make('securepassword1'),
                'municipal_id' => 1,

            ],
            [
                'name' => 'Promotor Dos',
                'email' => 'promotor2@example.com',
                'phone_number' => '2222222222',
                'position' => 'Promotor Position 2',
                'profile_path' => '/path/to/promotor2.jpg',
                'ine_path' => '/path/to/promotor2_ine.jpg',

                'password' => Hash::make('securepassword2'),
                'municipal_id' => 1,

            ],
        ];


        foreach ($promotors as $promotor) {
            DB::table('promotors')->insert($promotor);
        }


        // Promotor::factory(800)->create();
    }
}
