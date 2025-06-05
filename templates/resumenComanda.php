<?php
include_once '../db/conectionDB.php';
include_once '../includesFrontend/orderFlowBD.php';
include_once '../sesiones.php';
comprobar_sesion();
?>
<?php
    $id_mesaURL = $_GET['id_mesa'] ?? null;
    $id_empleadoURL = $_GET['id_empleado'] ?? null;
    $id_comandaURL = $_GET['id_comanda'] ?? null;
    session_start();
    $nombre_empleado=$_SESSION['nombre_empleado'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Resumen Comanda Mesa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>
<body class="bg-light">
    <?php include '../includesFrontend/Navbar.php'; ?>

    <div class="container my-4">
        <a href="./zonaApuntaComandas.php" class="btn btn-outline-secondary mb-3">
             Volver a toma de comanda
        </a>

        <?php
            echo"<h3 class='mb-3 text-center'>Mesa [nº $id_mesaURL] - Camarero:$nombre_empleado</h3>";
        ?>

        <!-- Si no hay productos -->
        <!-- <div class="alert alert-info text-center">No hay productos añadidos en la comanda.</div> -->

        <!-- Si hay productos -->
        <table class="table table-striped bg-white rounded shadow-sm">
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Nombre Producto</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ejemplo de fila -->
                <?php
                    $loadLineasConProductos=load_lineas_comanda_con_productos($conn,$id_comandaURL);

                    if($loadLineasConProductos=== FALSE){
                        echo "";                    
                    }else{
                        foreach ($loadLineasConProductos as $lcProductos){
                            echo "
                                <tr>
                                    <td>$lcProductos[unidades]</td>
                                    <td>$lcProductos[nombre_producto]</td>
                                    <td>$lcProductos[precio_producto]</td>
                                    <td>
                                        <form action='eliminarUnidadLinea.php' method='POST' style='display:inline;'>
                                            <input type='hidden' name='id_linea' value='1' />
                                            <button type='submit' class='btn btn-sm btn-danger' title='Eliminar 1 unidad'>&minus;</button>
                                        </form>
                                    </td>
                                </tr>
                            ";
                        }
                    }
                ?>
                <!-- Repetir tantas filas como productos haya -->
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <?php
                     $totalProductosLinea=count(load_lineas_comanda_con_productos($conn,$id_comandaURL));
                    echo"
                   
                         <strong>Total items:</strong>$totalProductosLinea<br/>
                        <strong>Total a pagar:</strong> €[total]
                    ";
                ?>
               
            </div>
            <div>
                <form action="vaciarComanda.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id_comanda" value="[id_comanda]" />
                    <button type="submit" class="btn btn-outline-danger me-2">Borrar todo</button>
                </form>
                <form action="enviarComandas.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id_comanda" value=<?php echo $id_comandaURL; ?> />
                    <input type="hidden" name="nombre_empleado" value=<?php echo $nombre_empleado; ?> />
                    <input type="hidden" name="id_mesa" value=<?php echo $id_mesaURL; ?> />
                    <button type="submit" class="btn btn-success">Enviar comanda</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
