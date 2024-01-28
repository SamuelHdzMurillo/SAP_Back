<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProblemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'key' => $this->id,
            'id' => $this->id,
            'title' => $this->title,
            'problem_img_path' => $this->problem_img_path,
            'description' => $this->description,
            'promoted_id' => $this->promoted_id,
            'promoted' => $this->promoted,
            'promoted_name' => $this->promoted->name,
            'section_number' => $this->promoted->section->number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
