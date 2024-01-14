<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

    // Especificar los campos asignables de manera masiva
    protected $fillable = ['title', 'description', 'problem_img_path', 'promoted_id'];

    /**
     * Relación con el modelo Promoted.
     */
    public function promoted()
    {
        return $this->belongsTo(Promoted::class);
    }

    // Aquí puedes agregar otras relaciones o lógica de negocio específica de tu modelo
}
