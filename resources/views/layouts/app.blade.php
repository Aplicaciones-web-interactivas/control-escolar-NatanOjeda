<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Control Escolar</title>
</head>
<body class="bg-gray-100">

    <nav class="bg-blue-800 text-white p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <div class="flex space-x-2 items-center">
                <span class="font-bold text-xl mr-4">CE</span>               
                <a href="/inicio" class="px-3 py-2 rounded-md transition {{ request()->is('inicio') ? 'bg-blue-600 text-white font-bold shadow-inner' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">Inicio</a>               
                <a href="/materias" class="px-3 py-2 rounded-md transition {{ request()->is('materias') ? 'bg-blue-600 text-white font-bold shadow-inner' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">Materias</a>               
                <a href="/horarios" class="px-3 py-2 rounded-md transition {{ request()->is('horarios') ? 'bg-blue-600 text-white font-bold shadow-inner' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">Horarios</a>                
                <a href="/grupos" class="px-3 py-2 rounded-md transition {{ request()->is('grupos') ? 'bg-blue-600 text-white font-bold shadow-inner' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">Grupos</a>                
                <a href="/inscripciones" class="px-3 py-2 rounded-md transition {{ request()->is('inscripciones') ? 'bg-blue-600 text-white font-bold shadow-inner' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">Inscripciones</a>              
                <a href="/calificaciones" class="px-3 py-2 rounded-md transition {{ request()->is('calificaciones') ? 'bg-blue-600 text-white font-bold shadow-inner' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">Calificaciones</a>
                <a href="/tareas" class="px-3 py-2 rounded-md transition {{ request()->is('tareas') ? 'bg-blue-600 text-white font-bold shadow-inner' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">Tareas</a>            
            </div>
            
            <div class="flex items-center space-x-4">
                <span>Hola, {{ auth()->user()?->name ?? 'Usuario' }}</span>
                <form action="/logout" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded">Salir</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto mt-8 p-4">
        
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex items-center animate-pulse">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <p class="font-bold">{{ session('success') }}</p>
            </div>
        @endif

        @yield('content')
    </div>

</body>
</html>