<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromotedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'key' => $this->id,
            'id' => $this->id,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'section' => $this->section,
            'adress' => $this->adress,
            'electoral_key' => $this->electoral_key,
            'curp' => $this->curp,
            'latitude' => $this->latitude,
            'problems' => $this->problems,
            'longitude' => $this->longitude,
            'section_id' => $this->section_id,
            'district_id' => $this->section->district_id,
            'municipal_id' => $this->section->district->municipal_id,
            'promotor_id' => $this->promotor_id,
        ];
    }
}
