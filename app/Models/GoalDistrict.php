<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalDistrict extends Model
{
    use HasFactory;

    protected $fillable = [
        'goalName',
        'goalValue',
        'district_id',
        'start_date',
        'end_date',
    ];

    /**
     * Get the municipal that the goal belongs to.
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
