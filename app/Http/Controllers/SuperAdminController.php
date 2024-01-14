<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $superAdmins = SuperAdmin::all();
        return response()->json($superAdmins);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:super_admins',
            'phone_number' => 'required|numeric',
            'profile_img_path' => 'image|nullable|max:1999',
            'password' => 'required'
        ]);

        // Si se sube una imagen, manejar la subida de archivos aquí

        $superAdmin = SuperAdmin::create($validatedData);

        return response()->json(['message' => 'Super Admin creado con éxito.', 'data' => $superAdmin], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SuperAdmin $superAdmin)
    {
        return response()->json($superAdmin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuperAdmin $superAdmin)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:super_admins,email,'.$superAdmin->id,
            'phone_number' => 'required|numeric',
            'profile_img_path' => 'image|nullable|max:1999',
            // No actualizar contraseña si no se proporciona una nueva
        ]);

        // Si se sube una nueva imagen, manejar la subida de archivos aquí

        $superAdmin->update($validatedData);

        return response()->json(['message' => 'Super Admin actualizado con éxito.', 'data' => $superAdmin]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuperAdmin $superAdmin)
    {
        $superAdmin->delete();
        return response()->json(['message' => 'Super Admin eliminado con éxito.']);
    }
}
