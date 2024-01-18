<?php

namespace App\Imports;

use App\Models\Promoted;
use Maatwebsite\Excel\Concerns\ToModel;

class PromotedImport implements ToModel
{
    protected $promotorId;

    public function __construct($promotorId)
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
        return new Promoted([
            'name'           => $row[0],
            'second_name'    => $row[1],
            'last_name'      => $row[2],
            'phone_number'   => $row[3],
            'email'          => $row[4],
            'section'        => $row[5],
            'adress'         => $row[6],
            'electoral_key'  => $row[7],
            'curp'           => $row[8],
            'latitude'       => $row[9],
            'longitude'      => $row[10],
            "section_id"    => $row[11] ,
            'promotor_id'   => $this->promotorId,
        ]);
    }
}
