<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
       require_once '../db/conectionDB.php';
                        require_once '../includesAdmin/OrderFlowBDAdmin.php';
    ?>

   <?php 
        // $IdEmpleado=$_REQUEST["id_empleado"];
         $contrasenaEmpleado=$_REQUEST["contrasena_empleado"];
          $nombreEmpleado=$_REQUEST["nombre_empleado"];
           $apellidoEmpleado=$_REQUEST["apellido_empleado"];
            $numeroEmpleado=$_REQUEST["numero_telefono_empleado"];
             $correoEmpleado=$_REQUEST["correo_empleado"];
              $rolEmpleado=$_REQUEST["rol_empleado"];
              $EsAdminEmpleado=$_REQUEST["es_admin"];
            //   $IdJefe=$_REQUEST['id_jefe'];

              $consultaAñadirEmpleado="INSERT INTO empleado (contrasena_empleado,nombre_empleado,apellido_empleado,numero_telefono_empleado,correo_empleado,rol_empleado,es_admin) VALUES 
              ('$contrasenaEmpleado', '$nombreEmpleado', '$apellidoEmpleado', '$numeroEmpleado', 
              '$correoEmpleado', '$rolEmpleado', '$EsAdminEmpleado');";

              $resultadoAñadirEmpleado= $conn->query($consultaAñadirEmpleado);

              if(!$resultadoAñadirEmpleado){
                echo "No se ha podido añadir al nuevo empleado";
               header("Location: gestionEmpleadosAdmin.php");
               exit;

              }else{
                 echo "<h1>Se ha añadido nuevo empleado correctamente</h1>";
              }
    
   ?>
</body>
</html>