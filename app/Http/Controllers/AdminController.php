<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\AdminResource;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Admin::orderBy("created_at", "desc");

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('phone_number')) {
            $query->where('phone_number', 'like', '%' . $request->input('phone_number') . '%');
        }

        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        $admins = $query->paginate(10);

        return AdminResource::collection($admins);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validatedData = $request->all();
        $validatedData['password'] = bcrypt($validatedData['password']);

        if ($request->hasFile('profile_img_path')) {
            $path = $request->file('profile_img_path')->store('images', 'public');
            $validatedData['profile_img_path'] = $path;
        }

        $admin = Admin::create($validatedData);

        return response()->json(['message' => 'Admin creado con éxito.', 'data' => $admin], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return response()->json($admin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone_number' => 'required|numeric',
        ]);

        if ($request->hasFile('profile_img_path')) {
            $path = $request->file('profile_img_path')->store('images', 'public');
            $validatedData['profile_img_path'] = $path;
        }

        $admin->update($validatedData);

        return response()->json(['message' => 'Admin actualizado con éxito.', 'data' => $admin]);
    }

    public function uploadImage(Request $request, Admin $admin)
    {
        $validatedData = $request->validate([
            'profile_img_path' => 'image|nullable|max:1999',
        ]);

        if ($request->hasFile('profile_img_path')) {
            $path = $request->file('profile_img_path')->store('images', 'public');
            $validatedData['profile_img_path'] = $path;
        }

        $admin->update($validatedData);

        return response()->json(['message' => 'Admin actualizado con éxito.', 'data' => $admin]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->json(['message' => 'Admin eliminado con éxito.', 'data' => $admin]);
    }
}
