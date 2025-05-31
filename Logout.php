<?php
require_once './sesiones.php';  
comprobar_sesion();

// Vaciar sesión y destruirla
$_SESSION = [];
session_destroy();

// Eliminar cookie de sesión
setcookie(session_name(), '', time() - 3600, '/');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Sesión cerrada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body class="bg-light d-flex flex-column justify-content-center align-items-center vh-100">

    <div class="text-center p-4 bg-white rounded shadow" style="max-width: 400px; width: 90%;">
        <h1 class="mb-3 text-success fw-bold">Sesión cerrada</h1>
        <p class="mb-4 fs-5">La sesión se ha cerrado correctamente, ¡hasta la próxima!</p>
        <a href="login.php" class="btn btn-primary btn-lg rounded-pill px-4">
            Ir a la página de login
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
