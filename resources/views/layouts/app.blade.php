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
            <div class="flex space-x-6 items-center">
                <span class="font-bold text-xl">CE</span>
                <a href="/inicio" class="hover:text-blue-200">Inicio</a>
                <a href="/materias" class="hover:text-blue-200">Tareas (Materias)</a>
                <a href="/horarios" class="hover:text-blue-200">Horarios</a>
                <a href="/grupos" class="hover:text-blue-200">Grupos</a>
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
        @yield('content')
    </div>

</body>
</html>