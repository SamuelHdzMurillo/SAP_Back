<?php

namespace App\Http\Controllers;

use App\Models\GoalSection;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GoalSectionController extends Controller
{
    public function index(Request $request)
    {
        // Obtener la fecha de la solicitud
        $requestedDate = $request->input('start_date');

        // Filtrar por fecha de inicio y fecha de terminación si se proporcionan en la solicitud
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = GoalSection::with(['section.promoteds' => function ($query) use ($startDate, $endDate, $requestedDate) {
            // Aplicar filtro de fecha en la relación
            if ($startDate && $endDate) {
                $query->whereBetween('date_column', [Carbon::parse($startDate), Carbon::parse($endDate)]);
            } elseif ($requestedDate) {
                $query->whereDate('date_column', '=', Carbon::parse($requestedDate)->format('Y-m-d'));
            }
        }]);

        $goalsSection = $query->get()->map(function ($goalSection) {
            // Conteo manual de promovidos
            $promotedCount = $goalSection->section->promoteds->count();

            return [
                'id' => $goalSection->id,
                'section_name' => $goalSection->section->number,
                'promoted_count' => $promotedCount,
                'goal_name' => $goalSection->goalName,
                'goal_value' => $goalSection->goalValue,
            ];
        });

        return response()->json(['goals' => $goalsSection]);
    }

    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $validatedData = $request->validate([
            'goalName' => 'required|max:255',
            'goalValue' => 'required|integer',
            'section_id' => 'required|exists:sections,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Crear un nuevo objetivo de sección con los datos validados
        $goalSection = GoalSection::create($validatedData);

        // Inicializar el conteo de promovidos en 0
        $promotedCount = 0;

        // Verificar si la relación 'section' existe y no es null
        if ($goalSection->section && $goalSection->section->promoteds) {
            $promotedCount = $goalSection->section->promoteds->count();
        }

        // Devolver la respuesta con el mensaje, los detalles del objetivo de sección creado y el conteo de promovidos
        return response()->json(['message' => 'Goal Section created successfully', 'goal' => [
            'id' => $goalSection->id,
            'section_name' => $goalSection->section->number,
            'promoted_count' => $promotedCount,
            'goal_name' => $goalSection->goalName,
            'goal_value' => $goalSection->goalValue,
        ]], 201);
    }


    public function show(GoalSection $goalSection)
    {
        // Obtener los promovidos filtrados por fecha
        $promoteds = $goalSection->section->promoteds->filter(function ($promoted) use ($goalSection) {
            return Carbon::parse($promoted->date_column)->between($goalSection->start_date, $goalSection->end_date, true);
        });

        // Conteo de promovidos
        $promotedCount = $promoteds->count();

        // Respuesta JSON con información del GoalSection y los promovidos
        return response()->json([
            'id' => $goalSection->id,
            'section_name' => $goalSection->section->name,
            'promoted_count' => $promotedCount,
            'goal_name' => $goalSection->goalName,
            'goal_value' => $goalSection->goalValue,
            'promoteds' => $promoteds,
        ]);
    }

    public function update(Request $request, GoalSection $goalSection)
    {
        $validatedData = $request->validate([
            'goalName' => 'required|max:255',
            'goalValue' => 'required|integer',
            'section_id' => 'required|exists:sections,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $goalSection->update($validatedData);

        // Conteo manual de promovidos
        $promotedCount = $goalSection->section->promoteds->count();

        // Devolver la respuesta con el mensaje, los detalles del objetivo de sección actualizado y el conteo de promovidos
        return response()->json(['message' => 'Goal Section updated successfully', 'goal' => [
            'id' => $goalSection->id,
            'section_name' => $goalSection->section->name,
            'promoted_count' => $promotedCount,
            'goal_name' => $goalSection->goalName,
            'goal_value' => $goalSection->goalValue,
        ]]);
    }

    public function destroy(GoalSection $goalSection)
    {
        $goalSection->delete();
        return response()->json(['message' => 'Goal Section deleted successfully']);
    }
}
