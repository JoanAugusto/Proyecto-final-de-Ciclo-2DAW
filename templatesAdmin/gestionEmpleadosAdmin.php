<?php 
    include '../includesAdmin/OrderFlowBDAdmin.php';
    include '../db/conectionDB.php';
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestión de Empleados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

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
          <a class="nav-link active" href="./gestionMesasAdmin.php">Gestión de Mesas</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link" href="./gestionProductosAdmin.php">Gestión de Productos</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link active" href="./gestionMenuAdmin.php">Gestión de Menu</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link" href="./gestionEmpleadosAdmin.php">Gestión de Empleados</a>
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
        <a class="nav-link active" href="./gestionMesasAdmin.php">Gestión de Mesas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./gestionProductosAdmin.php"> Gestión de Productos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="./gestionMenuAdmin.php">Gestión de Menu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./gestionEmpleadosAdmin.php">Gestión de Empleados</a>
      </li>
      <li class="nav-item mt-3">
        <a href="logout.php" class="btn btn-danger w-100">Cerrar sesión</a>
      </li>
    </ul>
  </div>
</div>

<!-- CONTENIDO PRINCIPAL -->
<div class="container my-5">
  <!-- Filtro -->
  <div class="card mb-4">
    <div class="card-body">
      <form class="row g-3">
        <div class="col-md-4">
          <label for="nombreEmpleado" class="form-label">Nombre del empleado</label>
          <input type="text" class="form-control" id="nombreEmpleado" placeholder="Buscar por nombre">
        </div>
        <div class="col-md-4">
          <label for="rolEmpleado" class="form-label">Rol</label>
          <select class="form-select" id="rolEmpleado">
            <option selected>Todos</option>
            <option>Camarero</option>
            <option>Cocinero</option>
            <option>Admin</option>
          </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
          <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Tabla -->
  <div class="table-responsive ">
    <table class="table table-striped table-hover">
      <thead class="table-dark ">
        <tr>
          <th>ID</th>
          <th>Nombre Empleado</th>
          <th>Apellido Empleado</th>
          <th>Correo Electronico</th>
          <th>Numero Telefono</th>
          <th>Rol</th>
          <th>Acciones </th>
          
        </tr>
      </thead>
      <tbody>
            <?php 
                $empleados= load_empleados($conn);

                if($empleados === false){
                   echo "<div class='alert alert-danger text-center'>Error al conectar con la base de datos</div>"; 
                }else{
                    
                 
                        foreach($empleados as $empleaditos => $valorCampos){
                          $urlModificarEmpleado="../gestionEmpleadosAdminModificar.php?id_empleado=".$valorCampos['id_empleado'];
                          $urlEliminarEmpleado="../eliminarEmpleadoAdmin.php?id_empleado=".$valorCampos['id_empleado'];
                          echo "<tr>";
                                echo " <td>".htmlspecialchars($valorCampos["id_empleado"])."</td>";
                                echo " <td>".htmlspecialchars($valorCampos["nombre_empleado"])."</td>";
                                echo " <td>".htmlspecialchars($valorCampos["apellido_empleado"])."</td>";
                                echo " <td>".htmlspecialchars($valorCampos["correo_empleado"])."</td>";
                                echo " <td>".htmlspecialchars($valorCampos["numero_telefono_empleado"])."</td>";
                                echo " <td>".htmlspecialchars($valorCampos["rol_empleado"])."</td>";
                               
                                echo"<td>";
                                    echo"<a href='" . $urlModificarEmpleado . "' class=btn btn-sm btn-warning>Editar</a>";
                                    echo"<a  href='" . $urlEliminarEmpleado . "' class=btn btn-sm btn-danger>Eliminar</a>";
                                echo"</td>";

                            echo "</tr>";
                         
                        }
                    
                }
            
            ?>
       
      </tbody>
    </table>
    <?php 
         echo "<div class='text-center mt-4'>";
                        echo "<a href='../añadirEmpleadoAdmin.php' class='btn btn-success'>Añadir Empleado</a>";
                    echo "</div>";
                   
    ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
