<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'goalName',
        'goalValue',
        'municipal_id',
    ];

    /**
     * Get the municipal that the goal belongs to.
     */
    public function municipal()
    {
        return $this->belongsTo(Municipal::class);
    }
}
