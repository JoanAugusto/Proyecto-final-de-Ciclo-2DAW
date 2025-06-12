
<?php
  include_once '../sesiones.php';
comprobar_sesion();   
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OrderFlow Barra</title>
  <link rel="stylesheet" href="/OrderFlow Proyecto Ciclo 2ºDAW/Frontend/css/barravista.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

  
  <!-- Fondo completo -->
  <div class="position-fixed top-0 start-0 w-100 h-100 z-n1">
    <img src="https://images.unsplash.com/photo-1551218808-94e220e084d2" class="w-100 h-100 object-fit-cover" alt="background">
  </div>
  <?php
    require'../includesFrontend/NavbarBarra.php';
  ?>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="d-flex flex-column justify-content-center align-items-center text-center px-4 flex-grow-1">
      <div class="bg-dark bg-opacity-75 p-5 rounded-4 shadow-lg">
        <h1 class="display-4 fw-bold">¡Bienvenido, Nombre Usuario!</h1>
        <p class="lead">Pulsa el botón superior derecho</p>
        <p class="h5">para acceder a las funciones de la app</p>
      </div>
    </main>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
