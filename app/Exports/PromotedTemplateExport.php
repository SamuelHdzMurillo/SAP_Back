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
            'colonia',
            'codigo_postal',
            'numero_ext',
            'section',
            'ciudad',
            'estado',
            'direccion_calles_num_de_casa',
            'clave_electoral',
            'curp',


            // Otros encabezados
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Estilos personalizados
        {
            // Estilos personalizados
            return [
                'A1:M1' => [
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFF'], // Color de texto rojo
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFFFFF'], // Color de fondo blanco
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Color del borde negro
                        ],
                    ],
                ],
                'A1:C1' => [
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FF0000'], // Color de texto rojo
                    ],
                ],
                'E1:H1' => [
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FF0000'], // Color de texto rojo
                    ],
                ],
                'K1:K1' => [
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FF0000'], // Color de texto rojo
                    ],
                ],
            ];
        }
    }
}
