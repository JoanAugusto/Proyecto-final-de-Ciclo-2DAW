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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body class="bg-light">
    <?php include '../includesFrontend/Navbar.php'; ?>
    <?php 
    $id = isset($_GET['id_mesa']) ? $_GET['id_mesa'] : null;
   
    //acceder a los datos de $_session
    $CamareroID=$_SESSION['id_empleado'];
    
   $id_comanda=abrir_mesa($conn,$id,$CamareroID);
  
?>

    <!-- Encabezado con botón de volver y título -->
    <div class="container d-flex align-items-center justify-content-between my-3">
        <a href="javascript:history.back()" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
        <div class="h5 mb-0">Mesa <?php echo "$id"; ?></div>
    </div>

    <!-- Scroll horizontal de categorías -->
    <form id="formZona" class="container d-flex justify-content-center" method="POST"> 
        <input type="hidden" name="categoria_seleccionada" id="categoriaSeleccionadaInput">
        <div class="d-flex flex-nowrap overflow-auto mb-4 px-2">
            <?php
            $categoriasMenuApuntar = load_menus($conn);
            if ($categoriasMenuApuntar === false) {
                echo "<div class='alert alert-danger text-center'>Error al conectar con la base de datos</div>"; 
            } else {
                foreach ($categoriasMenuApuntar as $categoriasMn) {
                    $seleccionCategorias = htmlspecialchars($categoriasMn['id_categoria']);
                    echo "<button type='submit' name='categoria_seleccionada' value='$seleccionCategorias' class='btn btn-outline-warning me-3 px-4 py-2 fs-5 rounded-pill flex-shrink-0'>$categoriasMn[nombre_categoria]</button>";
                }
            }
            ?>
        </div>
    </form>

    <!-- Contenedor de productos en grid -->
    <div class="container">
        <div class="row g-3">
           <?php 
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoria_seleccionada'])){
                $categoriaSeleccionada = $_POST['categoria_seleccionada'];
                $productosCategorias = load_productos_segun_menu($conn, $categoriaSeleccionada);

                if($productosCategorias === false){
                    echo "<div class='alert alert-danger text-center'>Error al conectar con la base de datos</div>";
                } else {
                    foreach($productosCategorias as $pcategorias){
                        $nombreProducto = $pcategorias['nombre_producto'];
                        $precioProducto = $pcategorias['precio_producto'];
                        $idProducto = $pcategorias['id_producto'];

                        if($precioProducto > 0){
                            echo "   
                            <div class='col-12 col-sm-6 col-md-4'>
                                <div class='border rounded p-3 bg-white h-100 d-flex flex-column justify-content-between'>
                                    <div class='mb-2 text-center'>
                                        <img src='https://via.placeholder.com/100' class='img-fluid' alt=''>
                                    </div>
                                    <div class='mb-1 fw-semibold text-center'>$nombreProducto</div>
                                    <div class='mb-2 text-center text-success fw-bold'>€$precioProducto</div>
                                    <div class='text-center mt-auto'>
                                    
                                        <form action='anadirProducto.php' method='POST' class='d-flex justify-content-center'>
                                            <input type='hidden' name='id_mesa' value='$id'>
                                            <input type='hidden' name='id_producto' value='$idProducto'>
                                            <input name='cantidad' type='number' min='1' value='1' class='form-control form-control-sm w-50 me-2'>
                                            <button type='submit' class='btn btn-sm btn-outline-primary rounded-pill'>
                                                <i class='bi bi-plus-lg'></i> Añadir
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            ";
                        }
                    }
                }
            }
        ?>

        </div>
    </div>

    <?php
   
        $mandarids="checkout.php?id_mesa=".$id."id_empleado=".$CamareroID."id_comanda=".$id_comanda;
    ?>
    <!-- Resumen e ir a siguiente -->
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center border rounded p-3 bg-white">
            <div>
                <div class="fw-bold">Items: 3</div>
                <div class="text-success">Total: €7.50</div>
            </div>
            <a href="checkout.php" class="btn btn-warning rounded-pill px-4 fw-semibold">
                Continuar
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- Bootstrap Icons (opcional, para los íconos usados) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>
</html>
