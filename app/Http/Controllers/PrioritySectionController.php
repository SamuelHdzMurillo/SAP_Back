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















    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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

        return response()->json(['message' => 'Priority section created successfully', 'data' => $prioritySection]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PrioritySection $prioritySection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrioritySection $prioritySection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrioritySection $prioritySection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrioritySection $prioritySection)
    {
        //
    }
}
