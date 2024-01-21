<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SuperAdmin;
use Illuminate\Validation\ValidationException;

class SuperAdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('superadmin')->attempt($request->only('email', 'password'))) {
            $superAdmin = Auth::guard('superadmin')->user();
            $token = $superAdmin->createToken('SuperAdminToken')->plainTextToken;

            return response()->json(['token' => $token], 200);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('superadmin')->logout();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
