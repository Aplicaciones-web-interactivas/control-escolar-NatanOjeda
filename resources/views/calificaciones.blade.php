@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Captura de Calificaciones</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-bold mb-4">Asignar Calificación</h2>
            <form action="/calificaciones" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Grupo</label>
                    <select name="grupo_id" id="grupo_id" class="w-full border p-2 rounded" required>
                        <option value="">Selecciona un grupo...</option>
                        @foreach($grupos as $grupo)
                            <option value="{{ $grupo->id }}">
                                {{ $grupo->nombre_grupo }} - {{ $grupo->horario->materia->nombre_materia }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Alumno</label>
                    <select name="usuario_id" id="usuario_id" class="w-full border p-2 rounded" required>
                        <option value="">Primero selecciona un grupo...</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Calificación</label>
                    <input type="number" step="0.1" min="0" max="10" name="calificacion" class="w-full border p-2 rounded" placeholder="Ej. 8.5" required>
                </div>
                
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700">Guardar Calificación</button>
            </form>
        </div>

        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-bold mb-4">Calificaciones Actuales</h2>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-2">
                        <th class="py-2">Grupo (Materia)</th>
                        <th class="py-2">Alumno</th>
                        <th class="py-2">Calificación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($calificaciones as $calificacion)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 text-sm">{{ $calificacion->grupo->nombre_grupo }} ({{ $calificacion->grupo->horario->materia->nombre_materia }})</td>
                            <td class="py-2 text-sm">{{ $calificacion->usuario->name }}</td>
                            <td class="py-2 text-sm">{{ $calificacion->calificacion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inscripciones = @json($inscripciones);
            const usuarios = @json($usuarios);

            const grupoSelect = document.getElementById('grupo_id');
            const alumnoSelect = document.getElementById('usuario_id');

            grupoSelect.addEventListener('change', function() {
                const grupoId = parseInt(this.value);
                alumnoSelect.innerHTML = '<option value="">Selecciona al alumno...</option>';
            
                if (!grupoId) return;
                const inscripcionesGrupo = inscripciones.filter(i => i.grupo_id === grupoId);
                inscripcionesGrupo.forEach(inscripcion => {
                    const usuario = usuarios.find(u => u.id === inscripcion.usuario_id);
                    if (usuario) {
                        const option = document.createElement('option');
                        option.value = usuario.id;
                        option.textContent = usuario.name;
                        alumnoSelect.appendChild(option);
                    }
                });
            });
        });
    </script>
@endsection