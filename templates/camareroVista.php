<?php
  include_once '../sesiones.php';
  comprobar_sesion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Vista Camarero</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="/OrderFlow Proyecto Ciclo 2ºDAW/Frontend/css/camarerovista.css">
</head>
<body class=""> 

<!-- Fondo completo -->
  <div class="position-fixed top-0 start-0 w-100 h-100 z-n1">
    <img src="https://images.unsplash.com/photo-1551218808-94e220e084d2" class="w-100 h-100 object-fit-cover" alt="background">
  </div>
  <!-- Navbar -->
  <?php
  require'../includesFrontend/Navbar.php';
  ?>

  <!-- Bienvenida -->
  <main class="d-flex flex-column justify-content-center align-items-center text-center px-4 flex-grow-1">
      <div class="bg-dark bg-opacity-75 p-5 rounded-4 shadow-lg text-light">
        <h1 class="display-4 fw-bold text-light">¡Bienvenido, Nombre Usuario!</h1>
        <p class="lead text-light">Pulsa el botón superior derecho</p>
        <p class="h5 text-light">para acceder a las funciones de la app</p>
      </div>
    </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
