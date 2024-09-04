<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    // Define la relación con los alumnos
    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }
}
