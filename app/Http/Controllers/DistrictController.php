<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show($id)
    {
        // Buscar el distrito por ID
        $district = District::with(['municipal', 'sections.promoteds'])->find($id);

        // Si no se encuentra el distrito, devuelve un error 404
        if (!$district) {
            return response()->json(['message' => 'Distrito no encontrado.'], 404);
        }

        // Devuelve el distrito y sus relaciones en formato JSON
        return response()->json($district);
    }

    public function getPromotedCountByDistrict($districtId)
    {
        // Utiliza una consulta SQL para obtener el recuento de promovidos por el ID del distrito
        $promotedCount = DB::table('districts')
            ->join('municipals', 'districts.municipal_id', '=', 'municipals.id')
            ->join('sections', 'sections.district_id', '=', 'districts.id')
            ->join('promoteds', 'promoteds.section_id', '=', 'sections.id')
            ->where('districts.id', $districtId)
            ->count();

        return response()->json(['promoted_count' => $promotedCount]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, District $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        //
    }
}
