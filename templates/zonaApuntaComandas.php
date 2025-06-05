<?php
    include_once '../db/conectionDB.php';
    include_once '../includesFrontend/orderFlowBD.php';
    include_once '../sesiones.php';
    comprobar_sesion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Comanda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<?php include '../includesFrontend/Navbar.php'; ?>

<?php 
    $id = $_GET['id_mesa'] ?? null;
    $CamareroID = $_SESSION['id_empleado'];
    $id_comanda = abrir_mesa($conn, $id, $CamareroID);
    $_SESSION['id_comanda'] = $id_comanda;

    if (!$id_comanda) {
        die("No se ha iniciado una comanda");
    }

    // Para recordar categoría seleccionada
    $categoriaSeleccionada = $_POST['categoria_seleccionada'] ?? null;

    // Mensaje para mostrar después de agregar producto
    $mensaje = '';
?>

<!-- Encabezado -->
<div class="container d-flex align-items-center justify-content-between my-3">
    <a href="javascript:history.back()" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
    <div class="h5 mb-0">Mesa <?php echo "$id"; ?></div>
</div>

<!-- Mensaje de operación -->
<?php if (!empty($mensaje)): ?>
<div class="container">
    <div class="alert alert-<?php echo (str_contains($mensaje, 'Correctamente') ? 'success' : 'danger'); ?> text-center">
        <?php echo $mensaje; ?>
    </div>
</div>
<?php endif; ?>

<!-- Categorías -->
<form id="formZona" class="container d-flex justify-content-center" method="POST"> 
    <div class="d-flex flex-nowrap overflow-auto mb-4 px-2">
        <?php
        $categoriasMenuApuntar = load_menus($conn);
        if (!$categoriasMenuApuntar) {
            echo "<div class='alert alert-danger text-center'>Error al conectar con la base de datos</div>"; 
        } else {
            foreach ($categoriasMenuApuntar as $cat) {
                $idCat = htmlspecialchars($cat['id_categoria']);
                $nombreCat = htmlspecialchars($cat['nombre_categoria']);
                $active = ($idCat == $categoriaSeleccionada) ? 'btn-warning' : 'btn-outline-warning';
                echo "<button type='submit' name='categoria_seleccionada' value='$idCat' class='btn $active me-3 px-4 py-2 fs-5 rounded-pill flex-shrink-0'>$nombreCat</button>";
            }
        }
        ?>
    </div>
</form>

<!-- Productos -->
<div class="container">
    <div class="row g-3">
<?php
if ($categoriaSeleccionada) {
    $productosCategorias = load_productos_segun_menu($conn, $categoriaSeleccionada);

    if (!$productosCategorias) {
        echo "<div class='alert alert-danger text-center'>Error al cargar productos</div>";
    } else {
        foreach ($productosCategorias as $prod) {
            $nombre = htmlspecialchars($prod['nombre_producto']);
            $precio = htmlspecialchars($prod['precio_producto']);
            $idProd = intval($prod['id_producto']);
            $tipo = htmlspecialchars($prod['tipo']);

            if ($precio > 0) {
                echo "
                <div class='col-12 col-sm-6 col-md-4'>
                    <form method='POST' class='w-100'>
                        <div class='border rounded p-3 bg-white h-100 d-flex flex-column justify-content-between'>
                            <div class='mb-2 text-center'>
                                <img src='https://via.placeholder.com/100' class='img-fluid' alt=''>
                            </div>
                            <div class='mb-1 fw-semibold text-center'>$nombre</div>
                            <div class='mb-2 text-center text-success fw-bold'>€$precio</div>
                            <div class='text-center mt-auto'>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <input type='hidden' name='id_producto' value='$idProd'>
                                    <input type='hidden' name='id_comanda' value='$id_comanda'>
                                    <input type='hidden' name='tipo_producto' value='$tipo'>
                                    <input type='hidden' name='categoria_seleccionada' value='$categoriaSeleccionada'>

                                    <button type='button' class='btn btn-sm btn-outline-secondary me-2 btn-minus'>-</button>

                                    <input name='cantidad' type='number' min='1' value='1' class='form-control form-control-sm w-25 text-center cantidad-input'>

                                    <button type='button' class='btn btn-sm btn-outline-secondary ms-2 btn-plus'>+</button>

                                    <button type='submit' name='add_producto' class='btn btn-sm btn-outline-primary rounded-pill ms-3'>
                                        <i class='bi bi-plus-lg'></i> Añadir
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                ";
            }
        }
    }
}

// Añadir producto a la comanda
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_producto'], $_POST['id_producto'], $_POST['cantidad'])) {
    $idProductoActual = intval($_POST['id_producto']);
    $cantidad = max(1, intval($_POST['cantidad']));
    $tipoProductoActual = htmlspecialchars($_POST['tipo_producto']);
    $idComandaActual = intval($_POST['id_comanda']);

    $funcionProductosLinea = add_producto_linea_Comanda($conn, $idComandaActual, $idProductoActual, $cantidad, $tipoProductoActual);

    if ($funcionProductosLinea === true) {
        $mensaje = "Se añadió el producto correctamente";
    } else {
        $mensaje = "Se ha producido un error al añadir el producto";
    }
}
?>
    </div>
</div>

<!-- Resumen -->
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center border rounded p-3 bg-white">
        <div>
            <div class="fw-bold">Items: 3</div>
            <div class="text-success">Total: €7.50</div>
        </div>
        <a href="./resumenComanda.php?id_mesa=<?php echo $id; ?>&id_empleado=<?php echo $CamareroID; ?>&id_comanda=<?php echo $id_comanda; ?>" class="btn btn-warning rounded-pill px-4 fw-semibold">
            Continuar
        </a>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../Frontend/js/contador.js"></script>

</body>
</html>
