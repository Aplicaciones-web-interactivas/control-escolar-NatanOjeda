@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Módulo de Tareas</h1>

    @if($usuario->rol === 'MAESTRO')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded shadow-md md:col-span-1 h-fit">
                <h2 class="text-xl font-bold mb-4">Asignar Nueva Tarea</h2>
                <form action="/tareas" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Grupo</label>
                        <select name="grupo_id" class="w-full border p-2 rounded" required>
                            <option value="">Selecciona tu grupo...</option>
                            @foreach($grupos as $grupo)
                                <option value="{{ $grupo->id }}">{{ $grupo->nombre_grupo }} - {{ $grupo->horario->materia->nombre_materia }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Título de la Tarea</label>
                        <input type="text" name="titulo" class="w-full border p-2 rounded" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Instrucciones</label>
                        <textarea name="descripcion" rows="3" class="w-full border p-2 rounded" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">Asignar Tarea</button>
                </form>
            </div>

            <div class="bg-white p-6 rounded shadow-md md:col-span-2">
                <h2 class="text-xl font-bold mb-4">Tareas Asignadas y Entregas</h2>
                @if($tareas->isEmpty())
                    <p class="text-gray-500 text-center py-4">Aún no has asignado tareas a tus grupos.</p>
                @else
                    @foreach($tareas as $tarea)
                        <div class="mb-6 border-2 border-gray-100 rounded-lg p-4">
                            <h3 class="font-bold text-lg text-blue-800">{{ $tarea->titulo }} <span class="text-sm font-normal text-gray-500">({{ $tarea->grupo->nombre_grupo }})</span></h3>
                            <p class="text-sm text-gray-600 mb-3">{{ $tarea->descripcion }}</p>
                            
                            <h4 class="font-bold text-sm text-gray-700 mb-2">Alumnos que entregaron:</h4>
                            @if($tarea->entregas->isEmpty())
                                <p class="text-xs text-red-500 italic">Nadie ha entregado esta tarea aún.</p>
                            @else
                                <ul class="list-disc pl-5 text-sm">
                                    @foreach($tarea->entregas as $entrega)
                                        <li class="mb-1">
                                            {{ $entrega->usuario->name }} - 
                                            <a href="{{ asset('storage/' . $entrega->archivo_pdf) }}" target="_blank" class="text-blue-500 hover:underline font-bold">Ver PDF</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    @elseif($usuario->rol === 'ALUMNO')
        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-bold mb-4">Tus Tareas Pendientes</h2>
            @if($tareas->isEmpty())
                <p class="text-gray-500 text-center py-4">¡Genial! No tienes tareas asignadas por el momento.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($tareas as $tarea)
                        <div class="border-2 border-gray-100 rounded-lg p-4">
                            <h3 class="font-bold text-lg">{{ $tarea->titulo }}</h3>
                            <p class="text-xs font-bold text-blue-600 mb-2">{{ $tarea->grupo->horario->materia->nombre_materia }} (Grupo {{ $tarea->grupo->nombre_grupo }})</p>
                            <p class="text-sm text-gray-600 mb-4">{{ $tarea->descripcion }}</p>

                            @if($tarea->entregas->isNotEmpty())
                                <div class="bg-green-100 text-green-800 p-2 rounded text-center text-sm font-bold">
                                    ¡Tarea Entregada! <a href="{{ asset('storage/' . $tarea->entregas->first()->archivo_pdf) }}" target="_blank" class="underline">Ver mi PDF</a>
                                </div>
                            @else
                                <form action="/entregas" method="POST" enctype="multipart/form-data" class="bg-gray-50 p-3 rounded">
                                    @csrf
                                    <input type="hidden" name="tarea_id" value="{{ $tarea->id }}">
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Sube tu PDF:</label>
                                    <input type="file" name="archivo_pdf" accept="application/pdf" class="w-full text-sm mb-2" required>
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-1 px-3 rounded w-full">Entregar Tarea</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
@endsection