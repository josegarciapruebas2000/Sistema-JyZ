<?php

namespace App\Http\Controllers;

use App\Models\Alumno;

use App\Models\Escuela;

use App\Models\Paquete;

use App\Models\Modelo;

use App\Models\ModeloFotoGrupo;

use App\Models\Color;

use App\Models\Pago;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class EscuelaController extends Controller
{
    // Método para mostrar el formulario
    public function create()
    {
        return view('jyz/agregar-escuela');
    }

    public function verAlumnos($id)
    {
        // Obtener el alumno
        $alumno = Alumno::select('id', 'nombre_alumno', 'tutor', 'id_escuela', 'id_paquete', 'id_modelo', 'id_color')->find($id);

        // Verificar si se encontró el alumno
        if (!$alumno) {
            // Manejar el caso en que no se encuentra ningún alumno con el ID proporcionado
            abort(404); // Otra opción podría ser redirigir a otra página o mostrar un mensaje de error
        }

        // Obtener la escuela del alumno
        $escuela = Escuela::select('nombre', 'inicio_generacion', 'fin_generacion')->find($alumno->id_escuela);

        // Obtener el paquete del alumno
        $paqueteAlumno = Paquete::find($alumno->id_paquete);

        // Obtener todos los paquetes
        $paquetes = Paquete::all();

        // Obtener los costos de los paquetes
        $costosPaquetes = Paquete::pluck('costo_paquete', 'id')->toArray();

        // Obtener los modelos
        $modelos = Modelo::select('id', 'nombre')->get();

        // Obtener el modelo del alumno
        $modeloAlumno = Modelo::find($alumno->id_modelo);

        // Obtener todos los colores
        $colores = Color::select('id', 'nombre')->get();

        // Obtener el color del alumno
        $colorAlumno = Color::find($alumno->id_color);

        $pagos = Pago::where('id_alumno', $id)->orderBy('id', 'desc')->get();



        //Obtener el valor de la suma de anticipos
        $sumaAnticipos = Pago::where('id_alumno', $id)->sum('anticipo');


        // Pasar los datos del alumno, la escuela, el paquete del alumno, los paquetes, los costos de los paquetes, los modelos y el modelo del alumno a la vista
        return view('Jyz/listaAlumno', compact('alumno', 'escuela', 'paqueteAlumno', 'paquetes', 'costosPaquetes', 'modelos', 'modeloAlumno', 'colores', 'colorAlumno', 'pagos', 'sumaAnticipos'));
    }

    public function actualizarPaquetesAlumno(Request $request, $id)
    {
        // Buscar al alumno por su ID
        $alumno = Alumno::find($id);

        // Verificar si se encontró el alumno
        if (!$alumno) {
            abort(404); // Si no se encuentra el alumno, aborta con un error 404
        }

        // Actualizar los campos del alumno con los datos del formulario
        $alumno->id_paquete = $request->input('paquete');
        $alumno->id_modelo = $request->input('modelo');
        $alumno->id_color = $request->input('color');
        $alumno->pago_pendiente = $request->input('costo_paquete');

        // Guardar los cambios en la base de datos
        $alumno->save();

        session()->flash('success', '¡Paquete actualizado correctamente!');

        // Redirigir de vuelta a la misma página
        return redirect('/lista/alumno/' . $id);
    }

    public function addPago(Request $request, $id)
    {
        // Obtener el alumno
        $alumno = Alumno::find($id);
        $sumaAnticipos = Pago::where('id_alumno', $id)->sum('anticipo');

        // AQUI SE HARAN LA SUMA TOTAL CON MATERIALES EXTRAS Y TODO
        $total_paquete = $request->total;

        // Validar manualmente que el anticipo no sea mayor que el pago pendiente
        $anticipo = $request->anticipo;
        if ($anticipo > ($total_paquete - $sumaAnticipos)) {
            return redirect()->back()->withErrors(['anticipo' => 'El anticipo no puede ser mayor que el pago pendiente.'])->withInput();
        }

        // Validar si falta el anticipo, el método de pago o ambos
        $errors = [];
        if (empty($request->anticipo)) {
            $errors['anticipo'] = 'Falta el anticipo.';
        }
        if (empty($request->metodo_pago)) {
            $errors['metodo_pago'] = 'Falta el método de pago.';
        }

        // Si hay errores, redirigir de vuelta con los mensajes de error
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Crear una nueva instancia del modelo Pago
        $pago = new Pago();

        // Asignar los valores del formulario a los atributos del modelo
        $pago->fecha_pago = now()->toDateString();
        $pago->metodo = $request->metodo_pago;
        $pago->anticipo = $anticipo;
        $pago->pendiente = ($total_paquete - $anticipo) - $sumaAnticipos;
        $pago->id_alumno = $id; // Asignar el ID del alumno

        // Guardar el pago en la base de datos
        $pago->save();

        // Actualizar el pago pendiente del alumno
        $alumno->pago_pendiente = ($total_paquete - $anticipo) - $sumaAnticipos;
        $alumno->save();

        // Configurar el mensaje de éxito en la sesión
        session()->flash('success', '¡Pago registrado correctamente!');

        // Después de agregar el pago, redirigir a la vista de lista de alumnos
        return redirect('/lista/alumno/' . $id);
    }


    public function verPaquetes()
    {
        // Filtrar los paquetes con status 0 o 1
        $paquete = Paquete::whereIn('status', [0, 1])->orderBy('costo_paquete')->get();



        return view('Jyz/paquetes', compact('paquete'));
    }


    public function agregarPaquetes(Request $request)
    {

        // Validar los datos del formulario
        $request->validate([
            'costo_paquete' => 'required|numeric',
            'nombre' => 'required|string|max:255',
            'imagen_paquete' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kinder' => 'nullable|in:on',
            'primaria' => 'nullable|in:on',
            'secundaria' => 'nullable|in:on',
            'preparatoria' => 'nullable|in:on',
            'universidad' => 'nullable|in:on',
        ]);



        // Crear una nueva instancia del modelo Paquete
        $paquete = new Paquete();

        // Asignar los valores del formulario a los atributos del modelo
        $paquete->nombre = $request->nombre;
        $paquete->costo_paquete = $request->costo_paquete;

        // Asignar valores de los interruptores (booleanos)
        $paquete->kinder = $request->has('kinder');
        $paquete->primaria = $request->has('primaria');
        $paquete->secundaria = $request->has('secundaria');
        $paquete->preparatoria = $request->has('preparatoria');
        $paquete->universidad = $request->has('universidad');

        // Manejar la subida de la imagen
        if ($request->hasFile('imagen_paquete')) {
            $image = $request->file('imagen_paquete');
            $imageData = file_get_contents($image->getRealPath());
            $paquete->imagen = base64_encode($imageData);
        }

        // Guardar el paquete en la base de datos
        $paquete->save();

        // Configura el mensaje de éxito en la sesión
        session()->flash('success', '¡Paquete agregado correctamente!');

        // Después de actualizar los costos de los paquetes, redirige a la vista de paquetes
        return redirect('/paquetes#paquetes');
    }



    public function actualizarPaquetes(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'paquete_') === 0) {
                $paqueteId = substr($key, strlen('paquete_'));

                // Buscamos el paquete por su ID
                $paquete = Paquete::find($paqueteId);
                if ($paquete) {
                    // Actualizamos los campos con los valores del formulario
                    $paquete->costo_paquete = $value;
                    $paquete->incluye_individual = $request->input('incluye_individual_' . $paqueteId) ? 1 : 0;
                    $paquete->costo_individual_extra = $request->input('costo_individual_extra_' . $paqueteId);
                    $paquete->incluye_poster = $request->input('incluye_poster_' . $paqueteId) ? 1 : 0;
                    $paquete->costo_poster_extra = $request->input('costo_poster_extra_' . $paqueteId);
                    $paquete->incluye_sueltas = $request->input('incluye_sueltas_' . $paqueteId) ? 1 : 0;
                    $paquete->costo_sueltas_extra = $request->input('costo_sueltas_extra_' . $paqueteId);
                    $paquete->incluye_cartera = $request->input('incluye_cartera_' . $paqueteId) ? 1 : 0;
                    $paquete->costo_cartera_extra = $request->input('costo_cartera_extra_' . $paqueteId);

                    // Manejar la subida de la imagen
                    if ($request->hasFile('imagen_paquete_' . $paqueteId)) {
                        $image = $request->file('imagen_paquete_' . $paqueteId);
                        $imageData = file_get_contents($image->getRealPath());
                        $paquete->imagen = base64_encode($imageData);
                    }

                    // Actualizar niveles educativos
                    $paquete->kinder = $request->input('kinder_' . $paqueteId) ? 1 : 0;
                    $paquete->primaria = $request->input('primaria_' . $paqueteId) ? 1 : 0;
                    $paquete->secundaria = $request->input('secundaria_' . $paqueteId) ? 1 : 0;
                    $paquete->preparatoria = $request->input('preparatoria_' . $paqueteId) ? 1 : 0;
                    $paquete->universidad = $request->input('universidad_' . $paqueteId) ? 1 : 0;

                    // Guardamos los cambios en la base de datos
                    $paquete->save();
                }
            }
        }

        // Configuramos el mensaje de éxito en la sesión
        session()->flash('success', '¡Los paquetes se actualizaron correctamente!');

        // Redirigimos a la vista de paquetes
        return redirect('/paquetes#paquetes');
    }







    public function eliminarPaquete($id)
    {
        // Buscar el paquete por su ID
        $paquete = Paquete::find($id);

        // Verificar si el paquete existe
        if ($paquete) {
            // Verificar el valor del campo 'status'
            if ($paquete->status == 0) {
                // Eliminar el paquete definitivamente
                $paquete->delete();
                // Configurar el mensaje de éxito en la sesión
                session()->flash('success', '¡Paquete eliminado correctamente!');
            } elseif ($paquete->status == 1) {
                // Actualizar el campo 'status' a 2
                $paquete->status = 2;
                $paquete->save();
                // Configurar el mensaje de éxito en la sesión
                session()->flash('success', '¡Paquete actualizado correctamente!');
            }
        } else {
            // Configurar el mensaje de error en la sesión si el paquete no existe
            session()->flash('error', '¡No se encontró el paquete!');
        }

        // Redirigir de vuelta a la vista de paquetes
        return redirect('/paquetes#paquetes');
    }










    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_escuela' => 'required',
            'tipo_escuela' => 'required',
            'clave' => 'required',
            'municipio' => 'required',
            'direccion' => 'required',
            'inicio_generacion' => 'required',
            'fin_generacion' => 'required',
            'fecha_sesion' => 'required|date', // Agregar validación para la fecha de sesión
            'turno' => 'required', // Agregar validación para el turno
        ]);

        // Crear una nueva instancia del modelo Escuela
        $escuela = new \App\Models\Escuela();

        // Asignar los valores del formulario a los atributos del modelo
        $escuela->nombre = $request->nombre_escuela;
        $escuela->tipo = $request->tipo_escuela;
        $escuela->clave = $request->clave;
        $escuela->municipio = $request->municipio;
        $escuela->direccion = $request->direccion;
        $escuela->inicio_generacion = $request->inicio_generacion;
        $escuela->fin_generacion = $request->fin_generacion;
        $escuela->fecha_sesion = $request->fecha_sesion; // Asignar la fecha de sesión
        $escuela->ubicacion_sesion = $request->ubicacion_sesion;
        $escuela->fecha_entrega = $request->fecha_entrega; // Asignar la fecha de entrega
        $escuela->ubicacion_entrega = $request->ubicacion_entrega;
        $escuela->turno = $request->turno; // Asignar el turno

        // Guardar la escuela en la base de datos
        $escuela->save();

        // Redirigir a la página de escuelas con un mensaje de éxito
        //return redirect('/escuelas/' . $request->tipo_escuela . '/gen/' . date('Y'))->with('success', '¡Escuela agregada correctamente!');
        // Redirigir a la página de escuelas con un mensaje de éxito
        return redirect('/escuelas')->with('success', '¡Escuela agregada correctamente!');
    }



    public function indexPendiendte()
    {
        $escuelas = Escuela::orderBy('created_at', 'desc')->paginate(5); // Ordenar por la más reciente y paginar de 10 en 10
        $tipo = "LISTA DE ESCUELAS"; // Definir el tipo para mostrar en el H1

        return view('Jyz/escuelas', compact('escuelas', 'tipo'));
    }

    public function index(Request $request)
    {
        $currentYear = date('Y');
        $tipo = "LISTA DE ESCUELAS";

        $query = Escuela::query();

        if ($request->has('buscar')) {
            $query->where('nombre', 'like', '%' . $request->input('buscar') . '%')
                ->orWhere('municipio', 'like', '%' . $request->input('buscar') . '%');
        }

        if ($request->has('fin_generacion')) {
            $query->where('fin_generacion', $request->input('fin_generacion'));
        } else {
            $query->where('fin_generacion', $currentYear);
        }

        if ($request->has('tipo_escuela') && $request->input('tipo_escuela') != '') {
            $query->where('tipo', $request->input('tipo_escuela'));
        }

        if ($request->has('fecha_sesion')) {
            $query->whereDate('fecha_sesion', $request->input('fecha_sesion'));
        }

        if ($request->has('fecha_entrega')) {
            $query->whereDate('fecha_entrega', $request->input('fecha_entrega'));
        }

        $escuelas = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('Jyz.escuelas', compact('escuelas', 'tipo', 'currentYear'));
    }




    public function tipo($tipo)
    {
        // Convertir el tipo a mayúsculas
        $tipo = strtoupper($tipo);

        // Obtener todas las escuelas del tipo especificado
        $escuelas = Escuela::where('tipo', $tipo)->get();

        // Pasar las escuelas encontradas y el tipo a la vista
        return view('Jyz/escuelas', compact('escuelas', 'tipo'));
    }


    public function generacion(Request $request, $tipo, $gen)
    {
        // Obtener el tipo de escuela y la generación de la URL
        $tipo = strtoupper($tipo);
        $gen = intval($gen); // Convertir a entero para asegurar que sea un año válido

        // Inicializar la consulta para buscar escuelas por generación
        $query = Escuela::where('fin_generacion', $gen);

        // Si se proporciona un tipo de escuela, agregar filtro por tipo
        if ($tipo) {
            $query->where('tipo', $tipo);
        }

        // Obtener todas las escuelas que coinciden con los filtros
        $escuelas = $query->get();

        // Pasar las escuelas encontradas y otros datos relevantes a la vista
        return view('Jyz/escuelas', compact('escuelas', 'tipo', 'gen'));
    }

    public function buscarPorNombre(Request $request, $tipo, $nombre)
    {
        // Inicializar la consulta para buscar escuelas por nombre
        $query = Escuela::where('nombre', 'like', '%' . $nombre . '%');

        // Si se proporciona un tipo de escuela, agregar filtro por tipo
        if ($tipo) {
            $query->where('tipo', $tipo);
        }

        // Obtener todas las escuelas que coinciden con los filtros
        $escuelas = $query->get();

        // Pasar las escuelas encontradas y otros datos relevantes a la vista
        return view('Jyz/escuelas', compact('escuelas', 'tipo', 'nombre'));
    }

    public function genYNombre(Request $request, $tipo, $gen, $nombre)
    {
        // Obtener el tipo de escuela y la generación de la URL
        $tipo = strtoupper($tipo);
        $gen = intval($gen); // Convertir a entero para asegurar que sea un año válido

        // Inicializar la consulta para buscar escuelas por generación
        $query = Escuela::where('fin_generacion', $gen);

        // Si se proporciona un tipo de escuela, agregar filtro por tipo
        if ($tipo) {
            $query->where('tipo', $tipo);
        }

        // Si se proporciona un nombre, agregar filtro por nombre
        if ($nombre) {
            $query->where('nombre', 'like', '%' . $nombre . '%');
        }

        // Obtener todas las escuelas que coinciden con los filtros
        $escuelas = $query->get();

        // Pasar las escuelas encontradas y otros datos relevantes a la vista
        return view('Jyz/escuelas', compact('escuelas', 'tipo', 'gen', 'nombre'));
    }



    public function detalles($id)
    {
        $detalle = Escuela::find($id); // Obtener la escuela por su ID

        return view('Jyz/detalle', compact('detalle'));
    }



    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'nombre_escuela' => 'required|string',
            'tipo_escuela' => 'required',
            'clave' => 'required',
            'municipio' => 'required',
            'direccion' => 'required',
            'inicio_generacion' => 'required',
            'fin_generacion' => 'required',
            'fecha_sesion' => 'required|date',
            'turno' => 'required', // Agregar validación para el turno
        ]);

        // Buscar la escuela por su ID
        $escuela = Escuela::findOrFail($id);

        // Obtener el tipo de la escuela antes de actualizarla
        $tipo_escuela = $escuela->tipo;

        // Actualizar los datos de la escuela con los valores del formulario
        $escuela->nombre = $request->input('nombre_escuela');
        $escuela->tipo = $request->input('tipo_escuela');
        $escuela->clave = $request->input('clave');
        $escuela->municipio = $request->input('municipio');
        $escuela->direccion = $request->input('direccion');
        $escuela->inicio_generacion = $request->input('inicio_generacion');
        $escuela->fin_generacion = $request->input('fin_generacion');
        $escuela->fecha_sesion = $request->input('fecha_sesion'); // Asignar el valor de fecha_sesion
        $escuela->ubicacion_sesion = $request->input('ubicacion_sesion');
        $escuela->fecha_entrega = $request->input('fecha_entrega'); // Asignar el valor de fecha_entrega
        $escuela->ubicacion_entrega = $request->input('ubicacion_entrega');
        $escuela->turno = $request->input('turno'); // Asignar el turno

        // Guardar los cambios en la base de datos
        $escuela->save();

        // Redirigir a la página de detalle de la escuela con el tipo específico
        return redirect('/escuelas')->with('success', '¡Detalles de la escuela actualizados exitosamente!');
    }








    public function addAlumno(Request $request, $id)
    {
        // Obtener la escuela por su ID
        $escuela = Escuela::findOrFail($id);

        // Crear una nueva instancia del modelo Alumno
        $alumno = new \App\Models\Alumno();

        // Asignar los valores del formulario a los atributos del modelo Alumno
        $alumno->tutor = $request->input('tutor');
        $alumno->direccion = $request->input('direccion');
        $alumno->telefono = $request->input('telefono');
        $alumno->municipio = $request->input('municipio');
        $alumno->nombre_alumno = $request->input('nombre_alumno');
        $alumno->grado = $request->input('grado');
        $alumno->grupo = $request->input('grupo');
        $alumno->pago_pendiente = $request->input('costo_paquete');

        // Obtener el id del paquete seleccionado y asignarlo al alumno
        $id_paquete = $request->input('paquete');
        $paquete = Paquete::findOrFail($id_paquete);
        $alumno->id_paquete = $paquete->id;

        // Actualizar el campo 'status' del paquete a 1
        $paquete->status = 1;
        $paquete->save();

        // Obtener el id del modelo seleccionado y asignarlo al alumno
        $id_modelo = $request->input('modelo');
        $modelo = Modelo::findOrFail($id_modelo);
        $alumno->id_modelo = $modelo->id;

        // Actualizar el campo 'status' del modelo a 1
        $modelo->status = 1;
        $modelo->save();

        // Obtener el id del color seleccionado y asignarlo al alumno
        $id_color = $request->input('color');
        $color = Color::findOrFail($id_color);
        $alumno->id_color = $color->id;

        // Actualizar el campo 'status' del color a 1
        $color->status = 1;
        $color->save();

        // Asignar el id de la escuela al alumno
        $alumno->id_escuela = $escuela->id;

        // Guardar el alumno en la base de datos
        $alumno->save();

        return redirect('/contrato/' . $alumno->id);
    }




    public function contratoAlumno($id)
    {
        // Obtener el alumno por su ID
        $alumno = Alumno::find($id);

        // Verificar si se encontró el alumno
        if (!$alumno) {
            abort(404, 'Alumno no encontrado');
        }

        // Obtener el paquete del alumno
        $paquete = Paquete::find($alumno->id_paquete);

        // Verificar si se encontró el paquete
        if (!$paquete) {
            abort(404, 'Paquete no encontrado');
        }

        // Obtener la información de la escuela
        $escuela = DB::table('alumnos')
            ->join('escuelas', 'alumnos.id_escuela', '=', 'escuelas.id')
            ->select('escuelas.*')
            ->where('alumnos.id', $id)
            ->first();

        // Devolver la vista con la información del alumno, la escuela y el paquete
        return view('Cliente/documento', compact('alumno', 'escuela', 'paquete'));
    }


    public function firmar($id)
    {
        $alumno = Alumno::find($id);

        return view('Cliente/firma', compact('alumno'));
    }


    public function pagoContrato($id)
    {
        // Obtener el alumno por su ID
        $alumno = Alumno::find($id);

        // Verificar si se encontró el alumno
        if (!$alumno) {
            abort(404, 'Alumno no encontrado');
        }

        // Obtener el costo del paquete del alumno
        $paquete = Paquete::find($alumno->id_paquete);

        // Realizar la consulta para obtener la información de la escuela
        $escuela = DB::table('alumnos')
            ->join('escuelas', 'alumnos.id_escuela', '=', 'escuelas.id')
            ->select('escuelas.*')
            ->where('alumnos.id', $id)
            ->first();

        // Devolver la vista con la información del alumno, la escuela y el costo del paquete
        return view('Cliente/realizarPago', compact('alumno', 'escuela', 'paquete'));
    }

    public function guardarFirmaEnServidor(Request $request, $id)
    {
        if ($request->hasFile("imagen")) {
            $imagen = $request->file("imagen");
            $nombreImagen = Str::slug("firma-$id") . "." . $imagen->guessExtension();
            $ruta = public_path("img/firmas/");
            $imagen->move($ruta, $nombreImagen);
            //$alumno->imagen = $nombreImagen;
            return redirect()->route('pago.confirmado', ['id' => $id]);
        }
    }

    public function pagoConfirmado($id)
    {
        // Obtener el alumno por su ID
        $alumno = Alumno::find($id);

        // Verificar si se encontró el alumno
        if (!$alumno) {
            abort(404, 'Alumno no encontrado');
        }

        // Obtener el costo del paquete del alumno
        $paquete = Paquete::find($alumno->id_paquete);

        // Realizar la consulta para obtener la información de la escuela
        $escuela = DB::table('alumnos')
            ->join('escuelas', 'alumnos.id_escuela', '=', 'escuelas.id')
            ->select('escuelas.*')
            ->where('alumnos.id', $id)
            ->first();

        // Devolver la vista con la información del alumno, la escuela y el costo del paquete
        return view('Cliente/Pago', compact('alumno', 'escuela', 'paquete'));
    }
}
