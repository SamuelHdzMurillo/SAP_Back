<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear un admin de ejemplo
        Admin::create([
            'name' => 'Admin Ejemplo',
            'email' => 'admin@example.com',
            'phone_number' => '123456789',
            'profile_img_path' => '/path/to/samuel.jpg',
            'password' => bcrypt('password'),
        ]);

        // Puedes agregar más registros según sea necesario
    }
}
