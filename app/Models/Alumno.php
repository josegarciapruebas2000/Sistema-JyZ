<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    // Define la relación inversa con paquetes
    public function paquete()
    {
        return $this->belongsTo(Paquete::class, 'id_paquete');
    }

    // Relación con la escuela
    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }

    // Relación con pagos
    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
    
}
