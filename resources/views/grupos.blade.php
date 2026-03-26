@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Gestión de Grupos</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-bold mb-4">Crear Nuevo Grupo</h2>
            <form action="/grupos" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Nombre del Grupo</label>
                    <input type="text" name="nombre_grupo" class="w-full border p-2 rounded" placeholder="Ej. 1-A" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Asignar Horario/Clase</label>
                    <select name="horario_id" class="w-full border p-2 rounded" required>
                        <option value="">Selecciona un horario...</option>
                        @foreach($horarios as $h)
                            <option value="{{ $h->id }}">
                                {{ $h->materia->nombre_materia }} ({{ $h->usuario->name }}) - {{ $h->dias_semana }} de {{ \Carbon\Carbon::parse($h->hora_inicio)->format('H:i') }} a {{ \Carbon\Carbon::parse($h->hora_fin)->format('H:i') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700">Crear Grupo</button>
            </form>
        </div>

        <div class="bg-white p-6 rounded shadow-md">
            
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Grupos Existentes</h2>
                
                <form action="/grupos" method="GET" class="flex">
                    <input type="text" name="buscar" value="{{ $buscar ?? '' }}" placeholder="Buscar..." class="border p-2 rounded-l">
                    <button type="submit" class="bg-gray-800 text-white px-3 py-2 rounded-r">Buscar</button>
                    @if(!empty($buscar))
                        <a href="/grupos" class="ml-2 mt-2 text-red-500 text-sm hover:underline">Limpiar</a>
                    @endif
                </form>
            </div>

            @if($grupos->isEmpty())
                <p class="text-gray-500 text-center py-4">Aún no hay grupos registrados o no se encontró la búsqueda.</p>
            @else
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2">
                            <th class="py-2">Grupo</th>
                            <th class="py-2">Materia Vinculada</th>
                            <th class="py-2">Detalle de Horario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grupos as $grupo)
                            <tr class="border-b">
                                <td class="py-2 font-bold">{{ $grupo->nombre_grupo }}</td>
                                <td class="py-2">{{ $grupo->horario->materia->nombre_materia }}</td>
                                <td class="py-2 text-sm text-gray-600">
                                    {{ $grupo->horario->dias_semana }} ({{ \Carbon\Carbon::parse($grupo->horario->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($grupo->horario->hora_fin)->format('H:i') }})
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $grupos->appends(['buscar' => $buscar ?? ''])->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection