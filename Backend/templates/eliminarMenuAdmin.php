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
		 require './seccionesAdmin/gestionMenuAdmin.php';
		
		
		
		
		// Obtengo las variables
		$id_menu =$_REQUEST['id_categoria'];
			 
		$consultaMenu = "DELETE FROM categoria_menu WHERE id_categoria='$id_menu';";
		
		$resul = $conn->query($consultaMenu);	
		
		if (!$resul){
			echo('<p> No se ha podido eliminar el menu </p>');
            header("Location:./seccionesAdmin/gestionMenuAdmin.php");
		}else{
			echo('<p> Se acaba de eliminar el menu seleccionado </p>');
		};

		

		?>	
</body>
</html>  