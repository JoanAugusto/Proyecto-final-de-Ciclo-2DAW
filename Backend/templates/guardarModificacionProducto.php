<?php 
    /* comprueba que el usuario haya abierto sesión o redirige */
    
    require_once './includes/OrderFlowBDAdmin.php';
    require_once './conectionDB.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modificar Guardar Producto</title>     
</head>
<body>
    <?php 
    require './seccionesAdmin/gestionProductosAdmin.php'; // carga la sección que uses para mostrar algo (igual que tú con mesas)
     
    // Obtengo las variables del formulario
    $id_producto = $_REQUEST['id_producto'];
    $nombre_producto = $_REQUEST['nombre_producto'];
    $precio_producto = $_REQUEST['precio_producto'];
    $descripcion_producto = $_REQUEST['descripcion_producto'];
    $tipo = $_REQUEST['tipo'];
    $id_categoria = $_REQUEST['id_categoria'];

    // Construyo la consulta UPDATE (sin hacer nada raro, igual que tú)
            $consultaActualizarProducto = "UPDATE producto SET 
            nombre_producto = '$nombre_producto',
                precio_producto = '$precio_producto',
                descripcion_producto = '$descripcion_producto',
                tipo = '$tipo',
                id_categoria = '$id_categoria'
            WHERE id_producto = '$id_producto';
        ";


    // Ejecuto la consulta
    $resultadoProductoConsulta = $conn->query($consultaActualizarProducto);

    // Muestro resultado
    if (!$resultadoProductoConsulta) {
        echo '<p>No se ha podido guardar la modificación del producto.</p>';
        header("Location: gestionProductosAdmin.php");
    } else {
        echo '<p>Producto actualizado correctamente.</p>';
    }

    ?>
</body>
</html>
