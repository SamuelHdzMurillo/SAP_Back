<?php

namespace App\Http\Controllers;

use App\Models\Municipal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class MunicipalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los municipios con relaciones
        $municipals = Municipal::with(['districts.sections.promotors', 'districts.sections.promoteds'])->paginate(10);

        // Devolver los datos en formato JSON
        return response()->json($municipals);
    }

    public function countPromovedsInDistrict($municipalId, $districtId)
    {
        $count = DB::table('promoteds')
            ->join('sections', 'promoteds.section_id', '=', 'sections.id')
            ->join('districts', 'sections.district_id', '=', 'districts.id')
            ->join('municipals', 'districts.municipal_id', '=', 'municipals.id')
            ->where('municipals.id', '=', $municipalId)
            ->where('districts.id', '=', $districtId)
            ->count();

        return response()->json(['count' => $count]);
    }

    public function countPromovedsInAll()
    {
        $counts = DB::table('promoteds')
            ->join('sections', 'promoteds.section_id', '=', 'sections.id')
            ->join('districts', 'sections.district_id', '=', 'districts.id')
            ->join('municipals', 'districts.municipal_id', '=', 'municipals.id')
            ->select('municipals.name as municipal_name', 'districts.number as district_number', DB::raw('count(*) as promoved_count'))
            ->groupBy('municipals.name', 'districts.number')
            ->orderBy('municipals.name', 'asc')
            ->orderBy('districts.number', 'asc')
            ->get();

        return response()->json(['counts' => $counts]);
    }

    public function countPromovedsInSections()
    {
        $counts = DB::table('promoteds')
            ->join('sections', 'promoteds.section_id', '=', 'sections.id')
            ->select('sections.number as section_number', DB::raw('count(*) as promoved_count'))
            ->groupBy('sections.number')
            ->orderBy('sections.number', 'asc')
            ->get();

        return response()->json(['counts' => $counts]);
    }

    public function countPromovedsInSectionsByDate()
    {
        $counts = DB::table('promoteds')
            ->join('sections', 'promoteds.section_id', '=', 'sections.id')
            ->select('sections.number as section_number', DB::raw('DATE(promoteds.created_at) as date'), DB::raw('count(*) as promoved_count'))
            ->groupBy('sections.number', 'date')
            ->orderBy('sections.number', 'asc')
            ->orderBy('date', 'asc')
            ->get();

        return response()->json(['counts' => $counts]);
    }

    public function countPromovedsInDistrictsByDate()
    {
        $counts = DB::table('promoteds')
            ->join('sections', 'promoteds.section_id', '=', 'sections.id')
            ->join('districts', 'sections.district_id', '=', 'districts.id')
            ->select('districts.number as district_number', DB::raw('DATE(promoteds.created_at) as date'), DB::raw('count(*) as promoved_count'))
            ->groupBy('districts.number', 'date')
            ->orderBy('districts.number', 'asc')
            ->orderBy('date', 'asc')
            ->get();

        return response()->json(['counts' => $counts]);
    }

    public function sectionsWithPromovedCount()
    {
        $sections = DB::table('sections')
            ->join('districts', 'sections.district_id', '=', 'districts.id')
            ->join('municipals', 'districts.municipal_id', '=', 'municipals.id') // Asegurarse de unir con municipals
            ->leftJoin('promoteds', 'sections.id', '=', 'promoteds.section_id')
            ->select(
                'municipals.name as municipal_name', // Añadir el nombre del municipio
                'districts.number as district_number',
                'sections.id as section_id',
                'sections.number as section_number',
                DB::raw('count(promoteds.id) as promoved_count')
            )
            ->groupBy('municipals.name', 'districts.number', 'sections.id', 'sections.number')
            ->orderBy('municipals.name', 'asc') // Ordenar por nombre de municipio primero
            ->orderBy('districts.number', 'asc')
            ->orderBy('sections.number', 'asc')
            ->get();

        return response()->json(['sections' => $sections]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Municipal $municipal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Municipal $municipal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Municipal $municipal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Municipal $municipal)
    {
        //
    }
}
