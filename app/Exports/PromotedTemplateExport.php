<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PromotedTemplateExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        // Devuelve una colección vacía
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'nombre',
            'apellidos',
            'numero_telefonico',
            'correo',
            'direccion',
            'clave_electoral',
            'curp',
            'latitude',
            'longitude',
            'colonia',
            'codigo_postal',
            'numero_ext',
            'section',
            'ciudad',
            'estado',
            // Otros encabezados
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Estilos personalizados
        {
            // Estilos personalizados
            return [
                'A1:O1' => [
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'], // Color de texto blanco
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '3498db'], // Color de fondo azul
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Color del borde negro
                        ],
                    ],
                ],
            ];
        }
    }
}
