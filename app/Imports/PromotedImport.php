<?php

namespace App\Imports;

use App\Models\Promoted;
use App\Models\Section;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Http;
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
        // Verificar si los datos necesarios para la dirección están presentes
        $hasAddressData = isset($row['numero_ext']) && isset($row['colonia']) && isset($row['ciudad']) && isset($row['estado']);

        // Construir la dirección completa solo si los datos están presentes
        $direccionCompleta = $hasAddressData
            ? $row['numero_ext'] . ', ' . $row['colonia'] . ', ' . $row['ciudad'] . ', ' . $row['estado'] . ', ' . 'Mexico'
            : null;

        // Inicializar valores predeterminados para latitud y longitud
        $latitude = 0.0;
        $longitude = 0.0;

        // Realizar la geocodificación solo si los datos necesarios están presentes
        if ($hasAddressData) {
            $response = Http::get("https://nominatim.openstreetmap.org/search", [
                'q' => $direccionCompleta,
                'format' => 'json',
                'limit' => 1
            ]);

            if ($response->successful() && count($response->json()) > 0) {
                $geocodeData = $response->json()[0];
                $latitude = $geocodeData['lat'];
                $longitude = $geocodeData['lon'];
            }
        }

        // Buscar la sección por número
        $section = Section::where("number", $row["section"])->first();

        // Si la sección no se encuentra, puedes manejarlo de la siguiente manera
        if (!$section) {
            // Puedes lanzar una excepción, loggear el problema o establecer valores predeterminados
            return null; // Retorna null para indicar que no se debe crear un registro en este caso
        }

        return new Promoted([
            'name'          => $row['nombre'],
            'last_name'     => $row['apellidos'],
            'phone_number'  => $row['numero_telefonico'],
            'email'         => $row['correo'],
            'adress'        => $row['direccion_calles_num_de_casa'],
            'electoral_key' => $row['clave_electoral'],
            'curp'          => $row['curp'],
            'latitude'      => $latitude,
            'longitude'     => $longitude,
            'colony'        => $row['colonia'],
            'postal_code'   => $row['codigo_postal'],
            'house_number'  => $row['numero_ext'],
            'section_id'    => $section->id, // Usar el ID de la sección encontrada
            'promotor_id'   => $this->promotorId,
        ]);
    }
}
