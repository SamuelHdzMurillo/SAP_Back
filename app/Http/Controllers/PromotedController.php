<?php

namespace App\Http\Controllers;

use App\Models\Promoted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromotedController extends Controller
{
    /**
     * Muestra una lista de los registros Promoted.
     */
    public function index()
    {
        $promoteds = Promoted::all();
        return response()->json($promoteds);
    }

    /**
     * Guarda un nuevo registro Promoted.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'second_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|email|unique:promoteds,email',
            'section' => 'nullable|string|max:255',
            'adress' => 'required|string|max:255',
            'electoral_key' => 'required|string|max:255',
'curp' => 'required|string|max:255',
'latitude' => 'required|numeric',
'longitude' => 'required|numeric',
'section_id' => 'required|integer|exists:sections,id' // Asegúrate de que el ID de sección exista
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
        $promoted = Promoted::find($id);
        return response()->json($promoted);
    }

    /**
     * Actualiza un registro Promoted específico.
     */
    public function update(Request $request, $id)
{
    $rules = [
        'name' => 'string|max:255',
        'second_name' => 'nullable|string|max:255',
        'last_name' => 'string|max:255',
        'phone_number' => 'string|max:255',
        'email' => 'email|unique:promoteds,email,' . $id,
        'section' => 'nullable|string|max:255',
        'adress' => 'string|max:255',
        'electoral_key' => 'string|max:255',
        'curp' => 'string|max:255',
        'latitude' => 'numeric',
        'longitude' => 'numeric',
        'section_id' => 'integer|exists:sections,id'
    ];

    $validatedData = $request->validate($rules);

    $promoted = Promoted::find($id);
    if (!$promoted) {
        return response()->json(['message' => 'Promoted not found'], 404);
    }

    $promoted->update($validatedData);
    return response()->json($promoted, 200);
}


    /**
     * Elimina un registro Promoted específico.
     */
    public function destroy($id)
    {
        Promoted::destroy($id);
        return response()->json(null, 204);
    }

    // Aquí puedes agregar otros métodos y lógicas específicas para tu aplicación
}
