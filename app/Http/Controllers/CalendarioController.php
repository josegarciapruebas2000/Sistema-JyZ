<?php

namespace App\Http\Controllers;

use App\Models\Escuela;

use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function getDatesForCalendar()
    {
        $escuelas = Escuela::select('fecha_sesion', 'fecha_entrega')->get();
        $eventos = [];

        foreach ($escuelas as $escuela) {
            $eventos[] = [
                'title' => 'Sesión',
                'start' => $escuela->fecha_sesion,
                'backgroundColor' => 'yellow', // Amarillo para las sesiones
                'textColor' => 'black',
                'extendedProps' => [
                    'tipo' => 'Sesión',
                    'nombre' => $escuela->nombre
                ]
            ];
            $eventos[] = [
                'title' => 'Entrega',
                'start' => $escuela->fecha_entrega,
                'backgroundColor' => 'green', // Verde para las entregas
                'textColor' => 'white',
                'extendedProps' => [
                    'tipo' => 'Entrega',
                    'nombre' => $escuela->nombre
                ]
            ];
        }

        return response()->json($eventos);
    }
}
