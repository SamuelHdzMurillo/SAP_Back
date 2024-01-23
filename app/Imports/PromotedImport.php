<?php

namespace App\Imports;

use App\Models\Promoted;
use App\Models\Section;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PromotedImport implements ToModel, WithHeadingRow
{
    protected string $promotorId;

    public function __construct(string $promotorId)
    {
        $this->promotorId = $promotorId;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $section = Section::where("number", $row["section"])->first();
        return new Promoted([
            'name'           => $row['name'],
            'last_name'      => $row['last_name'],
            'phone_number'   => $row['phone_number'],
            'email'          => $row['email'],
            'adress'         => $row['adress'],
            'electoral_key'  => $row['electoral_key'],
            'curp'           => $row['curp'],
            'latitude'       => $row['latitude'],
            'longitude'      => $row['longitude'],
            "section_id"    => "$section->id",
            'promotor_id'   => "$this->promotorId",
        ]);
    }
}
