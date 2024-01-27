<?php

namespace App\Http\Controllers;

use App\Models\Promoted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PromotedImport;
use App\Exports\PromotedExport;
use App\Http\Resources\PromotedResource;
use App\Http\Resources\PromotedsDashboard;
use App\Models\Promotor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PromotedController extends Controller
{
    /**
     * Muestra una lista de los registros Promoted.
     */
    public function index()
    {
        $promoteds = Promoted::with('section', "promotor")->paginate(10);
        return PromotedResource::collection($promoteds);
    }

    public function getPromotedByPromotors(Request $request)
    {
        $filter = $request->input('filter');

        if ($filter == 'week') {
            $start = Carbon::now()->startOfWeek();
            $end = Carbon::now()->endOfWeek();
        } elseif ($filter == 'month') {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
        }

        if (isset($start) && isset($end)) {
            $promoteds = Promotor::with(['promoteds' => function ($query) use ($start, $end) {
                $query->whereBetween('created_at', [$start, $end]);
            }])->get();
        } else {
            $promoteds = Promotor::with("promoteds")->get();
        }

        return PromotedsDashboard::collection($promoteds);
    }

    public function getPromotedByDatesPage(Request $request)
    {
        $filter = $request->input('filter');
        if ($filter == 'week') {
            $start = Carbon::now()->startOfWeek();
            $end = Carbon::now()->endOfWeek();
        } elseif ($filter == 'month') {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
        } else {
            $start = Carbon::now()->subYear()->startOfYear();
            $end = Carbon::now();
        }
        if (isset($start) && isset($end)) {
            if ($filter == 'week' || $filter == 'month') {
                $promoteds = Promoted::select(DB::raw('DAY(created_at) as day'), DB::raw('COUNT(*) as value'))
                    ->whereBetween('created_at', [$start, $end])
                    ->groupBy('day')
                    ->orderBy('day', 'asc')
                    ->get();
            } else {
                $promoteds = Promoted::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as value'))
                    ->whereBetween('created_at', [$start, $end])
                    ->groupBy('year', 'month')
                    ->orderBy('year', 'asc')
                    ->orderBy('month', 'asc')
                    ->get()
                    ->map(function ($item) {
                        $item->day = Carbon::createFromFormat('Y-m', $item->year . '-' . $item->month)->format('F Y');
                        return $item;
                    });
            }
        }

        return response()->json(['promoteds' => $promoteds]);
    }

    public function getPromotedByDates(Request $request)
    {
        $filter = $request->input('filter');

        if ($filter == 'week') {
            $start = Carbon::now()->startOfWeek();
            $end = Carbon::now()->endOfWeek();
        } elseif ($filter == 'month') {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
        }
        if (isset($start) && isset($end)) {
            $promoteds_count = Promoted::where("created_at", ">=", $start)->where("created_at", "<=", $end)->count();
        } else {
            $promoteds_count = Promoted::count();
        }




        return response()->json(['promoteds_count' => $promoteds_count]);
    }

    public function uploadExcel(Request $request, $promotorId)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');
        Excel::import(new PromotedImport(1), $file);

        return response()->json(['message' => "Archivo Excel importado con exito."]);
    }

    public function export()
    {
        return Excel::download(new PromotedExport, 'Promovidos.xlsx');
    }


    /**
     * Guarda un nuevo registro Promoted.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|email|unique:promoteds,email',
            'adress' => 'required|string|max:255',
            'electoral_key' => 'required|string|max:255',
            'curp' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
            'longitude' => 'required|string|max:255',
            'section_id' => 'required|integer|exists:sections,id',
            'promotor_id' => 'required|integer|exists:sections,id' // Asegúrate de que el ID de sección exista
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $promoted = Promoted::create($validator->validated());
        return response()->json($promoted, 201);
    }

    /**
     * Muestra un registro Promoted específico.
     */
    public function show($id)
    {
        $promoted = Promoted::with('problems', "promotor")->with(["section" => function ($q) {
            $q->with("district");
        }])->find($id);
        return new PromotedResource($promoted);
    }

    /**
     * Actualiza un registro Promoted específico.
     */
    public function update(Request $request, $id)
    {

        DB::beginTransaction();

        $promoted = Promoted::find($id);
        if (!$promoted) {
            return response()->json(['message' => 'Promoted not found'], 404);
        }

        $promoted->name = strlen($request->input('name')) > 0 ? $request->input('name') : $promoted->name;
        $promoted->last_name = strlen($request->input('last_name')) > 0 ? $request->input('last_name') : $promoted->last_name;
        $promoted->phone_number = strlen($request->input('phone_number')) > 0 ? $request->input('phone_number') : $promoted->phone_number;
        $promoted->email = strlen($request->input('email')) > 0 ? $request->input('email') : $promoted->email;
        $promoted->adress = strlen($request->input('adress')) > 0 ? $request->input('adress') : $promoted->adress;
        $promoted->electoral_key = strlen($request->input('electoral_key')) > 0 ? $request->input('electoral_key') : $promoted->electoral_key;
        $promoted->curp = strlen($request->input('curp')) > 0 ? $request->input('curp') : $promoted->curp;
        $promoted->latitude = strlen($request->input('latitude')) > 0 ? $request->input('latitude') : $promoted->latitude;
        $promoted->longitude = strlen($request->input('longitude')) > 0 ? $request->input('longitude') : $promoted->longitude;
        $promoted->section_id = $request->input('section_id') > 0 ? $request->input('section_id') : $promoted->section_id;
        $promoted->promotor_id = $request->input('promotor_id') > 0 ? $request->input('promotor_id') : $promoted->promotor_id;
        $promoted->save();
        DB::commit();
        return response()->json($promoted, 200);
    }


    /**
     * Elimina un registro Promoted específico.
     */
    public function destroy($id)
    {

        $promoted = Promoted::find($id);
        if (!$promoted) {
            return response()->json(['message' => 'Promoted not found'], 404);
        }
        $promoted->delete();
        return response()->json([
            "data" => $promoted
        ], 200);
    }

    public function getMonths()
    {
        $months = [];
        $date = Carbon::now();

        for ($i = 0; $i < 12; $i++) {
            $months[] = $date->format('F Y');
            $date->subMonth();
        }

        return $months;
    }

    // Aquí puedes agregar otros métodos y lógicas específicas para tu aplicación
}
