<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Guardar Añadir Producto</title>
</head>
<body>
<?php
require_once './conectionDB.php';

// Recogemos datos del formulario
$nombre_producto = $_REQUEST['nombre_producto'];
$precio_producto = $_REQUEST['precio_producto'];
$descripcion_producto = $_REQUEST['descripcion_producto'];
$tipo = $_REQUEST['tipo'];
$id_categoria = $_REQUEST['id_categoria'];

// Consulta SQL para insertar
$consultaAñadirProducto = "INSERT INTO producto 
    (nombre_producto, precio_producto, descripcion_producto, tipo, id_categoria) 
    VALUES 
    ('$nombre_producto', $precio_producto, '$descripcion_producto', '$tipo', $id_categoria);";

// Ejecutamos la consulta
$resultadoAñadirProducto = $conn->query($consultaAñadirProducto);

if(!$resultadoAñadirProducto){
    echo "<h1>No se ha podido añadir el producto</h1>";
    // Puedes redirigir si quieres
    // header("Location: formularioAñadirProducto.php");
    // exit;
} else {
    echo "<h1>Producto añadido correctamente</h1>";
    // Redirige después de 2 segundos o muestra enlace
    echo '<a href="gestionProductosAdmin.php">Volver a gestión de productos</a>';
}
?>
</body>
</html>
