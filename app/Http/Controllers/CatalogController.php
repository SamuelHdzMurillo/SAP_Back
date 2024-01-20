<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Municipal;
use App\Models\District;
use App\Models\Section;
use App\Http\Resources\CatalogResource;

class CatalogController extends Controller
{
    public function MunicipalSelect()
    {
        $Municipal = Municipal::all();
        return CatalogResource::collection($Municipal);
    }

    public function DistrictSelect()
    {
        $District = District::where("municipal_id", request()->municipal_id)->get();
        return CatalogResource::collection($District);
    }

    public function SectioSelect()
    {
        $Section = Section::where("district_id", request()->district_id)->get();
        return CatalogResource::collection($Section);
    }
}
