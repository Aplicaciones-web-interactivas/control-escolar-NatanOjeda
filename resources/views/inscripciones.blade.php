@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Gestión de Inscripciones</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-bold mb-4">Registrar Inscripción</h2>
            <form action="/inscripciones" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Grupo</label>
                    <select name="grupo_id" class="w-full border p-2 rounded" required>
                        @if($grupos->isEmpty())
                            <option value="">No hay grupos disponibles</option>
                        @else
                            <option value="">Selecciona un grupo...</option>
                            @foreach($grupos as $grupo)
                                <option value="{{ $grupo->id }}">
                                    {{ $grupo->nombre_grupo }} - {{ $grupo->horario->materia->nombre_materia }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Estudiante</label>
                    <select name="usuario_id" class="w-full border p-2 rounded" required>
                        @if($usuarios->isEmpty())
                            <option value="">No hay estudiantes disponibles</option>
                        @else
                            <option value="">Selecciona un estudiante...</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">
                                    {{ $usuario->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Registrar Inscripción
                </button>
            </form>
        </div>
        
        <div class="bg-white p-6 rounded shadow-md">
            
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Inscripciones Actuales</h2>
                
                <form action="/inscripciones" method="GET" class="flex">
                    <input type="text" name="buscar" value="{{ $buscar ?? '' }}" placeholder="Buscar..." class="border p-2 rounded-l">
                    <button type="submit" class="bg-gray-800 text-white px-3 py-2 rounded-r">Buscar</button>
                    @if(!empty($buscar))
                        <a href="/inscripciones" class="ml-2 mt-2 text-red-500 text-sm hover:underline">Limpiar</a>
                    @endif
                </form>
            </div>

            @if($inscripciones->isEmpty())
                <p class="text-gray-500 text-center py-4">Aún no hay inscripciones registradas o no se encontró la búsqueda.</p>
            @else
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2">
                            <th class="py-2">Grupo (Materia)</th>
                            <th class="py-2">Estudiante</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inscripciones as $inscripcion)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 text-sm">{{ $inscripcion->grupo->nombre_grupo }} ({{ $inscripcion->grupo->horario->materia->nombre_materia }})</td>
                                <td class="py-2 text-sm">{{ $inscripcion->usuario->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $inscripciones->appends(['buscar' => $buscar ?? ''])->links() }}
                </div>
            @endif

        </div>

    </div>
@endsection