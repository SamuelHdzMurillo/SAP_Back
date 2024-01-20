<?php

namespace App\Imports;

use App\Models\Promoted;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PromotedImport implements ToModel, WithHeadingRow
{
    protected $promotorId;
    protected $sectionId;

    public function __construct($promotorId, $sectionId)
    {
        $this->promotorId = $promotorId;
        $this->sectionId = $sectionId;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Promoted([
            'name'           => $row['name'],
            'second_name'    => $row['second_name'],
            'last_name'      => $row['last_name'],
            'phone_number'   => $row['phone_number'],
            'email'          => $row['email'],
            'section'        => $row['section'],
            'adress'         => $row['adress'],
            'electoral_key'  => $row['electoral_key'],
            'curp'           => $row['curp'],
            'latitude'       => $row['latitude'],
            'longitude'      => $row['longitude'],
            "section_id"    => $this->sectionId,
            'promotor_id'   => $this->promotorId,
        ]);
    }
}
