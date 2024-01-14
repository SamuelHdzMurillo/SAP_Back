<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $json ='[
            {
                "municipio": 3,
                "distrito_local": 1,
                "distrito_local_N": "2"
            }
        ]';

        $data = json_decode($json, true);

        if (is_array($data)) {
            foreach ($data as $item) {
                DB::table('districts')->insert([
                    'number' => $item['distrito_local_N'], // Asumiendo que 'number' es un string
                    'id' => $item['distrito_local'], // Esto sobrescribirá el autoincremento si está configurado
                    'municipal_id' => $item['municipio'], // Si necesitas insertar esto, asegúrate de que la columna exista
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } else {
            // Manejar el error si el JSON no se puede decodificar
            // Podría ser una buena idea lanzar una excepción o mostrar un mensaje de error aquí
            echo "Error decoding JSON";
        }
    }
}
