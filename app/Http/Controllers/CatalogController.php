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
        $District = District::all();
        return CatalogResource::collection($District);
    }

    public function SectioSelect()
    {
        $Section = Section::all();
        return CatalogResource::collection($Section);
    }
}
