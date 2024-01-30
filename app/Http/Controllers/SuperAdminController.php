<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\SuperAdminResource;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $query = SuperAdmin::orderBy("created_at", "desc");
        if ($req->has('name')) {
            $query->where('name', 'like', '%' . $req->input('name') . '%');
        }
        if ($req->has('phone_number')) {
            $query->where('phone_number', 'like', '%' . $req->input('phone_number') . '%');
        }
        if ($req->has('email')) {
            $query->where('email', 'like', '%' . $req->input('email') . '%');
        }
        $superAdmins = $query->paginate(10);
        return  SuperAdminResource::collection($superAdmins);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validatedData = $request->all();
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Verifica si se ha subido una imagen
        if ($request->hasFile('profile_img_path')) {
            // Almacena la imagen en el disco 'public' en la carpeta 'images' y obtén su ruta
            $path = $request->file('profile_img_path')->store('images', 'public');

            // Agrega la ruta de la imagen a los datos validados
            $validatedData['profile_img_path'] = $path;
        }

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
            'email' => 'required|email|unique:super_admins,email,' . $superAdmin->id,
            'phone_number' => 'required|numeric',
            // No actualizar contraseña si no se proporciona una nueva
        ]);

        // Si se sube una nueva imagen, manejar la subida de archivos aquí

        $superAdmin->update($validatedData);

        return response()->json(['message' => 'Super Admin actualizado con éxito.', 'data' => $superAdmin]);
    }

    public function uploadImage(Request $request, SuperAdmin $superAdmin)
    {
        $validatedData = $request->validate([
            'profile_img_path' => 'image|nullable|max:1999',
        ]);
        if ($request->hasFile('profile_img_path')) {
            // Almacena la imagen en el disco 'public' en la carpeta 'images' y obtén su ruta
            $path = $request->file('profile_img_path')->store('images', 'public');

            // Agrega la ruta de la imagen a los datos validados
            $validatedData['profile_img_path'] = $path;
        }


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
        return response()->json(['message' => 'Super Admin eliminado con éxito.', 'data' => $superAdmin]);
    }
}
