<?php

namespace App\Imports;

use App\Models\Promoted;
use App\Models\Section;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Http; // Importar la facade Http
use Illuminate\Support\Str;

class PromotedImport implements ToModel, WithHeadingRow
{
    protected string $promotorId;

    public function __construct(string $promotorId)
    {
        $this->promotorId = $promotorId;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {



        $direccionCompleta = $row['numero_ext'] . ', ' . $row['colonia'] . ', ' . $row['ciudad'] . ', ' . $row['estado'] . ', ' . 'Mexico';
        $response = Http::get("https://nominatim.openstreetmap.org/search", [
            'q' => $direccionCompleta,
            'format' => 'json',
            'limit' => 1
        ]);

        $latitude = null;
        $longitude = null;

        if ($response->successful() && count($response->json()) > 0) {
            $geocodeData = $response->json()[0];
            $latitude = $geocodeData['lat'];
            $longitude = $geocodeData['lon'];
        } else {
            // Manejo de errores, establecer valores predeterminados o loguear el problema
            // Establecer valores predeterminados en caso de falla
            $latitude = 0.0;
            $longitude = 0.0;
        }

        $section = Section::where("number", $row["section"])->first();

        return new Promoted([
            'name'          => $row['nombre'],
            'last_name'     => $row['apellidos'],
            'phone_number'  => $row['numero_telefonico'],
            'email'         => $row['correo'],
            'adress'        => $row['direccion'],
            'electoral_key' => $row['clave_electoral'],
            'curp'          => $row['curp'],
            'latitude'      => $latitude, // Seteado desde la geocodificación
            'longitude'     => $longitude, // Seteado desde la geocodificación
            'colony'        => $row['colonia'],
            'postal_code'   => $row['codigo_postal'],
            'house_number'  => $row['numero_ext'],
            'section_id'    => $section ? $section->id : null,
            'promotor_id'   => $this->promotorId,
        ]);
    }
}
