<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Escuela;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $escuelaUsuario = Escuela::find($user->id_escuela);

        return view('principal', compact('user', 'escuelaUsuario'));
    }
}
