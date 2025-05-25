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
         $zonaMesaAdmin=$_REQUEST["zona_mesa"];
          $estadoMesaAdmin=$_REQUEST["estado_mesa"];
           
           
            

              $consultaAñadirMesa="INSERT INTO mesa (zona_mesa , estado_mesa) VALUES ('$zonaMesaAdmin','$estadoMesaAdmin');";

              $resultadoAñadirMesa= $conn->query($consultaAñadirMesa);

              if(!$resultadoAñadirMesa){
                echo "No se ha podido añadir la nueva mesa";
               header("Location: gestionMesasAdmin.php");
               exit;

              }else{
                 echo "<h1>Se ha añadido la nueva mesa correctamente</h1>";
              }
    
   ?>
</body>
</html>