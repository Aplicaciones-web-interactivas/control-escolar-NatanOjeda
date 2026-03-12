<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Horario;
use App\Models\Grupo;
use App\Models\User;

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

    public function horarios() {
        $materias = Materia::all();
        $usuarios = User::all();
        $horarios = Horario::with(['materia', 'usuario'])->get(); 
    
        return view('horarios', compact('materias', 'usuarios', 'horarios'));
    }

    public function guardarHorario(Request $request) {
        $dias_texto = $request->has('dias') ? implode('', $request->dias) : '';
        Horario::create([
            'materia_id' => $request->materia_id,
            'usuario_id' => $request->usuario_id,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'dias_semana' => $dias_texto,
        ]);
        return back();
    }

    public function grupos() {
        $horarios = Horario::with(['materia', 'usuario'])->get();
        $grupos = Grupo::with('horario.materia')->get();
        return view('grupos', compact('horarios', 'grupos'));
    }

    public function guardarGrupo(Request $request) {
        Grupo::create([
            'nombre_grupo' => $request->nombre_grupo,
            'horario_id' => $request->horario_id,
        ]);
        return back();
    }
}