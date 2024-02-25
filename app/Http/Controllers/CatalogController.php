<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Municipal;
use App\Models\District;
use App\Models\Section;
use App\Http\Resources\CatalogResource;
use App\Models\Promoted;
use App\Models\Promotor;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function MunicipalSelect()
    {
        $Municipal = Municipal::all();
        return CatalogResource::collection($Municipal);
    }

    public function getDistrictsByMunicipal($municipalId)
    {
        // Busca el municipio por ID con sus distritos relacionados
        $districts = District::select("id as value", "number as label")->where('municipal_id', $municipalId)->get();

        // Devuelve los distritos del municipio en formato JSON
        return CatalogResource::collection($districts);
        // return response()->json($districts);
    }

    public function getSectionsByDistrict($districtId)
    {
        // Busca el distrito por ID con sus secciones relacionadas
        $districts = Section::select("id as value", "number as label")->where('district_id', $districtId)->get();

        // Devuelve las secciones del distrito en formato JSON
        return CatalogResource::collection($districts);
    }

    public function getUsers()
    {
        $users = Promoted::select("id as value", DB::raw("CONCAT(name, ' ', last_name) as label"))->get();
        return CatalogResource::collection($users);
    }

    public function getPromotors()
    {
        $users = Promotor::select("id as value", DB::raw("CONCAT(name, ' ', position) as label"))->get();
        return CatalogResource::collection($users);
    }
}
