<?php
   
    include './conectionDB.php';
    
    error_reporting(0);
    
   
    
//   funcion para hacer cargar a de la tabla de empleados


    function load_empleados($conn){
        
        $consulta="SELECT * FROM empleado";
        $resultadoEmpleados= $conn->query($consulta);

        if(!$resultadoEmpleados || $resultadoEmpleados->rowCount()===0){
            return FALSE;
        }

         // Obtener todos los resultados como array asociativo
        return $resultadoEmpleados->fetchAll(PDO::FETCH_ASSOC);

    }

    function load_empleado($conn,$id_empleado){

	

	$consultaEmpleado="SELECT * FROM empleado WHERE id_empleado='".$id_empleado."';";
	$empleado = $conn->query($consultaEmpleado);

	if (!$empleado) {
		return FALSE;
	}
	if ($empleado->rowCount() === 0) {    
		return FALSE;
    }

	 return $empleado->fetch(PDO::FETCH_ASSOC);

}
    function load_mesa($conn,$id_mesa ){

        

        $consultaMesa="SELECT * FROM mesa WHERE id_mesa='".$id_mesa."';";
        $mesa = $conn->query($consultaMesa);

        if (!$mesa) {
            return FALSE;
        }
        if ($mesa->rowCount() === 0) {    
            return FALSE;
        }

        return $mesa->fetch(PDO::FETCH_ASSOC); //solo devuelve una mesa no todo y si usamos fetchall devuelve todas las filas

    }
         function load_mesa_por_zona($conn,$zonamesa ){

        

        $consultaMesaZona="SELECT * FROM mesa WHERE zona_mesa='".$zonamesa."';";
        $mesa = $conn->query($consultaMesaZona);

        if (!$mesa) {
            return FALSE;
        }
        if ($mesa->rowCount() === 0) {    
            return FALSE;
        }

        return $mesa->fetchAll(PDO::FETCH_ASSOC); //solo devuelve una mesa no todo y si usamos fetchall devuelve todas las filas

    }
        //Para mostrar todas las zonas de las mesas sin que se repita usando distinct

        function load_zona_mesa_not_repeater($conn){
            $consultaZonaMesa="SELECT DISTINCT zona_mesa FROM mesa;";
            $zonaMesa =$conn->query($consultaZonaMesa);

                if(!$zonaMesa){
                    return FALSE;
                }
                if($zonaMesa->rowCount()===0){
                    return FALSE;
                }

                return $zonaMesa->fetchAll(PDO::FETCH_ASSOC);
        }
    function load_menu($conn,$id_categoria ){

        

        $consultaMenu="SELECT * FROM categoria_menu  WHERE id_categoria='".$id_categoria."';";
        $menu = $conn->query($consultaMenu);

        if (!$menu) {
            return FALSE;
        }
        if ($menu->rowCount() === 0) {    
            return FALSE;
        }

        return $menu->fetch(PDO::FETCH_ASSOC);

    }
    function load_enum_empleados($conn, $table, $column){
                
            $query = "SHOW COLUMNS FROM `$table` LIKE '$column'";
            $stmt = $conn->query($query);

            if (!$stmt) {
                return false;
            }

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$row || !isset($row['Type'])) {
                return false;
            }

            // Extraer los valores del ENUM usando regex
            preg_match("/^enum\((.*)\)$/", $row['Type'], $matches);

            if (!isset($matches[1])) {
                return false;
            }

            // Convertir la cadena a array y limpiar comillas
            $enum_values = explode(",", $matches[1]);
            $enum_values = array_map(function($value) {
                return trim($value, " '");
            }, $enum_values);

            return $enum_values;
    }



    function load_mesas($conn){
        $consultaMesa="SELECT * FROM mesa";
        $resultadoMesa=$conn->query($consultaMesa);

            if(!$resultadoMesa || $resultadoMesa->rowCount() === 0){
                return FALSE;
            }
          return $resultadoMesa->fetchAll(PDO::FETCH_ASSOC);   
    }
    function load_menus($conn){
        $consultaMenu="SELECT * FROM categoria_menu";
        
        $resultadoMenu=$conn->query($consultaMenu);

            if(!$resultadoMenu || $resultadoMenu->rowCount() === 0){
                return FALSE;
            }
          return $resultadoMenu->fetchAll(PDO::FETCH_ASSOC);   
    }
    

    function load_productos($conn) {
    $consultaProductos = "
                    SELECT 
            p.id_producto,
            p.nombre_producto,
            p.imagen_producto,
            p.precio_producto,
            p.descripcion_producto,
            p.tipo,
            c.nombre_categoria
        FROM 
            producto p
        JOIN 
            categoria_menu c ON p.id_categoria = c.id_categoria;
        "
        ;

    $resultado = $conn->query($consultaProductos);

    if (!$resultado || $resultado->rowCount() === 0) {
        return false;
    }

    return $resultado->fetchAll(PDO::FETCH_ASSOC);
}
    function load_producto($conn, $id_producto){
    $consultaProductos = "
        SELECT 
            p.id_producto,
            p.nombre_producto,
            p.precio_producto,
            p.descripcion_producto,
            p.tipo,
            c.nombre_categoria,
            p.id_categoria
        FROM 
            producto p
        JOIN 
            categoria_menu c ON p.id_categoria = c.id_categoria
        WHERE
            p.id_producto = '" . $id_producto . "'";

    $resultado = $conn->query($consultaProductos);

    if (!$resultado || $resultado->rowCount() === 0) {
        return false;
    }

    // CAMBIO AQUÍ: fetch en lugar de fetchAll para que te devuelva un solo producto, no un array de arrays
    return $resultado->fetch(PDO::FETCH_ASSOC);
}



?>

