<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmins = [
            [
                'name' => 'Daniel',
                'email' => 'daniel@example.com',
                'phone_number' => '1234567890',
                'profile_img_path' => null, // Asume una ruta de imagen ficticia
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Utiliza una contraseña segura en producción
            ],
            [
                'name' => 'Samuel',
                'email' => 'samuel@example.com',
                'phone_number' => '0987654321',
                'profile_img_path' => null, // Asume una ruta de imagen ficticia
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Utiliza una contraseña segura en producción
            ],
        ];

        foreach ($superAdmins as $admin) {
            DB::table('super_admins')->insert($admin);
        }
    }
}
