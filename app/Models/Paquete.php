<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'costo_paquete', 'imagen',
    ];

    // Define la relación con alumnos
    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'id_paquete');
    }
}
