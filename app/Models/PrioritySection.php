<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrioritySection extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'data',
    ];


    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function promoteds()
    {
        return $this->hasMany(Promoted::class);
    }
}
