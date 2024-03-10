<?php

namespace App\Http\Controllers;

use App\Models\GoalDistrict;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GoalDistrictController extends Controller
{
    public function index()
    {
        $query = GoalDistrict::with('district.sections.promoteds');

        $goalsDistrict = $query->get()->map(function ($goalDistrict) {
            // Conteo manual de promovidos
            $promotedCount = $goalDistrict->district->sections->flatMap(function ($section) use ($goalDistrict) {
                // Filtrar promovidos por fecha
                return $section->promoteds->filter(function ($promoted) use ($goalDistrict) {
                    return Carbon::parse($promoted->created_at)->between($goalDistrict->start_date, $goalDistrict->end_date);
                });
            })->count();

            return [
                'id' => $goalDistrict->id,
                'district_name' => $goalDistrict->district->number,
                'promoted_count' => $promotedCount,
                'goal_name' => $goalDistrict->goalName,
                'goal_value' => $goalDistrict->goalValue,
            ];
        });

        return response()->json(['goals' => $goalsDistrict]);
    }




    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $validatedData = $request->validate([
            'goalName' => 'required|max:255',
            'goalValue' => 'required|integer',
            'district_id' => 'required|exists:districts,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Crear un nuevo objetivo de distrito con los datos validados
        $goalDistrict = GoalDistrict::create($validatedData);

        // Conteo manual de promovidos
        $promotedCount = 0;
        foreach ($goalDistrict->district->sections as $section) {
            $promotedCount += $section->promoteds->count();
        }

        // Devolver la respuesta con el mensaje, los detalles del objetivo de distrito creado y el conteo de promovidos
        return response()->json(['message' => 'Goal District created successfully', 'goal' => [
            'id' => $goalDistrict->id,
            'municipal_name' => $goalDistrict->district->number,
            'promoted_count' => $promotedCount,
            'goal_name' => $goalDistrict->goalName,
            'goal_value' => $goalDistrict->goalValue,
        ]], 201);
    }

    public function show(GoalDistrict $goalDistrict)
    {
        // Obtener los promovidos filtrados por fecha
        $promoteds = $goalDistrict->district->sections->flatMap(function ($section) use ($goalDistrict) {
            return $section->promoteds->filter(function ($promoted) use ($goalDistrict) {
                return Carbon::parse($promoted->date_column)->between($goalDistrict->start_date, $goalDistrict->end_date, true);
            });
        });

        // Conteo de promovidos
        $promotedCount = $promoteds->count();

        // Respuesta JSON con información del GoalDistrict y los promovidos
        return response()->json([
            'id' => $goalDistrict->id,
            'district_name' => $goalDistrict->district->number,
            'promoted_count' => $promotedCount,
            'goal_name' => $goalDistrict->goalName,
            'goal_value' => $goalDistrict->goalValue,
            'promoteds' => $promoteds,
        ]);
    }

    public function update(Request $request, GoalDistrict $goalDistrict)
    {
        $validatedData = $request->validate([
            'goalName' => 'required|max:255',
            'goalValue' => 'required|integer',
            'district_id' => 'required|exists:districts,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $goalDistrict->update($validatedData);

        // Conteo manual de promovidos
        $promotedCount = 0;
        foreach ($goalDistrict->district->sections as $section) {
            $promotedCount += $section->promoteds->count();
        }

        // Devolver la respuesta con el mensaje, los detalles del objetivo de distrito actualizado y el conteo de promovidos
        return response()->json(['message' => 'Goal District updated successfully', 'goal' => [
            'id' => $goalDistrict->id,
            'district_name' => $goalDistrict->district->number,
            'promoted_count' => $promotedCount,
            'goal_name' => $goalDistrict->goalName,
            'goal_value' => $goalDistrict->goalValue,
        ]]);
    }

    public function destroy(GoalDistrict $goalDistrict)
    {
        $goalDistrict->delete();
        return response()->json(['message' => 'Goal District deleted successfully']);
    }
}
