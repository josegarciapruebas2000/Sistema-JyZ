<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;




class usuariosController extends Controller
{
    public function VistaUsuarios()
    {
        // Obtener el usuario autenticado
        $authUser = Auth::user();

        // Verificar el rol del usuario autenticado
        if ($authUser->role == 'jyz') {
            // Obtener usuarios con rol 'jyz'
            $usuarios = User::where('role', 'jyz')->get(['id', 'nombre', 'telefono', 'status']);
        } else {
            // Obtener usuarios con rol diferente (ajustar según necesidades)
            $usuarios = User::all();
        }

        return view('jyz/usuarios', compact('usuarios'));
    }


    public function store(Request $request)
    {
        try {
            // Validar los datos
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'telefono' => 'required|string|max:15',
                'password' => 'required|string|max:4',
            ]);

            // Crear el usuario
            $user = new User();
            $user->nombre = $validatedData['nombre'];
            $user->telefono = $validatedData['telefono'];
            $user->password = Hash::make($validatedData['password']);
            $user->role = 'jyz';
            $user->status = 1;

            // Guardar el usuario
            $user->save();

            // Devolver respuesta de éxito
            return response()->json(['message' => 'Usuario agregado correctamente.'], 200);
        } catch (\Exception $e) {
            // Manejar errores y devolver respuesta JSON con mensaje de error específico
            return response()->json(['message' => 'Error al agregar el usuario: ' . $e->getMessage()], 500);
        }
    }

    public function show(User $usuario)
    {
        return response()->json($usuario);
    }

    public function update(Request $request, User $usuario)
    {


        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'password' => 'nullable|string|max:4',
        ]);

        $usuario->update([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'password' => $request->password ? Hash::make($request->password) : $usuario->password,
        ]);

        return response()->json(['success' => 'Usuario actualizado correctamente.']);
    }



    public function toggleStatus(User $usuario)
    {
        // Cambia el estado dependiendo del estado actual
        $nuevoEstado = $usuario->status == 1 ? 0 : 1;
        $usuario->update(['status' => $nuevoEstado]);

        $mensaje = $nuevoEstado ? 'Usuario habilitado correctamente.' : 'Usuario deshabilitado correctamente.';
        return redirect()->route('usuarios.index')->with('success', $mensaje);
    }






    // Método para eliminar un usuario
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
