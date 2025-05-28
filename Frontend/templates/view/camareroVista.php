<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Vista Camarero</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="/OrderFlow Proyecto Ciclo 2ºDAW/Frontend/css/camarerovista.css">
</head>
<body class="image-font-start"> 

  <!-- Navbar -->
  <nav class="navbar bg-warning d-flex justify-content-between align-items-center px-3">
    <img src="/Logo Empresa/OrderFlow.png" class="rounded-circle" style="width: 60px;" alt="LogoEmpresa">
    <span class="h5 mb-0 text-dark">OrderFlow</span>
    <button class="btn btn-outline-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>

  <!-- Offcanvas Usado en otras vistas -->
  <div class="offcanvas offcanvas-end offcanvas-lg" tabindex="-1" id="offcanvas">
    <div class="offcanvas-header">
      <img src="/OrderFlow Proyecto Ciclo 2ºDAW/assets/image/backiee-89014.jpg" class="rounded w-25 me-3" alt="Usuario">
      <h6 class="offcanvas-title">Nombre Usuario</h6>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body bg-light d-flex flex-column align-items-center">
      <a href="./camareroVista.html" class="btn btn-primary w-75 mb-3 fs-5">Inicio</a>
      <a href="./seccionesCamarero/seccionMesasCamarero.php" class="btn btn-primary w-75 mb-3 fs-5">Sección de Mesas</a>
      <a href="./seccionesCamarero/seccionComandasCamarero.php" class="btn btn-primary w-75 mb-5 fs-5">Sección de Comandas</a>
      <div class="d-flex align-items-center gap-2 mt-4">
        <img src="/OrderFlow Proyecto Ciclo 2ºDAW/assets/icons/logout_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg" alt="">
        <p class="h5 mb-0">LogOut</p>
      </div>
    </div>
  </div>
  

  <!-- Bienvenida -->
  <div class="container  text-white text-center mt-5">
    <h3 class="mb-3">Bienvenido Nombre Usuario</h3>
    <h4 class="mb-2">Pulsa el botón de arriba a la derecha</h4>
    <p class="fs-5">para acceder a las funciones de la app</p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
