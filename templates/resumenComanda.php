<?php
session_start();

include_once '../db/conectionDB.php';
include_once '../includesFrontend/orderFlowBD.php';
include_once '../sesiones.php';

comprobar_sesion();


// Obtener datos de la URL y de sesión
$id_mesaURL     = isset($_GET['id_mesa'])     ? intval($_GET['id_mesa'])     : null;
$id_empleadoURL = isset($_GET['id_empleado']) ? intval($_GET['id_empleado']) : null;
$id_comandaURL  = isset($_GET['id_comanda'])  ? intval($_GET['id_comanda'])  : null;

$nombre_empleado = $_SESSION['nombre_empleado'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Resumen Comanda Mesa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          crossorigin="anonymous" />
</head>
<body class="bg-light">
    <?php include '../includesFrontend/Navbar.php'; ?>

    <div class="container my-4">
        <a href="./zonaApuntaComandas.php" class="btn btn-outline-secondary mb-3">
            &larr; Volver a toma de comanda
        </a>
        <h3 class="mb-3 text-center">
            Mesa [nº <?php echo htmlspecialchars($id_mesaURL); ?>] – Camarero: <?php echo htmlspecialchars($nombre_empleado); ?>
        </h3>

        <!-- Tabla de líneas de comanda -->
        <table class="table table-striped bg-white rounded shadow-sm">
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Nombre Producto</th>
                    <th>Subtotal (€)</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
               <?php
                    $lineas = load_lineas_comanda_con_productos($conn, $id_comandaURL);
                    if ($lineas !== FALSE) {
                        foreach ($lineas as $lc) {
                    ?>
                        <tr>
                            <td><?= $lc['unidades'] ?></td>
                            <td><?= htmlspecialchars($lc['nombre_producto']) ?></td>
                            <td>€<?= number_format($lc['precio_producto'], 2) ?></td>
                            <td>
                                <form action="eliminarUnidades.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id_linea" value="<?= $lc['id_lineacomanda'] ?>" />
                                    <input type="hidden" name="id_mesa" value="<?= $id_mesaURL ?>" />
                                    <input type="hidden" name="id_comanda" value="<?= $id_comandaURL ?>" />
                                    <input type="hidden" name="id_empleado" value="<?= $id_empleadoURL ?>" />
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar 1 unidad">&minus;</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                        }
                    }
?>

            </tbody>
        </table>

        <!-- Totales y botón “Enviar comanda” -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <?php
                $totalItems = count($lineas ?: []);
                // Para calcular total a pagar, podrías hacer un sumatorio real:
                $totalPagar = 0;
                if ($lineas !== FALSE) {
                    foreach ($lineas as $lc) {
                        $totalPagar += $lc['precio_producto'] * $lc['unidades'];
                    }
                }
                echo "
                    <strong>Total items:</strong> {$totalItems}<br/>
                    <strong>Total a pagar:</strong> €" . number_format($totalPagar, 2) . "
                ";
                ?>
            </div>
            <div>
                <form action="borrarComandaCompleta.php" method="POST" style="display:inline;">
                <input type="hidden" name="id_linea" value="<?= $lc['id_lineacomanda'] ?>" />
                                    
                                 
                                    <input type="hidden" name="id_mesa" value="<?= $id_mesaURL ?>" />
                                    <input type="hidden" name="id_comanda" value="<?= $id_comandaURL ?>" />
                                    <input type="hidden" name="id_empleado" value="<?= $id_empleadoURL ?>" />
                                   
                                   
                                        <button type="submit" class="btn btn-outline-danger me-2">Borrar todo</button>
                </form>

                <!-- Este formulario se intercepta en JS -->
                <form id="formEnviarComanda" method="POST" style="display:inline;">
                    <input type="hidden" name="id_comanda"     value="<?php echo $id_comandaURL; ?>" />
                    <input type="hidden" name="nombre_empleado" value="<?php echo htmlspecialchars($nombre_empleado); ?>" />
                    <input type="hidden" name="id_mesa"         value="<?php echo $id_mesaURL; ?>" />
                    <button type="submit" class="btn btn-success">Enviar comanda</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Se incluye el JS que evita recarga y hace fetch -->
    <script src="../js/formaEvitarRecargaNavegador.js"></script>
</body>
</html>
