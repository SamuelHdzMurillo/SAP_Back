<?php

namespace App\Http\Controllers;

use App\Models\PrioritySection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Promoted;
use Illuminate\Support\Facades\DB;


class PrioritySectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required|string',
            'data' => 'required|array',
        ]);

        // Convertir el array a una cadena antes de almacenarlo
        $dataAsString = json_encode($request->input('data'));

        $prioritySection = PrioritySection::create([
            'Name' => $request->input('Name'),
            'data' => $dataAsString,
        ]);

        // Transformar la respuesta para que coincida con el formato deseado
        $data = json_decode($prioritySection->data); // Decodificar la cadena JSON en un array
        $sectionInfo = Section::whereIn('id', $data)->pluck('number', 'id');

        $promotedsCountBySection = Promoted::whereIn('section_id', $data)
            ->select('section_id', DB::raw('count(*) as promoteds_count'))
            ->groupBy('section_id')
            ->get();

        // Obtener la información solo para 'promoteds_by_priority_section'
        $promotedsByPrioritySection = $promotedsCountBySection->map(function ($item) use ($sectionInfo) {
            return [
                'section_id' => $item->section_id,
                'section_name' => $sectionInfo[$item->section_id],
                'promoteds_count' => $item->promoteds_count,
            ];
        });

        $transformedPrioritySection = [
            'id' => $prioritySection->id,
            'Name' => $prioritySection->Name,
            'data' => $prioritySection->data,
            'promoteds_by_priority_section' => $promotedsByPrioritySection,
        ];

        return response()->json(['message' => 'Priority section created successfully', 'priority_section' => $transformedPrioritySection], 201);
    }


    public function destroy($id)
    {
        try {
            $prioritySection = PrioritySection::findOrFail($id);
            $prioritySection->delete();

            return response()->json(['message' => 'Registro eliminado correctamente'], 200);
        } catch (\Exception $e) {
            // Manejo de errores, puedes personalizarlo según tus necesidades
            return response()->json(['error' => 'Error al eliminar el registro'], 500);
        }
    }




    public function index(Request $request)
    {
        // Obtener todos los registros de la tabla 'priority_sections'
        $prioritySections = PrioritySection::all();

        // Transformar la respuesta para que coincida con el formato deseado
        $transformedPrioritySections = $prioritySections->map(function ($prioritySection) {
            $data = json_decode($prioritySection->data); // Decodificar la cadena JSON en un array

            // Obtener los nombres y IDs de las secciones correspondientes a los IDs en 'data'
            $sectionInfo = Section::whereIn('id', $data)->pluck('number', 'id');

            $promotedsCountBySection = Promoted::whereIn('section_id', $data)->select('section_id', DB::raw('count(*) as promoteds_count'))->groupBy('section_id')->get();

            // Obtener la información solo para 'promoteds_by_priority_section'
            $promotedsByPrioritySection = $promotedsCountBySection->map(function ($item) use ($sectionInfo) {
                return [
                    'section_id' => $item->section_id,
                    'section_name' => $sectionInfo[$item->section_id],
                    'promoteds_count' => $item->promoteds_count,
                ];
            });

            return [
                'id' => $prioritySection->id,
                'Name' => $prioritySection->Name,
                'data' => $prioritySection->data,
                'promoteds_by_priority_section' => $promotedsByPrioritySection,
            ];
        });

        return response()->json(['message' => 'Priority Sections retrieved successfully', 'data' => $transformedPrioritySections]);
    }
}
