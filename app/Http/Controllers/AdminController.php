<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;

class AdminController extends Controller
{
    public function inicio()
    {
        return view('dashboard');
    }

    public function materias()
    {
        $materias = Materia::all();
        return view('materias', compact('materias'));
    }

    public function guardarMateria(Request $request)
    {
        Materia::create([
            'nombre_materia' => $request->nombre_materia,
            'clave' => $request->clave,
        ]);
        return back();
    }
}