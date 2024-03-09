<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener todos los distritos con sus relaciones paginados
        $query = District::with(['municipal', 'sections']);

        if ($request->has("number")) {
            $query->where("number", "LIKE", "%$request->number%");
        }

        if ($request->has("municipal")) {
            $query->whereHas("municipal", function ($query) use ($request) {
                $query->where("name", "LIKE", "%$request->municipal%");
            });
        }

        $districts = $query->paginate(10);

        // Crear una colección para almacenar los datos de cada distrito
        $data = collect();

        // Iterar sobre cada distrito y obtener la cantidad de secciones
        foreach ($districts as $district) {
            $sectionCount = $district->sections->count();

            // Crear un array con los datos del distrito, la cantidad de secciones y el municipio
            $districtData = [
                'key' => $district->id,
                'id' => $district->id,
                'number' => $district->number,
                'section_count' => $sectionCount,
                'municipal' => $district->municipal->name
            ];

            // Agregar los datos del distrito a la colección
            $data->push($districtData);
        }

        // Agregar la información de paginación al data
        $data = $data->toArray();
        $dataF['data'] = $data;
        $dataF['pagination'] = [
            'total' => $districts->total(),
            'per_page' => $districts->perPage(),
            'current_page' => $districts->currentPage(),
            'last_page' => $districts->lastPage(),
            'from' => $districts->firstItem(),
            'to' => $districts->lastItem()
        ];

        // Devolver los datos al front en formato JSON
        return response()->json($dataF);
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
