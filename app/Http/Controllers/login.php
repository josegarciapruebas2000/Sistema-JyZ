<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Escuela;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class login extends Controller
{


    public function mostrarDashboard()
    {
        $user = Auth::user();
        $escuela = Escuela::find($user->id_escuela);

        return view('dashboard', compact('user', 'escuela'));
    }

    //Cerrar sesión
    public function logout(Request $request)
    {
        $user = Auth::user();
        $idEscuela = $user->id_escuela;
        $role = $user->role;

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($role === 'jyz') {
            return redirect()->route('loginAdmin');
        }

        return redirect()->route('mostrarLoginAsignado', ['id' => $idEscuela]);
    }



    public function mostrarLoginAsignado($id)
    {
        $escuela = Escuela::find($id);
        return view('login', compact('escuela'));
    }

    public function ingresar(Request $request, $id)
    {
        // Debugging: Detiene la ejecución y muestra todos los datos del formulario
        //dd($request->all());

        // Limpiar el número de teléfono para eliminar caracteres no numéricos
        $telefonoLimpio = preg_replace('/\D/', '', $request->input('telefono'));
        $id_escuela = $request->input('id_escuela');

        // Buscar el usuario con el teléfono y asegurarse de que también pertenece a la escuela correcta
        $usuario = User::where('telefono', $telefonoLimpio)->where('id_escuela', $id_escuela)->first();

        if (!$usuario) {
            return response()->json([
                'success' => false,
                'message' => 'Este número de teléfono no se encuentra dentro de la escuela asignada. ¿Deseas registrarlo para poder continuar?',
                'errorType' => 'notRegistered'
            ]);
        } else {
            if (Hash::check($request->input('password'), $usuario->password)) {
                Auth::login($usuario);
                return response()->json(['success' => true, 'redirect' => route('principalUsuario')]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'La contraseña es incorrecta.',
                    'errorType' => 'wrongPassword'
                ]);
            }
        }
    }

    public function store(Request $request)
    {
        // Limpiar el número de teléfono antes de la validación
        $telefonoLimpio = preg_replace('/\D/', '', $request->input('telefono'));

        $request->merge(['telefono' => $telefonoLimpio]); // Actualizar el request con el número limpio

        $request->validate([
            'telefono' => 'required',
            'password' => 'required',
            'id_escuela' => 'required|exists:escuelas,id',
        ]);

        try {
            $user = new User();
            $user->telefono = $telefonoLimpio;
            $user->password = Hash::make($request->password);
            $user->id_escuela = $request->id_escuela;
            $user->role = 'cliente';

            $user->save();

            Auth::login($user);
            return response()->json(['success' => true, 'redirect' => route('principalUsuario')]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Hubo un error al registrar el usuario. Error: ' . $e->getMessage()]);
        }
    }
}
