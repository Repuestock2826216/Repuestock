

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página de Login</title>
    <script>
        // Evitar que el usuario vuelva a la página anterior
        history.pushState(null, "", index.html);
        window.onpopstate = function() {
            history.pushState(null, "", index.html);
        };
    </script>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <!-- Aquí puedes incluir tu formulario de inicio de sesión -->
</body>
</html>