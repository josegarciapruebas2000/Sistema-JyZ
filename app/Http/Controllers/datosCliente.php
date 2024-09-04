<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Alumno;

use App\Models\Escuela;

use App\Models\Paquete;

use App\Models\Modelo;
use App\Models\ModeloFotoGrupo;

use App\Models\Color;

class datosCliente extends Controller
{
    public function datos($id)
{
    $escuela = Escuela::find($id); // Obtener la escuela por su ID

    // Asegúrate de que el campo 'tipo' en Escuela tiene el valor correcto
    $tipoEscuela = $escuela->tipo; // Cambia esto si el campo en tu tabla es diferente

    // Filtrar los paquetes según el tipo de escuela
    $paquetes = Paquete::whereIn('status', [0, 1])
        ->where(function ($query) use ($tipoEscuela) {
            if ($tipoEscuela === 'Kinder') {
                $query->where('kinder', true);
            } elseif ($tipoEscuela === 'Primaria') {
                $query->where('primaria', true);
            } elseif ($tipoEscuela === 'Secundaria') {
                $query->where('secundaria', true);
            } elseif ($tipoEscuela === 'Universidad') {
                $query->where('universidad', true);
            }
        })
        ->orderBy('costo_paquete')
        ->get();

    // Obtener otros registros necesarios
    $modelos = Modelo::whereIn('status', [0, 1])->get();
    $modelosFotos = ModeloFotoGrupo::whereIn('status', [0, 1])->get();
    $colores = Color::whereIn('status', [0, 1])->get();
    $costosPaquetes = Paquete::pluck('costo_paquete', 'id')->toArray();


    return view('Cliente/datos', compact('escuela', 'paquetes', 'modelos', 'modelosFotos', 'colores', 'costosPaquetes'));
}

}
