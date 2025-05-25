<?php 
//establecer conexion con el require 
    require './conectionDB.php';
    require_once './includes/OrderFlowBDAdmin.php';
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
		 require './seccionesAdmin/gestionMesasAdmin.php';
		
		
		
		
		// Obtengo las variables
		$id_mesa =$_REQUEST['id_mesa'];
			 
		$consultaMesa = "DELETE FROM mesa WHERE id_mesa='$id_mesa';";
		
		$resul = $conn->query($consultaMesa);	
		
		if (!$resul){
			echo('<p> No se ha podido eliminar el empleado </p>');
            header("Location:./seccionesAdmin/gestionMesasAdmin.php");
		}else{
			echo('<p> Se acaba de eliminar la mesa seleccionado </p>');
		};

		

		?>	
</body>
</html>  