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
  

  <!-- Tabla -->
  <div class="table-responsive ">
    <table class="table table-striped table-hover">
      <thead class="table-dark ">
        <tr>
          <th>ID</th>
          <th>Nombre Categoria</th>
          
          
          <th>Acciones </th>
          
        </tr>
      </thead>
      <tbody>
            <?php 
                $categoriasMenu=load_menus($conn);

                if($categoriasMenu === false){
                   echo "<div class='alert alert-danger text-center'>Error al conectar con la base de datos</div>"; 
                }else{
                    
                 
                        foreach($categoriasMenu as $mensitos => $valorCamposMenu){
                          $urlModificarMenu="../gestionMenuAdminModificar.php?id_categoria=".$valorCamposMenu['id_categoria'];
                        //   require_once '../gestionMesaAdminModificar.php';
                          $urlEliminarMenu="../eliminarMenuAdmin.php?id_categoria=".$valorCamposMenu['id_categoria'];
                          echo "<tr>";
                                echo " <td>".htmlspecialchars($valorCamposMenu["id_categoria"])."</td>";
                                echo " <td>".htmlspecialchars($valorCamposMenu["nombre_categoria"])."</td>";
                                
                               
                               
                                echo"<td>";
                                    echo"<a href='" . $urlModificarMenu . "' class=btn btn-sm btn-warning>Editar</a>";
                                    echo"<a  href='" . $urlEliminarMenu . "' class=btn btn-sm btn-danger>Eliminar</a>";
                                echo"</td>";

                            echo "</tr>";
                         
                        }
                    
                }
            
            ?>
       
      </tbody>
    </table>
    <?php 
         echo "<div class='text-center mt-4'>";
                        echo "<a href='../añadirMenuAdmin.php' class='btn btn-success'>Añadir Menu</a>";
                    echo "</div>";
                   
    ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
