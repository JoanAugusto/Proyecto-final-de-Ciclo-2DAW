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

    <!-- OFFCANVAS para móvil -->
    <div class="offcanvas offcanvas-end bg-dark text-white" tabindex="-1" id="offcanvasbarra">
      <div class="offcanvas-header border-bottom">
        <img class="w-25 rounded-circle" src="/OrderFlow Proyecto Ciclo 2ºDAW/assets/image/backiee-176253.jpg" alt="User">
        <h5 class="offcanvas-title">Nombre Usuario</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body d-flex flex-column gap-3">
        <a class="btn btn-danger btn-lg w-100" href="../templates/barraVista.php">Inicio</a>
        <a class="btn btn-danger btn-lg w-100" href="../templates/seccionComandaColaBarra.php">Comandas en Espera</a>
        <a class="btn btn-danger btn-lg w-100" href="../templates/seccionComandapreparadoBarra.php">En Preparación</a>
        <a class="btn btn-danger btn-lg w-100" href="../templates/seccionComandaFinalizadoBarra.php">Finalizadas</a>
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
        <a class="btn btn-danger" href="../templates/barraVista.php">Inicio</a>
        <a class="btn btn-danger" href="../templates/seccionComandaColaBarra.php">Comandas en Espera</a>
        <a class="btn btn-danger" href="../templates/seccionComandapreparadoBarra.php">En Preparación</a>
        <a class="btn btn-danger" href="../templates/seccionComandaFinalizadoBarra.php">Finalizadas</a>
        <a class="btn btn-outline-light mt-4 d-flex align-items-center gap-2" href="#">
          <img src="/OrderFlow Proyecto Ciclo 2ºDAW/assets/icons/logout_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg" alt="">
          LogOut
        </a>
      </nav>
    </div>