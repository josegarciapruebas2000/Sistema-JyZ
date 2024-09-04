<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ModeloFotoGrupo;
use App\Models\Paquete;
use App\Models\Color;
use App\Models\Modelo;

class modelosIndividualesCuadros extends Controller
{
    //-----------------------------------------------------------------

    // PAQUETES DE CUADRO INDIVIDUAL -------------

    public function verIndividual()
    {
        // Filtrar los datps con status 0 o 1
        $color = Color::where('tipo', 'individual')->whereIn('status', [0, 1])->get();
        $modelo = Modelo::where('tipo', 'individual')->whereIn('status', [0, 1])->get();
        $modelosGrupos = ModeloFotoGrupo::where('tipo', 'individual')->whereIn('status', [0, 1])->get();

        return view('Jyz/cuadroIndividual', compact('color', 'modelo', 'modelosGrupos'));
    }





    // COLORES 

    public function agregarColores(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen_color' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Crear una nueva instancia del modelo Color
        $color = new Color();

        // Asignar el nombre del color desde la solicitud al atributo del modelo
        $color->nombre = $request->nombre;

        // Manejar la subida de la imagen
        if ($request->hasFile('imagen_color')) {
            $image = $request->file('imagen_color');
            $imageData = file_get_contents($image->getRealPath());
            $color->imagen = base64_encode($imageData);
        }

        // Guardar el color en la base de datos
        $color->tipo = "Individual";
        $color->save();

        // Configurar el mensaje de éxito en la sesión
        session()->flash('success', '¡Color agregado correctamente!');

        // Redirigir a la vista de paquetes u otra vista deseada
        return redirect('/individual#colores');
    }


    public function eliminarColor($id)
    {
        // Encuentra el color por su ID
        $color = Color::findOrFail($id);

        // Verifica el valor del campo status
        if ($color->status == 0) {
            // Elimina definitivamente el color
            $color->delete();
        } elseif ($color->status == 1) {
            // Actualiza el campo status a 2
            $color->status = 2;
            $color->save();
        }

        // Configura el mensaje de éxito en la sesión
        session()->flash('success', '¡Color eliminado correctamente!');

        // Redirige a la vista de paquetes u otra vista deseada
        return redirect('/individual#colores');
    }


    // MARCOS

    // Agregar modelo (usando POST)
    public function agregarModelos(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombreModelo' => 'required|string|max:255',
            'imagen_modelo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Crear una nueva instancia del modelo Modelo
        $modelo = new Modelo();
        $modelo->nombre = $request->nombreModelo;

        // Manejar la subida de la imagen
        if ($request->hasFile('imagen_modelo')) {
            $image = $request->file('imagen_modelo');
            $imageData = file_get_contents($image->getRealPath());
            $modelo->imagen = base64_encode($imageData);
        }

        // Guardar el modelo en la base de datos
        $modelo->tipo = "Individual";
        $modelo->save();

        // Configurar el mensaje de éxito en la sesión
        session()->flash('success', '¡Modelo agregado correctamente!');

        // Redirigir a la vista de paquetes u otra vista deseada
        return redirect('/individual#modelos-marcos');
    }


    // Eliminar modelo (usando POST)
    public function eliminarModelo($id)
    {
        // Buscar el modelo por su ID
        $modelo = Modelo::findOrFail($id);

        // Verificar el valor del campo status
        if ($modelo->status == 0) {
            // Eliminar definitivamente el modelo
            $modelo->delete();
        } elseif ($modelo->status == 1) {
            // Actualizar el campo status a 2
            $modelo->status = 2;
            $modelo->save();
        }

        // Configura el mensaje de éxito en la sesión
        session()->flash('success', '¡Modelo eliminado correctamente!');

        // Después de eliminar el modelo, redirige a la vista de paquetes
        return redirect('/individual#modelos-marcos');
    }


    // MODELO DE FOTOS DEL CUADRO (Logo, con toga, sin toga, ropa civil)

    public function agregarModelosCuadrosGrupo(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombreModelo' => 'required|string|max:255',
            'imagen_modelo_foto_grupo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Asegúrate de que el nombre del campo coincida con el de tu formulario
        ]);

        // Crear una nueva instancia del modelo
        $modelo = new ModeloFotoGrupo();
        $modelo->nombre = $request->input('nombreModelo'); // Utiliza input() para ser consistente

        // Manejar la subida de la imagen
        if ($request->hasFile('imagen_modelo_foto_grupo')) {
            $image = $request->file('imagen_modelo_foto_grupo');
            $imagePath = $image->getPathName();
            $imageData = file_get_contents($imagePath);
            $base64Image = base64_encode($imageData);
            $modelo->imagen = $base64Image; // Almacena la imagen en base64 en la base de datos
        }

        // Guardar el modelo en la base de datos
        $modelo->tipo = "Individual";
        $modelo->save();

        // Configurar el mensaje de éxito en la sesión
        session()->flash('success', '¡Modelo agregado correctamente!');

        // Redirigir a la vista deseada
        return redirect('/individual#modelos-cuadros-grupo'); // Asegúrate de que la redirección sea hacia una ruta válida
    }

    public function eliminarModeloCuadrosGrupo($id)
    {
        // Buscar el modelo de foto de grupo por su ID
        $modelo = ModeloFotoGrupo::findOrFail($id);

        // Verificar el valor del campo status
        if ($modelo->status == 0) {
            // Eliminar definitivamente el modelo
            $modelo->delete();
        } elseif ($modelo->status == 1) {
            // Actualizar el campo status a 2, considerado como "deshabilitado"
            $modelo->status = 2;
            $modelo->save();
        }

        // Configurar el mensaje de éxito en la sesión
        session()->flash('success', '¡Modelo de foto de grupo eliminado correctamente!');

        // Redirigir a la vista de paquetes o la vista adecuada
        return redirect('/individual#modelos-cuadros-grupo'); // Asegúrate de que la redirección sea hacia una ruta válida
    }
    //-----------------------------------------------------------------
}
