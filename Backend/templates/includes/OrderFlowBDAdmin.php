<?php
    include '../conectionDB.php';
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

    function load_mesas($conn){
        $consultaMesa="SELECT * FROM mesa";
        $resultadoMesa=$conn->query($consultaMesa);

            if(!$resultadoMesa || $resultadoMesa->rowCount() === 0){
                return FALSE;
            }
          return $resultadoMesa->fetchAll(PDO::FETCH_ASSOC);   
    }

    function load_productos($conn) {
    $consulta = "
        SELECT 
            p.id_producto,
            p.imagen_producto,
            p.precio_producto,
            p.seccion_menu,
            p.tipo,
            
            -- Datos de barra
            b.marca,
            b.clase,
            b.tipo AS tipo_barra,
            b.tamaño,
            b.nombre_producto_barra,
            
            -- Datos de cocina
            c.nombre_cocina

        FROM producto p
        LEFT JOIN barra b ON p.id_producto = b.id_producto
        LEFT JOIN cocina c ON p.id_producto = c.id_producto
        ORDER BY p.id_producto ASC
    ";

    $resultado = $conn->query($consulta);

    if (!$resultado || $resultado->rowCount() === 0) {
        return false;
    }

    return $resultado->fetchAll(PDO::FETCH_ASSOC);
}


?>

