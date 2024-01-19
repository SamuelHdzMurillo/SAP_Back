<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Buscar el distrito por ID
        $district = District::with(['municipal', 'sections.promoteds'])->find($id);

        // Si no se encuentra el distrito, devuelve un error 404
        if (!$district) {
            return response()->json(['message' => 'Distrito no encontrado.'], 404);
        }

        // Devuelve el distrito y sus relaciones en formato JSON
        return response()->json($district);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, District $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        //
    }
}
