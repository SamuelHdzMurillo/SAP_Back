<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalSection extends Model
{
    use HasFactory;


    protected $fillable = [
        'goalName',
        'goalValue',
        'section_id',
        'start_date',
        'end_date',
    ];

    /**
     * Get the municipal that the goal belongs to.
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
