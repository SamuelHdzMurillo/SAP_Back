<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promoted extends Model
{
    use HasFactory;

    // Especificar los campos asignables de manera masiva
    protected $fillable = [
        'name',
        'last_name',
        'phone_number',
        'email',
        'adress',
        'electoral_key',
        'curp',
        'latitude',
        'longitude',
        'section_id',
        'promotor_id'
    ];

    /**
     * Relación con el modelo Section.
     */
    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }

    public function promotor()
    {
        return $this->belongsTo(Promotor::class);
    }

    public function municipal()
    {
        return $this->belongsTo(Municipal::class);
    }

    /**
     * Relación con el modelo Problem.
     */
    public function problems()
    {
        return $this->hasMany(Problem::class);
    }

    // Aquí puedes agregar otras relaciones o lógica de negocio específica de tu modelo
}
