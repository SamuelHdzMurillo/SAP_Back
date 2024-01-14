<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'district_id',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function promoted()
    {
        return $this->hasMany(Promoted::class);
    }

    // Aquí puedes añadir otras relaciones o métodos personalizados si es necesario.
}
