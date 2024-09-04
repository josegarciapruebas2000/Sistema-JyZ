<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginJyZ;
use App\Http\Controllers\EscuelaController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\PaquetesController;
use App\Http\Controllers\datosCliente;
use App\Http\Controllers\modelosGrupalesCuadros;
use App\Http\Controllers\modelosIndividualesCuadros;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\usuariosController;



use App\Http\Controllers\Login;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/jyz-login', function () {
    return view('login-jyz');
})->name('login-jyz');

// Ruta para iniciar sesión como rol jyz
Route::post('/login', [LoginJyZ::class, 'login'])->name('login');


Route::get('/dashboard-JYZ', function () {
    return view('principal');
})->name('principal');

//-------------Escuelas-----------------
// Ruta para ver vista de agregar escuela
Route::get('/agregar-escuela', [EscuelaController::class, 'create'])->middleware('role:jyz');

// Ruta para guardar los datos de una escuela
Route::post('/agregar-escuela', [EscuelaController::class, 'store'])->middleware('role:jyz');

// Ruta para mostrar la lista de escuelas
Route::get('/escuelas', [EscuelaController::class, 'index'])->name('escuelas')->middleware('role:jyz');

// Ruta para ver fechas en el calendario de la lista de escuelas
Route::get('/calendario', [CalendarioController::class, 'getDatesForCalendar'])->middleware('role:jyz');

// Ruta para ver los detalles de una escuela
Route::get('/detalles/{id}', [EscuelaController::class, 'detalles'])->middleware('role:jyz');

//Ruta para actualizar los detalles de una escuela
Route::post('/actualizar/{id}', [EscuelaController::class, 'actualizar'])->name('escuela.actualizar')->middleware('role:jyz');



//------------Paquetes-----------------

// PAQUETES  PRECIOS
// Vista paquetes
Route::get('/paquetes', [EscuelaController::class, 'verPaquetes'])->name('paquetes')->middleware('role:jyz');

// Agregar paquetes (usando POST)
Route::post('/paquetes/agregar-paquetes', [EscuelaController::class, 'agregarPaquetes'])->name('agregarPaquetes')->middleware('role:jyz');

// Actualizar paquetes (usando POST)
Route::post('/paquetes/actualizar', [EscuelaController::class, 'actualizarPaquetes'])->name('actualizarPaquetes')->middleware('role:jyz');

// Eliminar paquete (usando POST)
Route::post('/paquetes/eliminar/{id}', [EscuelaController::class, 'eliminarPaquete'])->name('eliminarPaquete')->middleware('role:jyz');




// CUADRO GRUPAL -------

// Vista de cuadro de grupo
Route::get('/grupal', [modelosGrupalesCuadros::class, 'verGrupal'])->name('C_grupal')->middleware('role:jyz');

// PAQUETES  COLORES
// Agregar colores (usando POST)
Route::post('/paquetes/agregar-colores', [modelosGrupalesCuadros::class, 'agregarColores'])->name('agregarColores')->middleware('role:jyz');

// Eliminar paquete (usando POST)
Route::post('/paquetes/eliminar-color/{id}', [modelosGrupalesCuadros::class, 'eliminarColor'])->name('eliminarColor')->middleware('role:jyz');


// PAQUETES  MODELOS MARCOS
// Agregar modelo (usando POST)
Route::post('/paquetes/agregar-modelos', [modelosGrupalesCuadros::class, 'agregarModelos'])->name('agregarModelos')->middleware('role:jyz');

// Eliminar modelo (usando POST)
Route::post('/paquetes/eliminar-modelo/{id}', [modelosGrupalesCuadros::class, 'eliminarModelo'])->name('eliminarModelo')->middleware('role:jyz');


// PAQUETES MODELOS DE FOTOS DE CUADRO DE GRUPO
// Agregar modelo (usando POST)
Route::post('/paquetes/agregar-modelos-cuadros-grupo', [modelosGrupalesCuadros::class, 'agregarModelosCuadrosGrupo'])->name('agregarModelosCuadrosGrupo')->middleware('role:jyz');

// Eliminar modelo (usando POST)
Route::post('/paquetes/eliminar-modelo-cuadros-grupo/{id}', [modelosGrupalesCuadros::class, 'eliminarModeloCuadrosGrupo'])->name('eliminarModeloCuadrosGrupo')->middleware('role:jyz');


// CUADRO INDIVIDUAL -------
// Vista de cuadro de grupo
Route::get('/individual', [modelosIndividualesCuadros::class, 'verIndividual'])->name('C_individual')->middleware('role:jyz');

// PAQUETES  COLORES
// Agregar colores (usando POST)
Route::post('/paquetes/individual/agregar-colores', [modelosIndividualesCuadros::class, 'agregarColores'])->name('agregarColores_individual')->middleware('role:jyz');

// Eliminar paquete (usando POST)
Route::post('/paquetes/individual/eliminar-color/{id}', [modelosIndividualesCuadros::class, 'eliminarColor'])->name('eliminarColor_individual')->middleware('role:jyz');


// PAQUETES  MODELOS MARCOS
// Agregar modelo (usando POST)
Route::post('/paquetes/individual/agregar-modelos', [modelosIndividualesCuadros::class, 'agregarModelos'])->name('agregarModelos_individual')->middleware('role:jyz');

// Eliminar modelo (usando POST)
Route::post('/paquetes/individual/eliminar-modelo/{id}', [modelosIndividualesCuadros::class, 'eliminarModelo'])->name('eliminarModelo_individual')->middleware('role:jyz');


// PAQUETES MODELOS DE FOTOS DE CUADRO DE GRUPO
// Agregar modelo (usando POST)
Route::post('/paquetes/individual/agregar-modelos-cuadros-grupo', [modelosIndividualesCuadros::class, 'agregarModelosCuadrosGrupo'])->name('agregarModelosCuadrosGrupo_individual')->middleware('role:jyz');

// Eliminar modelo (usando POST)
Route::post('/paquetes/individual/eliminar-modelo-cuadros-grupo/{id}', [modelosIndividualesCuadros::class, 'eliminarModeloCuadrosGrupo'])->name('eliminarModeloCuadrosGrupo_individual')->middleware('role:jyz');


// Usuarios --------------

//
Route::prefix('usuarios')->group(function () {
    Route::get('/lista-usuarios', [usuariosController::class, 'VistaUsuarios'])->name('usuarios.index');
    Route::post('/guardarUsuario', [usuariosController::class, 'store'])->name('usuarios.store');
    Route::get('/{usuario}', [usuariosController::class, 'show'])->name('usuarios.show');
    Route::patch('/{usuario}', [usuariosController::class, 'update'])->name('usuarios.update');
    Route::patch('/usuarios/{usuario}/toggle-status', [UsuariosController::class, 'toggleStatus'])->name('usuarios.toggleStatus');
    Route::delete('/{usuario}', [usuariosController::class, 'destroy'])->name('usuarios.destroy');
});






//-------------Contratos---------------

//------------------- LOGINS ----------------------------

//------------------- Clientes ----------------------------

//Ruta para vista
Route::get('/registrar', [datosCliente::class, 'VistaRegistrar'])->name('registrar');

// Vista de login asignado a una escuela
Route::get('/JyZ/{id}', [Login::class, 'mostrarLoginAsignado'])->name('mostrarLoginAsignado');

// Comprobar existencia de usuario
Route::post('/JyZ/ingreso/{id}', [Login::class, 'ingresar'])->name('ingresar');

// Registrar o acceder usuario al dashboard
Route::post('/registrar-usuario', [Login::class, 'store'])->name('registrar.usuario');


//------------------- JYZ ----------------------------

// Ruta para la vista de login para administrador
Route::get('/jyz-admin', [LoginJyZ::class, 'VistaLoginAdmin'])->name('loginAdmin');


// Ruta para iniciar sesión como rol jyz
Route::post('/login', [LoginJyZ::class, 'Login'])->name('entrarAdmin');









// DASHBOARD USUARIO

Route::get('/dashboard', [DashboardController::class, 'index'])->name('principalUsuario');
Route::get('/logout', [Login::class, 'logout'])->name('logout.custom');





Route::get('/datos/{id}', [datosCliente::class, 'datos'])->name('datos');

Route::post('/datos/{id}', [EscuelaController::class, 'addAlumno'])->name('datos.add');

Route::get('/contrato/{id}', [EscuelaController::class, 'contratoAlumno'])->name('contrato.alumno');
