<?php 
	/*comprueba que el usuario haya abierto sesión o redirige*/
	
	require_once '../db/conectionDB.php';
                        require_once '../includesAdmin/OrderFlowBDAdmin.php';
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Modificar Guardar Empleado</title>		
	</head>
	<body>
		<?php 
		require './seccionesAdmin/gestionEmpleadosAdmin.php';
		 
		
		// Obtengo las variables
		$IDempleado =$_REQUEST['id_empleado'];
        $nombreEmpleado=$_REQUEST['nombre_empleado'];
		$contrasenaEmpleado =$_REQUEST['contrasena_empleado'];
		$apellidoEmpleado = $_REQUEST['apellido_empleado'];
		$numeroEmpleado = $_REQUEST['numero_telefono_empleado'];
		$correoEmpleado = $_REQUEST['correo_empleado'];
		$rolEmpleado = $_REQUEST['rol_empleado'];
        $EsAdmin = $_REQUEST['es_admin'];
        $IDjefe = $_REQUEST['id_jefe'];
	 
		$consultaActualizarEmpleado = "UPDATE empleado SET contrasena_empleado='$contrasenaEmpleado', nombre_empleado='$nombreEmpleado',  apellido_empleado='$apellidoEmpleado',  numero_telefono_empleado='$numeroEmpleado',   correo_empleado='$correoEmpleado' ,  rol_empleado='$rolEmpleado' , es_admin='$EsAdmin'  WHERE id_empleado='$IDempleado';";
		
		$resultadoEmpleado = $conn->query($consultaActualizarEmpleado);	
		
		if (!$resultadoEmpleado){
			echo('<p> No se ha podido guardar la modificación realizada </p>');
		}else{
			echo('<p> Se acaba de actualizar los productos modificados </p>');
		};

		

		?>	


		

		
	</body>
</html>