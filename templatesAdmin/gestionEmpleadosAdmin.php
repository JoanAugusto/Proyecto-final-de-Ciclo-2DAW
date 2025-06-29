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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      
      <strong>Victory Setup</strong>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

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

    <div class="d-none d-lg-block">
      <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
    </div>
  </div>
</nav>

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

<div class="container my-5">  
  <div class="card mb-4">
    <div class="card-body">
      <form class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
        <div class="col-md-4">
          <label for="nombreEmpleado" class="form-label">Nombre del empleado</label>
          <input type="text" class="form-control" id="nombreEmpleado" name="nombreEmpleado" placeholder="Buscar por nombre" value="<?php echo isset($_POST['nombreEmpleado']) ? htmlspecialchars($_POST['nombreEmpleado']) : ''; ?>">
        </div>
        <div class="col-md-4">
          <label for="rolEmpleado" class="form-label">Rol</label>
          <select class="form-select" id="rolEmpleado" name="rolEmpleado">
            <option value="Todos" <?php echo (isset($_POST['rolEmpleado']) && $_POST['rolEmpleado'] == 'Todos') ? 'selected' : ''; ?>>Todos</option>
            <option value="Camarero" <?php echo (isset($_POST['rolEmpleado']) && $_POST['rolEmpleado'] == 'Camarero') ? 'selected' : ''; ?>>Camarero</option>
            <option value="Cocinero" <?php echo (isset($_POST['rolEmpleado']) && $_POST['rolEmpleado'] == 'Cocinero') ? 'selected' : ''; ?>>Cocinero</option>
            <option value="Administrador" <?php echo (isset($_POST['rolEmpleado']) && $_POST['rolEmpleado'] == 'administrador') ? 'selected' : ''; ?>>Administrador</option>
            <option value="Barra" <?php echo (isset($_POST['rolEmpleado']) && $_POST['rolEmpleado'] == 'Barra') ? 'selected' : ''; ?>>Barra</option>
          </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
          <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
      </form>
    </div>
  </div>

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
                // Obtener los valores del filtro
                $nombreFiltro = isset($_POST['nombreEmpleado']) ? $_POST['nombreEmpleado'] : '';
                $rolFiltro = isset($_POST['rolEmpleado']) ? $_POST['rolEmpleado'] : 'Todos';

                $empleados = load_empleados_filtro($conn, $nombreFiltro, $rolFiltro);

                if($empleados === false){
                   echo "<div class='alert alert-danger text-center'>Error al conectar con la base de datos o no se encontraron empleados.</div>"; 
                }else{
                    
                      foreach($empleados as $empleadito => $valorCampos){
                        
                        $urlModificarEmpleado="./gestionEmpleadosAdminModificar.php?id_empleado=".$valorCampos['id_empleado'];
                        $urlEliminarEmpleado="./eliminarEmpleadoAdmin.php?id_empleado=".$valorCampos['id_empleado'];
                        echo "<tr>";
                              echo " <td>".htmlspecialchars($valorCampos["id_empleado"])."</td>";
                              echo " <td>".htmlspecialchars($valorCampos["nombre_empleado"])."</td>";
                              echo " <td>".htmlspecialchars($valorCampos["apellido_empleado"])."</td>";
                              echo " <td>".htmlspecialchars($valorCampos["correo_empleado"])."</td>";
                              echo " <td>".htmlspecialchars($valorCampos["numero_telefono_empleado"])."</td>";
                              echo " <td>".htmlspecialchars($valorCampos["rol_empleado"])."</td>";
                              
                              echo"<td>";
                                  echo"<a href='" . $urlModificarEmpleado . "' class='btn btn-sm btn-warning'>Editar</a> "; // Espacio añadido
                                  echo"<a href='" . $urlEliminarEmpleado . "' class='btn btn-sm btn-danger'>Eliminar</a>";
                              echo"</td>";

                        echo "</tr>";
                      }
                }
            
            ?>
        
      </tbody>
    </table>
    <?php 
          echo "<div class='text-center mt-4'>";
                  echo "<a href='./añadirEmpleadoAdmin.php' class='btn btn-success'>Añadir Empleado</a>";
              echo "</div>";
              
    ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>