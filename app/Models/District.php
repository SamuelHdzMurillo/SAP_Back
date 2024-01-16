<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla si no sigue la convención de nombres de Laravel
    protected $table = 'districts';

    // Indicar que la tabla no tiene marcas de tiempo si no deseas usar 'created_at' y 'updated_at'
    // public $timestamps = false;

    // Especificar los campos asignables de manera masiva
    protected $fillable = ['number', 'municipal_id'];

    /**
     * Relación con el modelo Municipal.
     */
    public function municipal()
    {
        return $this->belongsTo(Municipal::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    // Aquí puedes agregar otras relaciones o lógica de negocio específica de tu modelo
}
