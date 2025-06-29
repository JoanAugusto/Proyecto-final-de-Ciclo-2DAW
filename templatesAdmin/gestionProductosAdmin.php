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
          <th>Nombre Producto</th>
          <th>Precio Producto</th>
           <th>Descripcion Producto</th>
            <th>Tipo</th>
             <th>ID Categoria</th>
          
          <th>Acciones </th>
          
        </tr>
      </thead>
      <tbody>
            <?php 
                $productos=load_productos($conn);

                if($productos === false){
                   echo "<div class='alert alert-danger text-center'>Error al conectar con la base de datos</div>"; 
                }else{
                    
                 
                        foreach($productos as $productitos => $valorCamposProducto){
                          $urlModificarProducto="../gestionProductoAdminModificar.php?id_producto=".$valorCamposProducto['id_producto'];
                        //   require_once '../gestionMesaAdminModificar.php';
                          $urlEliminarProducto="../eliminarProductoAdmin.php?id_producto=".$valorCamposProducto['id_producto'];
                          echo "<tr>";
                                echo " <td>".htmlspecialchars($valorCamposProducto["id_producto"])."</td>";
                                echo " <td>".htmlspecialchars($valorCamposProducto["nombre_producto"])."</td>";
                                echo " <td>".htmlspecialchars($valorCamposProducto["precio_producto"])."</td>";
                                 echo " <td>".htmlspecialchars($valorCamposProducto["descripcion_producto"])."</td>";
                                echo " <td>".htmlspecialchars($valorCamposProducto["tipo"])."</td>";
                                 echo " <td>".htmlspecialchars($valorCamposProducto["nombre_categoria"])."</td>";
                                
                               
                               
                                echo"<td>";
                                    echo"<a href='" . $urlModificarProducto . "' class=btn btn-sm btn-warning>Editar</a>";
                                    echo"<a  href='" . $urlEliminarProducto . "' class=btn btn-sm btn-danger>Eliminar</a>";
                                echo"</td>";

                            echo "</tr>";
                         
                        }
                    
                }
            
            ?>
       
      </tbody>
    </table>
    <?php 
         echo "<div class='text-center mt-4'>";
                        echo "<a href='../añadirProductoAdmin.php' class='btn btn-success'>Añadir Producto</a>";
                    echo "</div>";
                   
    ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
