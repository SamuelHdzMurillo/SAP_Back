<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProblemResource;
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
    public function index(Request $req)
    {
        // Obtener todos los problemas
        $query = Problem::with("promoted.section");
        if ($req->has('title')) {
            $query->where('title', 'like', '%' . $req->input('title') . '%');
        }

        if ($req->has('section_number')) {
            $query->whereHas('promoted', function ($query) use ($req) {
                $query->whereHas('section', function ($query) use ($req) {
                    $query->where('number', 'like', '%' . $req->input('section_number') . '%');
                });
            });
        }
        if ($req->has('promoted_name')) {
            $nameParts = explode(' ', $req->input('promoted_name'));
            $query->whereHas('promoted', function ($query) use ($nameParts) {
                foreach ($nameParts as $namePart) {
                    $query->where(function ($query) use ($namePart) {
                        $query->where('name', 'like', '%' . $namePart . '%')
                            ->orWhere('last_name', 'like', '%' . $namePart . '%');
                    });
                }
            });
        }
        $problems = $query->paginate(10);;
        // Devolver los datos en formato JSON
        return ProblemResource::collection($problems);
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
            'problem_img_path' => 'nullable',
            'promoted_id' => 'required|exists:promoteds,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if ($request->hasFile('problem_img_path')) {
            $problem_img_path = $request->file('problem_img_path')->store('images/problems', 'public');
            $validatedData['problem_img_path'] = $problem_img_path;
        }
        // Crear un nuevo problema
        $problem = Problem::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'problem_img_path' => $validatedData['problem_img_path'],
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
    public function destroy(string $id)
    {
        // Eliminar el problema
        $problem = Problem::find($id);
        if (is_null($problem)) {
            return response()->json(['message' => 'Problema no encontrado'], 404);
        }
        $problem->delete();

        // Devolver respuesta exitosa en formato JSON
        return response()->json([
            "data" => $problem
        ], 200);
    }
}
