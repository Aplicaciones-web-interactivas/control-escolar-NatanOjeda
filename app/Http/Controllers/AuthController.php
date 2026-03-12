<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function iniciarSesion(Request $request)
    {
        if (Auth::attempt(['clave_institucional' => $request->clave_institucional, 'password' => $request->password])) {
            return redirect('/inicio'); 
        }

        return back();
    }

    public function registrar(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'clave_institucional' => $request->clave_institucional,
            'password' => Hash::make($request->password),
            'rol' => 'ADMIN',
            'esta_activo' => true
        ]);

        return redirect('/');
    }

    public function cerrarSesion()
    {
        Auth::logout();
        return redirect('/');
    }
}