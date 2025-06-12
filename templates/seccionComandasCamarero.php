<?php
  require_once '../db/conectionDB.php';
  require_once '../includesFrontend/orderFlowBD.php';
  require_once '../sesiones.php';
  comprobar_sesion();
  
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sección Comandas Camarero</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column ">

  <?php
      require '../includesFrontend/Navbar.php';
  ?>

  <!-- ZONAS -->
<div class="d-flex flex-column w-100 ">


        <div class="container mt-5 d-flex flex-column align-items-center">
          <h3 class="text-center mb-4">Elige una zona para ver las comandas</h3>
          <form id="formZona" class="container d-flex justify-content-center" method="POST"> 
            <input type="hidden" name="zona_seleccionada" id="zonaSeleccionadaInput">
              <div class="d-flex flex-nowrap overflow-auto gap-3 mb-4 px-2">
                <?php
                $zonasMesasdeComandas = load_zona_mesa_not_repeater($conn);
                if ($zonasMesasdeComandas === false) {
                    echo "<div class='alert alert-danger text-center'>Error al conectar con la base de datos</div>"; 
                } else {
                    foreach ($zonasMesasdeComandas as $valorComandaMesa) {
                        $zonaMesa = htmlspecialchars($valorComandaMesa['zona_mesa']);
                        echo "<button type='submit' name='zona_seleccionada' value='$zonaMesa' class='btn btn-warning btn-lg rounded-pill shadow-sm px-4'>$zonaMesa</button>";
                    }
                }
              ?>
              </div>

          </form>
        </div>

      

              <!-- COMANDAS -->
              <div class="container mt-5">
                <div class="row g-4 justify-content-center">
                  <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['zona_seleccionada'])) {
                      $zonaSeleccionadaMesa = $_POST['zona_seleccionada'];
                      $mesasZonaComanda = load_comandas_segun_zona_mesa($conn, $zonaSeleccionadaMesa);

                      if ($mesasZonaComanda === false) {
                        echo "<div class='alert alert-danger text-center'>Error al conectar con la base de datos</div>";
                      } else {
                        foreach ($mesasZonaComanda as $zonaComandaMesas) {
                          echo "
                          <div class='col-12 col-sm-6 col-md-4 col-lg-3'>
                            <div class='card h-100 shadow rounded-4 border-0'>
                              <div class='card-header bg-primary text-white text-center rounded-top-4'>
                                <h5 class='mb-0 fw-bold'>Comanda {$zonaComandaMesas['id_comanda']}</h5>
                              </div>
                              <div class='card-body'>
                                <p class='mb-1'><strong>Mesa:</strong> {$zonaComandaMesas['id_mesa']}</p>
                                <p class='mb-1'><strong>Camarero:</strong> {$zonaComandaMesas['id_empleado']}</p>
                                <p class='mb-1'><strong>Tiempo:</strong> {$zonaComandaMesas['fecha_hora']}</p>
                                <p class='mb-1'><strong>Pedido:</strong></p>
                                <ul class='list-unstyled ps-3'>";
                                  foreach ($zonaComandaMesas['productos'] as $producto) {
                                    echo "<li>• {$producto['unidades']} x {$producto['nombre_producto']}</li>";
                                  }
                          echo "
                                </ul>
                              </div>
                              <div class='card-footer d-flex justify-content-center gap-2 bg-light border-0'>
                              
                                <button class='btn btn-primary btn-sm text-white w-50'>Cuenta</button>
                              </div>
                            </div>
                          </div>";
                        }
                      }
                    }
                  ?>
                </div>
              </div>

              </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
