<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginJyZ extends Controller
{

    public function Login(Request $request)
    {
        // Limpiar el número de teléfono para eliminar caracteres no numéricos
        $telefonoLimpio = preg_replace('/\D/', '', $request->input('telefono'));

        // Validar los datos del formulario
        $request->validate([
            'password' => 'required|min:4|max:4',
        ]);

        // Buscar el usuario con el teléfono proporcionado y el rol 'jyz'
        $user = User::where('telefono', $telefonoLimpio)
            ->where('role', 'jyz')
            ->first();

        // Validar si la cuenta está deshabilitada
        if ($user && $user->status == 0) {
            return redirect()->back()->withErrors(['message' => 'Su cuenta ha sido deshabilitada.']);
        }

        // Validar contraseña y autenticar
        if ($user && Hash::check($request->input('password'), $user->password)) {
            Auth::login($user);
            return redirect()->route('principal')->with('success', '¡Inicio de sesión exitoso!');
        }

        // Si la autenticación falla, redirigir de vuelta con un mensaje de error
        return redirect()->back()->withErrors(['message' => 'El número de teléfono o la contraseña no coinciden.']);
    }





    public function VistaLoginAdmin()
    {
        return view('loginAdmin');
    }
}
