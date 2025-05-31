<?php 
//establecer conexion con el require 
    require_once '../db/conectionDB.php';
                        require_once '../includesAdmin/OrderFlowBDAdmin.php';
    error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
		 require './seccionesAdmin/gestionEmpleadosAdmin.php';
		
		
		
		
		// Obtengo las variables
		$id_empleado =$_REQUEST['id_empleado'];
			 
		$consultaEmpleado = "DELETE FROM empleado WHERE id_empleado='$id_empleado';";
		
		$resul = $conn->query($consultaEmpleado);	
		
		if (!$resul){
			echo('<p> No se ha podido eliminar el empleado </p>');
		}else{
			echo('<p> Se acaba de eliminar el empleado seleccionado </p>');
		};

		

		?>	
</body>
</html>