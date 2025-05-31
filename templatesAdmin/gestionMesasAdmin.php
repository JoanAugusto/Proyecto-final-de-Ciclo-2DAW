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

<?php
  require '../includesAdmin/NavbarAdmin.php';
?>

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
          <th>Zona Mesa</th>
          <th>Estado Mesa</th>
          
          <th>Acciones </th>
          
        </tr>
      </thead>
      <tbody>
            <?php 
                $mesas=load_mesas($conn);

                if($mesas === false){
                   echo "<div class='alert alert-danger text-center'>Error al conectar con la base de datos</div>"; 
                }else{
                    
                 
                        foreach($mesas as $mesitas => $valorCamposMesa){
                          $urlModificarMesa="../gestionMesaAdminModificar.php?id_mesa=".$valorCamposMesa['id_mesa'];
                        //   require_once '../gestionMesaAdminModificar.php';
                          $urlEliminarMesa="../eliminarMesaAdmin.php?id_mesa=".$valorCamposMesa['id_mesa'];
                          echo "<tr>";
                                echo " <td>".htmlspecialchars($valorCamposMesa["id_mesa"])."</td>";
                                echo " <td>".htmlspecialchars($valorCamposMesa["zona_mesa"])."</td>";
                                echo " <td>".htmlspecialchars($valorCamposMesa["estado_mesa"])."</td>";
                               
                               
                                echo"<td>";
                                    echo"<a href='" . $urlModificarMesa . "' class=btn btn-sm btn-warning>Editar</a>";
                                    echo"<a  href='" . $urlEliminarMesa . "' class=btn btn-sm btn-danger>Eliminar</a>";
                                echo"</td>";

                            echo "</tr>";
                         
                        }
                    
                }
            
            ?>
       
      </tbody>
    </table>
    <?php 
         echo "<div class='text-center mt-4'>";
                        echo "<a href='../añadirMesaAdmin.php' class='btn btn-success'>Añadir Empleado</a>";
                    echo "</div>";
                   
    ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
