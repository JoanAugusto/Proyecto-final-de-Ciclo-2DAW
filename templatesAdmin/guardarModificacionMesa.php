<?php 
	/*comprueba que el usuario haya abierto sesión o redirige*/
	
	require_once '../db/conectionDB.php';
                        require_once '../includesAdmin/OrderFlowBDAdmin.php';
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Modificar Guardar Mesa</title>		
	</head>
	<body>
		<?php 
		require './seccionesAdmin/gestionMesasAdmin.php';
		 
		
		// Obtengo las variables
		$IDmesa =$_REQUEST['id_mesa'];
        $zonaMesa=$_REQUEST['zona_mesa'];
		$estadoMesa =$_REQUEST['estado_mesa'];
		
		
	 
		$consultaActualizarMesa = "UPDATE mesa SET zona_mesa='$zonaMesa', estado_mesa='$estadoMesa' WHERE id_mesa='$IDmesa';";
		
		$resultadoMesaConsulta = $conn->query($consultaActualizarMesa);	
		
		if (!$resultadoMesaConsulta){
			echo('<p> No se ha podido guardar la modificación </p>');
		}else{
			echo('<p> Se acaba de actualizar la mesa </p>');
		};

		

		?>	


		

		
	</body>
</html>