@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold">Bienvenido, {{ auth()->user()?->name ?? 'Usuario' }}</h1>
        <p class="mt-4 text-gray-600">Este es el sistema básico de Control Escolar.</p>
    </div>
@endsection