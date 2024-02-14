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
        $json = '[
            {
             "distrito": 2,
             "municipal": "La Paz"
            },        
            {
             "distrito": 3,
             "municipal": "La Paz"
            },        
            {
             "distrito": 4,
             "municipal": "La Paz"
            },        
            {
             "distrito": 5,
             "municipal": "La Paz"
            },        
            {
             "distrito": 6,
             "municipal": "La Paz"
            },        
            {
             "distrito": 10,
             "municipal": "comondu"
            },        
            {
             "distrito": 13,
             "municipal": "comondu"
            },
            {
                "distrito": 13,
                "municipal": "loreto"
               },        
            {
             "distrito": 14,
             "municipal": "Mulege"
            },        
            {
             "distrito": 15,
             "municipal": "la paz"
            },        
            {
             "distrito": 1,
             "municipal": "los cabos"
            },        
            {
             "distrito": 7,
             "municipal": "los cabos"
            },        
            {
             "distrito": 8,
             "municipal": "los cabos"
            },        
            {
             "distrito": 9,
             "municipal": "los cabos"
            },        
            {
             "distrito": 11,
             "municipal": "los cabos"
            },        
            {
             "distrito": 12,
             "municipal": "los cabos"
            },        
            {
             "distrito": 16,
             "municipal": "los cabos"
            }        
         ]';

        $data = json_decode($json, true);

        if (is_array($data)) {
            foreach ($data as $item) {
                $municipal = DB::table('municipals')->where('name', 'LIKE', '%' . $item['municipal'] . '%')->first();
                DB::table('districts')->insert([
                    'number' => $item['distrito'],
                    'municipal_id' => $municipal->id,
                ]);
            }
        } else {

            echo "Error decoding JSON";
        }
    }
}
