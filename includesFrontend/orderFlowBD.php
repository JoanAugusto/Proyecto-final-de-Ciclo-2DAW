<?php
   
    include __DIR__. './conectionDB.php';
    
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
    function load_empleados_Comprobacion_login($correoEmpleado, $contraseñaEmpleado,$conn){
        $consultaLoginUser="SELECT correo_empleado,contrasena_empleado,rol_empleado, id_empleado FROM empleado WHERE correo_empleado='$correoEmpleado' 
                            AND contrasena_empleado='$contraseñaEmpleado';";

        $resultadoLogin=$conn->query($consultaLoginUser);

        if($resultadoLogin->rowCount()===1){
            return $resultadoLogin->fetch();
        }else{
            return FALSE;
        }

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


    function load_productos_tipo_segun_id($conn,$id_producto){
        $consultaProductosTipo="SELECT tipo_producto FROM producto WHERE id_producto = '".$id_producto."';";
        
        $resultadoProductosTipo=$conn->query($consultaProductosTipo);

            if(!$resultadoProductosTipo || $resultadoProductosTipo->rowCount() === 0){
                return FALSE;
            }
          return $resultadoProductosTipo->fetchAll(PDO::FETCH_ASSOC);   
    }
    function add_producto_linea_Comanda($conn,$IDComanda,$IDProducto,$cantidadProducto,$TipoProducto){
        $añadirLineas = "
            INSERT INTO linea_comanda (tipo_lineacomanda, numero_lineas, unidades, id_producto, id_comanda)
            VALUES ('$TipoProducto', 1, $cantidadProducto, $IDProducto, $IDComanda)
        ";
        
        $lanzarPeticionLinea=$conn->query($añadirLineas);

            if(!$lanzarPeticionLinea || $lanzarPeticionLinea->rowCount() === 0){
                return FALSE;
            }
          return True;   
    }
    function load_productos_segun_menu($conn,$id_categorias){
        $consultaProductosCategorias="SELECT * FROM producto WHERE id_categoria='".$id_categorias."'";
        
        $resultadoProductosCategorias=$conn->query($consultaProductosCategorias);

            if(!$resultadoProductosCategorias || $resultadoProductosCategorias->rowCount() === 0){
                return FALSE;
            }
          return $resultadoProductosCategorias->fetchAll(PDO::FETCH_ASSOC);   
    }


        function load_busca_comandas_abierta($conn,$id_mesas){
            $consultaComandasAbiertas="SELECT id_comanda FROM comanda WHERE id_mesa='".$id_mesas."';";
            $resultadoComandasAbiertas=$conn->query($consultaComandasAbiertas);

            
            if(! $resultadoComandasAbiertas ||  $resultadoComandasAbiertas->rowCount() === 0){
                return FALSE;
            }
          return  $resultadoComandasAbiertas->fetchAll(PDO::FETCH_ASSOC);   
        }

            function load_crear_comanda_nueva($conn,$id_mesa,$id_empleado){
                  $consultaAñadirComandas="INSERT INTO comanda (estado_comanda,fecha_hora,id_empleado,id_mesa) VALUES ('en cola',NOW(),$id_empleado,$id_mesa);";
                    $resultadoAñadirComandas=$conn->query($consultaAñadirComandas);

            
                if(! $resultadoAñadirComandas ||  $resultadoAñadirComandas->rowCount() === 0){
                    return FALSE;
                }
                     return $conn->lastInsertId();   
            }

             function abrir_mesa($conn, $id_mesa, $id_empleado) {
                // 1. Buscar si ya hay comanda abierta en esa mesa
                $comanda_existente = load_busca_comandas_abierta($conn, $id_mesa);

                if ($comanda_existente !== FALSE && count($comanda_existente) > 0) {
                    // Ya hay comanda abierta
                    $id_comanda = $comanda_existente[0]['id_comanda'];
                } else {
                    // No hay comanda, creamos una nueva
                    $id_comanda = load_crear_comanda_nueva($conn, $id_mesa, $id_empleado);
                }

                return $id_comanda; // Devolver ID comanda activa o recién creada
            }

                // LINEA COMANDA

                function load_lineas_comanda_con_productos($conn, $id_comanda){
                $consulta = "
                    SELECT 
                        lc.id_lineacomanda,
                        lc.tipo_lineacomanda,
                        lc.numero_lineas,
                        lc.unidades,
                        lc.estado_lineacomanda,
                        lc.id_comanda,
                        p.nombre_producto,
                        p.precio_producto,
                        p.descripcion_producto
                    FROM 
                        linea_comanda lc
                    INNER JOIN 
                        producto p ON lc.id_producto = p.id_producto
                    WHERE 
                        lc.id_comanda = '$id_comanda';
                ";

                $resultado = $conn->query($consulta);

                if (!$resultado || $resultado->rowCount() === 0) {
                    return false;
                }

                return $resultado->fetchAll(PDO::FETCH_ASSOC);
            }

        // FUNCIONES PRODUCTOS

        function load_producto_linea_Comanda_Segun_id_producto($conn,$id_producto){
            $consultaObtenerProductos="
                SELECT 
                    lc.id_lineacomanda,
                    lc.tipo_lineacomanda,
                    lc.unidades,
                    lc.estado_lineacomanda,
                    p.nombre_producto,
                    p.descripcion_producto

                FROM
                    linea_comanda lc
                INNER JOIN
                    producto p ON lc.id_producto = p.id_producto
                WHERE
                    lc.id_producto = '$id_producto';
            
            
            ";

            $resultadoObtenerProductos= $conn->query($consultaObtenerProductos);

            if(!$resultadoObtenerProductos || $resultadoObtenerProductos->rowCount()===0){
                return false;
            }

            return $resultadoObtenerProductos->fetchAll(PDO::FETCH_ASSOC);
        }

        function load_comandas_segun_zona_mesa($conn, $zonaMesa) {
    $zonaMesa = $conn->quote($zonaMesa);

    // 1. Sacamos las comandas de esa zona
    $consultaComandaMesa = "
        SELECT 
            comanda.id_comanda,
            comanda.estado_comanda,
            comanda.fecha_hora,
            comanda.id_empleado,
            mesa.id_mesa,
            mesa.zona_mesa
        FROM comanda
        JOIN mesa ON comanda.id_mesa = mesa.id_mesa
        WHERE mesa.zona_mesa = $zonaMesa
    ";

    $resultadoComandaMesa = $conn->query($consultaComandaMesa);

    if (!$resultadoComandaMesa || $resultadoComandaMesa->rowCount() === 0) {
        return false;
    }

    $comandas = $resultadoComandaMesa->fetchAll(PDO::FETCH_ASSOC);

    // 2. Para cada comanda, sacamos sus productos asociados
    foreach ($comandas as &$comanda) {
        $idComanda = $comanda['id_comanda'];

        $consultaProductos = "
            SELECT 
                producto.nombre_producto,
                producto.tipo,
                producto.precio_producto,
                producto.descripcion_producto,
                linea_comanda.unidades,
                linea_comanda.estado_lineacomanda
            FROM linea_comanda
            JOIN producto ON linea_comanda.id_producto = producto.id_producto
            WHERE linea_comanda.id_comanda = $idComanda
        ";

        $resultadoProductos = $conn->query($consultaProductos);

        if ($resultadoProductos && $resultadoProductos->rowCount() > 0) {
            $comanda['productos'] = $resultadoProductos->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $comanda['productos'] = [];
        }
    }

    return $comandas;
}

?>

