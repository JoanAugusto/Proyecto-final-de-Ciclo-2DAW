<?php 
	/*comprueba que el usuario haya abierto sesión o redirige*/
	
	require_once '../db/conectionDB.php';
                        require_once '../includesAdmin/OrderFlowBDAdmin.php';
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Modificar Guardar Menu</title>		
	</head>
	<body>
		<?php 
		require './seccionesAdmin/gestionMenuAdmin.php';
		 
		
		// Obtengo las variables
		$IDcategoria =$_REQUEST['id_categoria'];
        $nombreCategoria=$_REQUEST['nombre_categoria'];
		
		
		
	 
		$consultaActualizarMenu = "UPDATE categoria_menu SET  nombre_categoria='$nombreCategoria' WHERE id_categoria ='$IDcategoria';";
		
		$resultadoMenuConsulta = $conn->query($consultaActualizarMenu);	
		
		if (!$resultadoMenuConsulta){
			echo('<p> No se ha podido guardar la modificación </p>');
		}else{
			echo('<p> Se acaba de actualizar el  menu</p>');
		};

		

		?>	


		

		
	</body>
</html>