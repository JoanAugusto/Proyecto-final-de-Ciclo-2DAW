<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once './conectionDB.php';
        require_once './includes/OrderFlowBDAdmin.php';
    ?>

   <?php 
        // $IdEmpleado=$_REQUEST["id_empleado"];
         $IDMenu=$_REQUEST["id_categoria"];
          $nombreCategoriaMenu=$_REQUEST["nombre_categoria"];
           
           
            

              $consultaAñadirMenu="INSERT INTO categoria_menu (id_categoria , nombre_categoria) VALUES ('$IDMenu','$nombreCategoriaMenu');";

              $resultadoAñadirMenu= $conn->query($consultaAñadirMenu);

              if(!$resultadoAñadirMenu){
                echo "No se ha podido añadir el nuevo menu";
               header("Location: gestionMenuAdmin.php");
               exit;

              }else{
                 echo "<h1>Se ha añadido la nueva categoria menu</h1>";
              }
    
   ?>
</body>
</html>