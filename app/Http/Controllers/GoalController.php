<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::with('municipal')->get()->map(function ($goal) {
            return [
                'municipal_name' => $goal->municipal->name, // Nombre del municipio
                'goal_name' => $goal->goalName,            // Nombre de la meta
                'goal_value' => $goal->goalValue           // Valor de la meta
            ];
        });

        return response()->json(['goals' => $goals]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'goalName' => 'required|max:255',
            'goalValue' => 'required|integer',
            'municipal_id' => 'required|exists:municipals,id'
        ]);

        $goal = Goal::create($validatedData);
        return response()->json(['message' => 'Goal created successfully', 'goal' => $goal], 201);
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
