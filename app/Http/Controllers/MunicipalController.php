<?php

namespace App\Http\Controllers;

use App\Models\Municipal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
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

    public function totalPromotedsByMunicipality()
    {
        $counts = DB::table('promoteds')
            ->join('sections', 'promoteds.section_id', '=', 'sections.id')
            ->join('districts', 'sections.district_id', '=', 'districts.id')
            ->join('municipals', 'districts.municipal_id', '=', 'municipals.id')
            ->select('municipals.name as municipal_name', DB::raw('count(*) as total_promoveds'))
            ->groupBy('municipals.name')
            ->orderBy('municipals.name', 'asc')
            ->get();

        return response()->json(['municipals' => $counts]);
    }



    public function getMunicipalsByDateRange(Request $request)
    {
        $filter = $request->input('filter');

        if ($filter == 'week') {
            $start = Carbon::now()->startOfWeek();
            $end = Carbon::now()->endOfWeek();
        } elseif ($filter == 'month') {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
        } else {
            // Si no se proporciona un filtro, o si es un filtro no reconocido,
            // se puede establecer un rango de fechas predeterminado o retornar todos los datos.
            // Por ejemplo, aquí se retorna todo:
            $start = null;
            $end = null;
        }

        if (isset($start) && isset($end)) {
            $municipals = Municipal::with(['districts.sections' => function ($query) use ($start, $end) {
                $query->whereHas('promoteds', function ($query) use ($start, $end) {
                    $query->whereBetween('created_at', [$start, $end]);
                });
            }])->get();
        } else {
            $municipals = Municipal::with('districts.sections.promoteds')->get();
        }

        return response()->json($municipals);
    }

    public function countPromovedsInMunicipal($municipalId)
    {
        $count = DB::table('promoteds')
            ->join('sections', 'promoteds.section_id', '=', 'sections.id')
            ->join('districts', 'sections.district_id', '=', 'districts.id')
            ->join('municipals', 'districts.municipal_id', '=', 'municipals.id')
            ->where('municipals.id', '=', $municipalId)
            ->count();

        return response()->json(['promoted_count' => $count]);
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

    public function getAllDataWithFilters(Request $request)
    {
        // Filtros opcionales
        $municipalName = $request->input('municipal_name');
        $districtNumber = $request->input('district_number');
        $sectionNumber = $request->input('section_number');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Consulta principal
        $query = Municipal::with(['districts.sections.promoteds']);

        // Aplicar filtros si se proporcionan
        if ($municipalName) {
            $query->where('name', $municipalName);
        }

        $query->whereHas('districts', function ($query) use ($districtNumber, $sectionNumber, $startDate, $endDate) {
            if ($districtNumber) {
                $query->where('number', $districtNumber);
            }

            $query->whereHas('sections', function ($query) use ($sectionNumber, $startDate, $endDate) {
                if ($sectionNumber) {
                    $query->where('number', $sectionNumber);
                }

                if ($startDate && $endDate) {
                    $query->whereHas('promoteds', function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('created_at', [$startDate, $endDate]);
                    });
                }
            });
        });

        $data = $query->get();

        return response()->json(['data' => $data]);
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
            ->join('municipals', 'districts.municipal_id', '=', 'municipals.id') // Unir con la tabla municipals
            ->select(
                'municipals.name as municipal_name', // Seleccionar el nombre del municipio
                'districts.number as district_number',
                DB::raw('DATE(promoteds.created_at) as date'),
                DB::raw('count(*) as promoved_count')
            )
            ->groupBy('municipals.name', 'districts.number', 'date') // Agrupar también por el nombre del municipio
            ->orderBy('municipals.name', 'asc') // Ordenar primero por el nombre del municipio
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
    public function show($id)
    {
        $municipal = Municipal::find($id);
        return response()->json($municipal);
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
