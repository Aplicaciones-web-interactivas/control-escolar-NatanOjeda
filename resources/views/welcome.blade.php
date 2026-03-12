<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Login - Control Escolar</title>
</head>
<body class="bg-gray-200 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Iniciar Sesión</h2>
        
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Clave Institucional</label>
                <input type="text" name="clave_institucional" class="w-full border p-2 rounded" required autofocus>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Entrar
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="/registro" class="text-blue-500 hover:text-blue-700 text-sm">¿No tienes cuenta? Regístrate aquí</a>
        </div>
    </div>
</body>
</html>