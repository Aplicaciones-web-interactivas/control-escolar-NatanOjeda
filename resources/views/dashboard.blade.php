@extends('layouts.app')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">CONTROL ESCOLAR</h1>
        <p class="mt-2 text-gray-600">Bienvenido, <span class="font-bold text-blue-600">{{ auth()->user()?->name ?? 'Usuario' }}</span>. Aquí tienes el resumen de tu Control Escolar.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-500">
            <h3 class="text-gray-500 text-sm font-bold uppercase tracking-wider">Total Materias</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalMaterias }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-green-500">
            <h3 class="text-gray-500 text-sm font-bold uppercase tracking-wider">Grupos Activos</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalGrupos }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-purple-500">
            <h3 class="text-gray-500 text-sm font-bold uppercase tracking-wider">Inscripciones</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalInscripciones }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-yellow-500">
            <h3 class="text-gray-500 text-sm font-bold uppercase tracking-wider">Usuarios Registrados</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalUsuarios }}</p>
        </div>

    </div>
@endsection