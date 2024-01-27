<?php

namespace App\Http\Controllers;

use App\Http\Resources\MapResource;
use App\Models\Promoted;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function getPromoteds()
    {
        $promoteds = Promoted::all();
        return MapResource::collection($promoteds);
    }
}
