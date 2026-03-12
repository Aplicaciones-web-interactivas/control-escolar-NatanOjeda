<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Registro</title>
</head>
<body class="bg-gray-200 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Crear Usuario</h2>
        
        <form action="/register" method="POST">
            @csrf
            <div class="mb-4">
                <label>Nombre</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label>Clave Institucional</label>
                <input type="text" name="clave_institucional" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-6">
                <label>Contraseña</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Registrarse</button>
        </form>
        <div class="mt-4 text-center">
            <a href="/" class="text-blue-500 text-sm">Regresar al Login</a>
        </div>
    </div>
</body>
</html>