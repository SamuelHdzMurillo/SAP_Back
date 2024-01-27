<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SuperAdminAuthController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Intenta autenticar con SuperAdmin
        if (Auth::guard('superadmin')->attempt($request->only('email', 'password'))) {
            $user = Auth::guard('superadmin')->user();
            $token = $user->createToken('SuperAdminToken')->plainTextToken;
            $userData = $user->toArray(); // Obtener todos los datos del usuario

            return response()->json(['token' => $token, 'user_type' => 'superadmin', 'user' => $userData], 200);
        }

        // Intenta autenticar con Promotor
        if (Auth::guard('promotor')->attempt($request->only('email', 'password'))) {
            $user = Auth::guard('promotor')->user();
            $token = $user->createToken('PromotorToken')->plainTextToken;
            $userData = $user->toArray(); // Obtener todos los datos del usuario

            return response()->json(['token' => $token, 'user_type' => 'promotor', 'user' => $userData], 200);
        }

        throw ValidationException::withMessages([
            'email' => ['Las credenciales son incorrectas.'],
        ]);
    }

    public function logout(Request $request)
    {
        // Aquí necesitas lógica para manejar el logout dependiendo del tipo de usuario
        // Por ejemplo, puedes usar un campo en la petición para determinar el tipo de usuario
        $userType = $request->input('user_type', 'superadmin');
        Auth::guard($userType)->logout();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
