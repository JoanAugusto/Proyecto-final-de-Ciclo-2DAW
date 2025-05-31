<?php
// Aquí podrías verificar sesión si hace falta
// session_start();
// if (!isset($_SESSION['admin'])) {
//     header('Location: login.php');
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <?php
    require '../includesAdmin/NavbarAdmin.php';
  ?>
  <!-- Menú de administración -->
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="list-group text-center">
          <a href="#" class="list-group-item list-group-item-action">Gestión de Productos</a>
          <a href="#" class="list-group-item list-group-item-action">Gestión de Mesas</a>
          <a href="./seccionesAdmin/gestionEmpleadosAdmin.php" class="list-group-item list-group-item-action">Gestión de Empleados</a>
          <a href="#" class="list-group-item list-group-item-action">Ver Pedidos</a>
        </div>
      </div>
    </div>
  </div>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
