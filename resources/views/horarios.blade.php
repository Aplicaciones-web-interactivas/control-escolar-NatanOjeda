@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Gestión de Horarios</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-bold mb-4">Asignar Nuevo Horario</h2>
            <form action="/horarios" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Materia</label>
                    <select name="materia_id" class="w-full border p-2 rounded" required>
                        <option value="">Selecciona una materia...</option>
                        @foreach($materias as $materia)
                            <option value="{{ $materia->id }}">{{ $materia->nombre_materia }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Maestro (Usuario)</label>
                    <select name="usuario_id" class="w-full border p-2 rounded" required>
                        <option value="">Selecciona quién imparte...</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Hora Inicio</label>
                        <input type="time" name="hora_inicio" class="w-full border p-2 rounded" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Hora Fin</label>
                        <input type="time" name="hora_fin" class="w-full border p-2 rounded" required>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Días de la Semana</label>
                    <div class="flex space-x-4">
                        <label><input type="checkbox" name="dias[]" value="L"> Lunes</label>
                        <label><input type="checkbox" name="dias[]" value="Ma"> Martes</label>
                        <label><input type="checkbox" name="dias[]" value="Mi"> Miérc.</label>
                        <label><input type="checkbox" name="dias[]" value="J"> Jueves</label>
                        <label><input type="checkbox" name="dias[]" value="V"> Viernes</label>
                    </div>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700">Guardar Horario</button>
            </form>
        </div>

        <div class="bg-white p-6 rounded shadow-md">
            
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Horarios Asignados</h2>
                
                <form action="/horarios" method="GET" class="flex">
                    <input type="text" name="buscar" value="{{ $buscar ?? '' }}" placeholder="Buscar..." class="border p-2 rounded-l">
                    <button type="submit" class="bg-gray-800 text-white px-3 py-2 rounded-r">Buscar</button>
                    @if(!empty($buscar))
                        <a href="/horarios" class="ml-2 mt-2 text-red-500 text-sm hover:underline">Limpiar</a>
                    @endif
                </form>
            </div>

            @if($horarios->isEmpty())
                <p class="text-gray-500 text-center py-4">Aún no hay horarios registrados o no se encontró la búsqueda.</p>
            @else
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="border-b-2">
                            <th class="py-2">Materia</th>
                            <th class="py-2">Maestro</th>
                            <th class="py-2">Días</th>
                            <th class="py-2">Horario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($horarios as $horario)
                            <tr class="border-b">
                                <td class="py-2">{{ $horario->materia->nombre_materia }}</td>
                                <td class="py-2">{{ $horario->usuario->name }}</td>
                                <td class="py-2 font-bold text-blue-600">{{ $horario->dias_semana }}</td>
                                <td class="py-2">{{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($horario->hora_fin)->format('H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $horarios->appends(['buscar' => $buscar ?? ''])->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection