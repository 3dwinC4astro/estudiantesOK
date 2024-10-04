<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Ajusta la ruta si es necesario -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8d7da;
            color: #721c24;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            padding: 20px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            background-color: #f8d7da;
        }
        h1 {
            font-size: 2em;
        }
        a {
            text-decoration: none;
            color: #155724;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Oh no!</h1>
        <p>Ha ocurrido un error inesperado.</p>
        <p>Error: {{ $error }}</p>
        <a href="{{ url('/home') }}">Volver a la página principal</a>
    </div>
</body>
</html>
