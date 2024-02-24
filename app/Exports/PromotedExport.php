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
    use Exportable;

    private $sectionId;
    private $districtId;

    public function forSection($sectionId)
    {
        $this->sectionId = $sectionId;

        return $this;
    }

    public function forDistrict($districtId)
    {
        $this->districtId = $districtId;

        return $this;
    }

    public function collection()
    {
        $query = Promoted::with(['problems', 'section.district']);

        if ($this->sectionId) {
            $query->where('section_id', $this->sectionId);
        }

        if ($this->districtId) {
            $query->whereHas('section', function ($query) {
                $query->where('district_id', $this->districtId);
            });
        }

        $promotedData = $query->get();

        return $promotedData->map(function ($promoted) {
            return [
                'Nombre'        => $promoted->name,
                'Apellidos'      => $promoted->last_name,
                'Clave de Elector'      => $promoted->electoral_key,
                'Curp'      => $promoted->curp,
                'Teléfono'      => $promoted->phone_number,
                'Correo'        => $promoted->email,
                'Sección'       => $promoted->section->number,
                'Distrito'      => $promoted->section->district->number,
                'Dirección'     => $promoted->adress,
                // Otras columnas que desees exportar
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Apellido Materno',
            'Clave de Elector',
            'Curp',
            'Teléfono',
            'Correo',
            'Sección',
            'Distrito',
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
