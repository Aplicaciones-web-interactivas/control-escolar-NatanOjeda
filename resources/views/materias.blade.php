@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Gestión de Materias</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-bold mb-4">Registrar Nueva Materia</h2>
            
            <form action="/materias" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Clave de la Materia</label>
                    <input type="text" name="clave" class="w-full border p-2 rounded" placeholder="Ej. MAT-01" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Materia</label>
                    <input type="text" name="nombre_materia" class="w-full border p-2 rounded" placeholder="Ej. Matemáticas" required>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Guardar Materia
                </button>
            </form>
        </div>

        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-bold mb-4">Materias Existentes</h2>
            
            @if($materias->isEmpty())
                <p class="text-gray-500 text-center py-4">Aún no hay materias registradas.</p>
            @else
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="py-2 text-gray-600">Clave</th>
                            <th class="py-2 text-gray-600">Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materias as $materia)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-2">{{ $materia->clave }}</td>
                                <td class="py-2">{{ $materia->nombre_materia }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
@endsection