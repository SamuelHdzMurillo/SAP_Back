<?php

namespace App\Exports;

use App\Models\Promoted;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PromotedExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function collection()
    {
        $promotedData = Promoted::with('problems')->get();

        return $promotedData->map(function ($promoted) {
            return [
                'ID'            => $promoted->id,
                'Nombre'        => $promoted->name,
                'Apellido Materno'      => $promoted->second_name,
                'Apellido Paterno'      => $promoted->last_name,
                'Clave de Elector'      => $promoted->electoral_key,
                'Curp'      => $promoted->curp,
                'Teléfono'      => $promoted->phone_number,
                'Correo'        => $promoted->email,
                'Sección'       => $promoted->section,
                'Dirección'     => $promoted->adress,
                // Otras columnas que desees exportar
            ];
        });
    }
    
    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Apellido Materno',
            'Apellido Paterno',
            'Clave de Elector' ,
            'Curp'   ,
            'Teléfono',
            'Correo',
            'Sección',
            'Dirección',
            // Otros encabezados
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Estilos personalizados
        return [
            'A1:J1' => ['font' => ['bold' => true]], // Estilo negrita para la celda A1
        ];
    }
}
