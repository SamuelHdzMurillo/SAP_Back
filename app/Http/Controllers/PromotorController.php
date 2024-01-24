<?php

namespace App\Http\Controllers;

use App\Http\Resources\PromotorResource;
use App\Models\Promotor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;

class PromotorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Consulta para obtener todos los promotores junto con las relaciones ansiosamente cargadas
        $promotores = Promotor::with('municipal.districts', 'section.promoteds')->paginate(10);

        if ($promotores->isEmpty()) {
            return response()->json(['message' => 'No se encontraron promotores'], 404);
        }

        return PromotorResource::collection($promotores);
    }
    public function showPromoteds($promotorId)
    {
        try {
            $promotor = Promotor::findOrFail($promotorId);
            $promoteds = $promotor->getPromoteds();

            return response()->json(['promotor' => $promotor, 'promoteds' => $promoteds]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se encontró el promotor'], 404);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:promotors,email',
            'phone_number' => 'required',
            'position' => 'required',
            'password' => 'required|confirmed',
            'profile_path' => 'image|nullable|max:1999', // Asegúrate de que el archivo sea una imagen
            'ine_path' => 'image|nullable|max:1999', // Asegúrate de que el archivo sea una imagen
            'municipal_id' => 'required|exists:municipals,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Verifica si se ha subido una imagen de perfil
        if ($request->hasFile('profile_path')) {
            $profilePath = $request->file('profile_path')->store('images/profiles', 'public');
            $validatedData['profile_path'] = $profilePath;
        }

        // Verifica si se ha subido una imagen de INE
        if ($request->hasFile('ine_path')) {
            $inePath = $request->file('ine_path')->store('images/ines', 'public');
            $validatedData['ine_path'] = $inePath;
        }

        $promotor = Promotor::create($validatedData);
        return response()->json(['message' => 'Promotor creado con éxito.', 'data' => $promotor], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Busca un promotor por su ID junto con todas las relaciones cargadas ansiosamente.
        $promotor = Promotor::with('municipal.districts',  'section.promoteds')->find($id);

        if (!$promotor) {
            return response()->json(['message' => 'Promotor no encontrado'], 404);
        }

        return response()->json($promotor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $promotor = Promotor::find($id);
        if (is_null($promotor)) {
            return response()->json(['message' => 'Promotor no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:promotors,email,' . $id,
            'phone_number' => 'required',
            'position' => 'required',
            'profile_path' => 'required',
            'ine_path' => 'required',
            'municipal_id' => 'required|exists:municipals,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $promotor->update($validator->validated());
        return response()->json($promotor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $promotor = Promotor::find($id);
        if (is_null($promotor)) {
            return response()->json(['message' => 'Promotor no encontrado'], 404);
        }

        $promotor->delete();
        return response()->json([
            "data" => $promotor
        ], 200);
    }
}
