<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Horario;
use App\Models\Grupo;
use App\Models\User;
use App\Models\Calificacion;
use App\Models\Inscripcion;

class AdminController extends Controller
{
    public function inicio()
    {
        $totalMaterias = Materia::count();
        $totalGrupos = Grupo::count();
        $totalInscripciones = Inscripcion::count();
        $totalUsuarios = User::count();

        return view('dashboard', compact('totalMaterias', 'totalGrupos', 'totalInscripciones', 'totalUsuarios'));
    }

    public function materias(Request $request)
    {
        $buscar = $request->get('buscar');

        $materias = Materia::when($buscar, function ($query, $buscar) {
            return $query->where('nombre_materia', 'ILIKE', '%' . $buscar . '%')
                         ->orWhere('clave', 'ILIKE', '%' . $buscar . '%');
        })->orderBy('id', 'desc')->paginate(5); 

        return view('materias', compact('materias', 'buscar'));
    }

    public function guardarMateria(Request $request)
    {
        Materia::create([
            'nombre_materia' => $request->nombre_materia,
            'clave' => $request->clave,
        ]);
        
        return back()->with('success', '¡Materia registrada exitosamente!');
    }

    public function horarios(Request $request) {
        $materias = Materia::all();
        $usuarios = User::all();
        $buscar = $request->get('buscar');

        $horarios = Horario::with(['materia', 'usuario'])
            ->when($buscar, function ($query, $buscar) {
                $query->whereHas('materia', function ($q) use ($buscar) {
                    $q->where('nombre_materia', 'ILIKE', '%' . $buscar . '%');
                })->orWhereHas('usuario', function ($q) use ($buscar) {
                    $q->where('name', 'ILIKE', '%' . $buscar . '%');
                });
            })->orderBy('id', 'desc')->paginate(5); 
    
        return view('horarios', compact('materias', 'usuarios', 'horarios', 'buscar'));
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

    public function grupos(Request $request) {
        $horarios = Horario::with(['materia', 'usuario'])->get();
        $buscar = $request->get('buscar');

        $grupos = Grupo::with('horario.materia')
            ->when($buscar, function ($query, $buscar) {
                $query->where('nombre_grupo', 'ILIKE', '%' . $buscar . '%')
                      ->orWhereHas('horario.materia', function ($q) use ($buscar) {
                          $q->where('nombre_materia', 'ILIKE', '%' . $buscar . '%');
                      });
            })->orderBy('id', 'desc')->paginate(5);

        return view('grupos', compact('horarios', 'grupos', 'buscar'));
    }

    public function guardarGrupo(Request $request) {
        Grupo::create([
            'nombre_grupo' => $request->nombre_grupo,
            'horario_id' => $request->horario_id,
        ]);
        return back();
    }

    public function calificaciones(Request $request) {
        $grupos = Grupo::with('horario.materia')->get();
        $usuarios = User::all();
        $buscar = $request->get('buscar');
        
        $calificaciones = Calificacion::with(['grupo.horario.materia', 'usuario'])
            ->when($buscar, function ($query, $buscar) {
                $query->whereHas('usuario', function ($q) use ($buscar) {
                    $q->where('name', 'ILIKE', '%' . $buscar . '%');
                })->orWhereHas('grupo', function ($q) use ($buscar) {
                    $q->where('nombre_grupo', 'ILIKE', '%' . $buscar . '%');
                });
            })->orderBy('id', 'desc')->paginate(5);
        
        $inscripcionesTodas = Inscripcion::with(['grupo.horario.materia', 'usuario'])->get();
        
        return view('calificaciones', compact('grupos', 'usuarios', 'calificaciones', 'buscar', 'inscripcionesTodas'));
    }

    public function guardarCalificacion(Request $request) {
        Calificacion::updateOrCreate(
            ['grupo_id' => $request->grupo_id, 'usuario_id' => $request->usuario_id],
            ['calificacion' => $request->calificacion]
        );
        return back();
    }

    public function inscripciones(Request $request) {
        $grupos = Grupo::with('horario.materia')->get();
        $usuarios = User::all();
        $buscar = $request->get('buscar');
        
        $inscripciones = Inscripcion::with(['grupo.horario.materia', 'usuario'])
            ->when($buscar, function ($query, $buscar) {
                $query->whereHas('usuario', function ($q) use ($buscar) {
                    $q->where('name', 'ILIKE', '%' . $buscar . '%');
                })->orWhereHas('grupo', function ($q) use ($buscar) {
                    $q->where('nombre_grupo', 'ILIKE', '%' . $buscar . '%');
                });
            })->orderBy('id', 'desc')->paginate(5);
        
        return view('inscripciones', compact('grupos', 'usuarios', 'inscripciones', 'buscar'));
    }

    public function guardarInscripcion(Request $request) {
        Inscripcion::create([
            'usuario_id' => $request->usuario_id,
            'grupo_id' => $request->grupo_id,
        ]);
        return back();
    }
}