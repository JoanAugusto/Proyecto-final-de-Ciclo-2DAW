<!-- Navbar -->
  <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" href="#">
      <!-- Aquí metes tu logo -->
      <strong>Victory Setup</strong>
    </a>

    <!-- Botón para móviles -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Elementos grandes en desktop -->
    <div class="collapse navbar-collapse justify-content-center d-none d-lg-flex">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item px-3">
          <a class="nav-link active" href="../templatesAdmin/gestionMesasAdmin.php">Gestión de Mesas</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link" href="../templatesAdmin/gestionProductosAdmin.php">Gestión de Productos</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link active" href="../templatesAdmin/gestionMenuAdmin.php">Gestión de Menu</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link" href="../templatesAdmin/gestionEmpleadosAdmin.php">Gestión de Empleados</a>
        </li>
      </ul>
    </div>

    <!-- Botón cerrar sesión -->
    <div class="d-none d-lg-block">
      <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
    </div>
  </div>
</nav>

<!-- OFFCANVAS para móviles -->
<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Victory Setup</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="../templatesAdmin/gestionMesasAdmin.php">Gestión de Mesas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../templatesAdmin/gestionProductosAdmin.php"> Gestión de Productos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="../templatesAdmin/gestionMenuAdmin.php">Gestión de Menu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../templatesAdmin/gestionEmpleadosAdmin.php">Gestión de Empleados</a>
      </li>
      <li class="nav-item mt-3">
        <a href="../Logout.php" class="btn btn-danger w-100">Cerrar sesión</a>
      </li>
    </ul>
  </div>
</div>

