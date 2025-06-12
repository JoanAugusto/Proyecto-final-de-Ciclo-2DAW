<?php
  include_once '../sesiones.php';
comprobar_sesion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OrderFlow</title>
  <link rel="stylesheet" href="/OrderFlow Proyecto Ciclo 2ºDAW/Frontend/css/barravista.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body class="bg-dark text-white">

  <!-- Fondo completo -->
  <div class="position-fixed top-0 start-0 w-100 h-100 z-n1">
    <img src="https://images.unsplash.com/photo-1551218808-94e220e084d2" class="w-100 h-100 object-fit-cover" alt="background">
  </div>

  <div class="d-md-flex min-vh-100">

    <!-- NAVBAR móvil -->
    <nav class="navbar navbar-dark bg-dark d-md-none px-3">
      <div class="container-fluid">
        <img class="navbar-brand w-25 rounded-circle" src="/Logo Empresa/OrderFlow.png" alt="OrderFlow">
        <h3 class="text-white m-0">OrderFlow</h3>
        <button class="btn btn-outline-light" data-bs-toggle="offcanvas" data-bs-target="#offcanvasbarra">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    <!-- OFFCANVAS -->
    <div class="offcanvas offcanvas-end bg-dark text-white" tabindex="-1" id="offcanvasbarra">
      <div class="offcanvas-header border-bottom">
        <img class="w-25 rounded-circle" src="/OrderFlow Proyecto Ciclo 2ºDAW/assets/image/backiee-176253.jpg" alt="User">
        <h5 class="offcanvas-title">Nombre Usuario</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body d-flex flex-column gap-3">
        <a class="btn btn-danger btn-lg w-100" href="./cocinaVista.html">Inicio</a>
        <a class="btn btn-danger btn-lg w-100" href="./seccionComandaColaCocina.html">Comandas en Espera</a>
        <a class="btn btn-danger btn-lg w-100" href="./seccionesCocina/seccionComandapreparadoCocina.html">En Preparación</a>
        <a class="btn btn-danger btn-lg w-100" href="./seccionesCocina/seccionComandaFinalizadoCocina.html">Finalizadas</a>
        <a class="btn btn-outline-light mt-5 d-flex align-items-center gap-2" href="#">
          <img src="/OrderFlow Proyecto Ciclo 2ºDAW/assets/icons/logout_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg" alt="">
          LogOut
        </a>
      </div>
    </div>

    <!-- SIDEBAR en escritorio -->
    <div class="bg-black bg-opacity-75 d-none d-md-flex flex-column p-3 col-md-3 col-lg-2 shadow-lg">
      <div class="text-center mb-4">
        <img class="img-fluid rounded-circle" src="/Logo Empresa/OrderFlow.png" alt="OrderFlow">
        <h4 class="mt-2">OrderFlow</h4>
      </div>
      <nav class="nav flex-column gap-3">
        <a class="btn btn-danger" href="./cocinaVista.html">Inicio</a>
        <a class="btn btn-danger" href="./seccionComandaColaCocina.html">Comandas en Espera</a>
        <a class="btn btn-danger" href="./seccionesCocina/seccionComandapreparadoCocina.html">En Preparación</a>
        <a class="btn btn-danger" href="./seccionesCocina/seccionComandaFinalizadoCocina.html">Finalizadas</a>
        <a class="btn btn-outline-light mt-4 d-flex align-items-center gap-2" href="#">
          <img src="/OrderFlow Proyecto Ciclo 2ºDAW/assets/icons/logout_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg" alt="">
          LogOut
        </a>
      </nav>
    </div>

    <!-- CONTENIDO CENTRAL -->
    <main class="d-flex flex-column justify-content-center align-items-center text-center px-4 flex-grow-1">
      <div class="bg-dark bg-opacity-75 p-5 rounded-4 shadow-lg">
        <h1 class="display-4 fw-bold">¡Bienvenido, Nombre Usuario!</h1>
        <p class="lead">Pulsa el botón superior derecho</p>
        <p class="h5">para acceder a las funciones de la app</p>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
