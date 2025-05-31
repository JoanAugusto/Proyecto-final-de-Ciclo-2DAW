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
		 require './seccionesAdmin/gestionProductosAdmin.php';
		
		
		
		
		// Obtengo las variables
		$id_producto =$_REQUEST['id_producto'];
			 
		$consultaProducto = "DELETE FROM producto WHERE id_producto='$id_producto';";
		
		$resul = $conn->query($consultaProducto);	
		
		if (!$resul){
			echo('<p> No se ha podido eliminar el producto </p>');
            header("Location:./seccionesAdmin/gestionProductosAdmin.php");
		}else{
			echo('<p> Se acaba de eliminar el producto seleccionado </p>');
		};

		

		?>	
</body>
</html>  