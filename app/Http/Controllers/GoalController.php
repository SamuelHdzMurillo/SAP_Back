<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::with(['municipal' => function ($query) {
            $query->with(['districts.sections.promoteds']);
        }])->get()->map(function ($goal) {
            // Conteo manual de promovidos
            $promotedCount = 0;
            foreach ($goal->municipal->districts as $district) {
                foreach ($district->sections as $section) {
                    $promotedCount += $section->promoteds->count();
                }
            }

            return [
                'id' => $goal->id,
                'municipal_name' => $goal->municipal->name,
                'promoted_count' => $promotedCount,  // Nombre del municipio
                'goal_name' => $goal->goalName,            // Nombre de la meta
                'goal_value' => $goal->goalValue,          // Valor de la meta
                // Total de promovidos por municipio ajustado
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
            'municipal_id' => 'required|exists:municipals,id'
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

        // Devolver la respuesta con el mensaje, los detalles del objetivo creado y el conteo de promovidos
        return response()->json(['message' => 'Goal created successfully', 'goal' => [
            'id' => $goal->id,
            'municipal_name' => $goal->municipal->name,
            'promoted_count' => $promotedCount,
            'goal_name' => $goal->goalName,
            'goal_value' => $goal->goalValue,
        ]], 201);
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
