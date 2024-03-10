<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GoalController extends Controller
{
    // Asegúrate de importar la clase Carbon

    public function index()
    {
        $query = Goal::with(['municipal.districts.sections.promoteds']);

        $goals = $query->get()->map(function ($goal) {
            // Conteo manual de promovidos con filtro por fecha
            $promotedCount = $goal->municipal->districts->flatMap(function ($district) use ($goal) {
                return $district->sections->flatMap(function ($section) use ($goal) {
                    return $section->promoteds->filter(function ($promoted) use ($goal) {
                        return Carbon::parse($promoted->created_at)->between($goal->start_date, $goal->end_date);
                    });
                });
            })->count();

            return [
                'id' => $goal->id,
                'municipal_name' => $goal->municipal->name,
                'promoted_count' => $promotedCount,
                'goal_name' => $goal->goalName,
                'goal_value' => $goal->goalValue,
            ];
        });

        return response()->json(['goals' => $goals]);
    }




    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $validatedData = $request->validate([
            'goalName' => 'required|max:255',
            'goalValue' => 'required|integer',
            'municipal_id' => 'required|exists:municipals,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Crear un nuevo objetivo con los datos validados
        $goal = Goal::create($validatedData);

        // Conteo manual de promovidos
        $promotedCount = 0;
        foreach ($goal->municipal->districts as $district) {
            foreach ($district->sections as $section) {
                $promotedCount += $section->promoteds->count();
            }
        }

        // Devolver la respuesta JSON con el mensaje, los detalles del objetivo creado y el conteo de promovidos
        return response()->json([
            'message' => 'Goal created successfully',
            'goal' => [
                'id' => $goal->id,
                'municipal_name' => $goal->municipal->name,
                'promoted_count' => $promotedCount,
                'goal_name' => $goal->goalName,
                'goal_value' => $goal->goalValue,
                'start_date' => $goal->start_date,
                'end_date' => $goal->end_date,
            ]
        ], 201);
    }




    public function show(Goal $goal)
    {
        return response()->json($goal);
    }

    public function update(Request $request, Goal $goal)
    {
        $validatedData = $request->validate([
            'goalName' => 'required|max:255',
            'goalValue' => 'required|integer',
            'municipal_id' => 'required|exists:municipals,id'
        ]);

        $goal->update($validatedData);
        return response()->json(['message' => 'Goal updated successfully', 'goal' => $goal]);
    }

    public function destroy(Goal $goal)
    {
        $goal->delete();
        return response()->json(['message' => 'Goal deleted successfully']);
    }
}
