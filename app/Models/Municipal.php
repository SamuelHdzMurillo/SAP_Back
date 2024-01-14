<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipal extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla si no sigue la convención de nombres de Laravel
    protected $table = 'municipals';

    // Especificar los campos asignables de manera masiva
    protected $fillable = ['name'];

    /**
     * Relación con el modelo District.
     */
    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function promotors()
    {
        return $this->hasMany(Promotor::class);
    }

    public function promoted()
    {
        return $this->hasMany(Promoted::class);
    }


    // Aquí puedes agregar otras relaciones o lógica de negocio específica de tu modelo
}
