<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Promoted;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los registros de la tabla 'sections'
        $sections = Section::with(['district', 'promoteds', 'promotors'])->get();

        // Devolver los datos en formato JSON
        return response()->json(['message' => 'Sections retrieved successfully', 'data' => $sections]);
    }


    public function getPromotedsBySection($sectionId)
    {
        // Buscar la sección por ID con sus promovidos y la relación del municipio
        $section = Section::with(['promoteds', 'district.municipal'])->find($sectionId);

        // Si no se encuentra la sección, devuelve un error 404
        if (!$section) {
            return response()->json(['message' => 'Sección no encontrada.'], 404);
        }

        // Obtener el nombre del municipio
        $municipalityName = $section->district->municipal->name;

        // Ajustar la respuesta para incluir solo el nombre del municipio y los promovidos con información de la sección
        $response = [
            'municipality' => $municipalityName,
            'promoteds' => $section->promoteds->map(function ($promoted) use ($section) {
                // Incluir información de la sección en cada promovido
                $promoted['section'] = [
                    'id' => $section->id,
                    'number' => $section->number,
                ];
                return $promoted;
            }),
        ];

        // Devolver la respuesta en formato JSON
        return response()->json(['message' => 'Promovidos de la sección recuperados exitosamente', 'data' => $response]);
    }




    public function getPromotedCountBySection($sectionId)
    {
        // Utilizar una consulta SQL para obtener el recuento de promovidos por el ID de la sección
        $promotedCount = Promoted::where('section_id', $sectionId)->count();

        return response()->json(['promoted_count' => $promotedCount]);
    }

    public function show($id)
    {
        // Buscar la sección por ID con sus relaciones
        $section = Section::with(['district', "district.municipal", 'promoteds'])->find($id);

        // Si no se encuentra la sección, devuelve un error 404
        if (!$section) {
            return response()->json(['message' => 'Sección no encontrada.'], 404);
        }

        // Devolver la sección y sus relaciones en formato JSON
        return response()->json($section);
    }
}
