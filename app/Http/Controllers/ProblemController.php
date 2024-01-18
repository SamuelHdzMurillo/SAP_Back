<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        // Obtener todos los problemas
        $problems = Problem::all()->paginate(10);

        // Devolver los datos en formato JSON
        return response()->json(['data' => $problems]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'problem_img_path' => 'nullable|string',
            'promoted_id' => 'required|exists:promoteds,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Crear un nuevo problema
        $problem = Problem::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'problem_img_path' => $request->input('problem_img_path'),
            'promoted_id' => $request->input('promoted_id'),
        ]);

        // Devolver los datos del nuevo problema en formato JSON
        return response()->json(['data' => $problem], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Problem  $problem
     * @return JsonResponse
     */
    public function show(Problem $problem)
    {
        $problem->load(['promoted.section.district.municipal']);

        return response()->json(['data' => $problem]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Problem  $problem
     * @return JsonResponse
     */
    public function update(Request $request, Problem $problem)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'problem_img_path' => 'nullable|string',
            'promoted_id' => 'required|exists:promoteds,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Actualizar los datos del problema
        $problem->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'problem_img_path' => $request->input('problem_img_path'),
            'promoted_id' => $request->input('promoted_id'),
        ]);

        // Devolver los datos actualizados en formato JSON
        return response()->json(['data' => $problem]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Problem  $problem
     * @return JsonResponse
     */
    public function destroy(Problem $problem)
    {
        // Eliminar el problema
        $problem->delete();

        // Devolver respuesta exitosa en formato JSON
        return response()->json(['message' => 'Problem deleted successfully']);
    }
}
