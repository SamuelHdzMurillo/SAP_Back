<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ejemplo de datos, asegúrate de que los 'promoted_id' existen en la tabla 'promoteds'
        $problems = [
            [
                'title' => 'Problema 1',
                'description' => 'Descripción del problema 1',
                'problem_img_path' => '/img/path1.jpg',
                'promoted_id' => 1 // Asegúrate de que este ID exista en la tabla 'promoteds'
            ],
            [
                'title' => 'Problema 2',
                'description' => 'Descripción del problema 2',
                'problem_img_path' => '/img/path2.jpg',
                'promoted_id' => 1
            ],
            [
                'title' => 'Problema 3',
                'description' => 'Descripción del problema 3',
                'problem_img_path' => '/img/path3.jpg',
                'promoted_id' => 2
            ],
            [
                'title' => 'Problema 4',
                'description' => 'Descripción del problema 4',
                'problem_img_path' => '/img/path4.jpg',
                'promoted_id' => 2
            ],
        ];

        foreach ($problems as $problem) {
            DB::table('problems')->insert($problem);
        }
    }
}
