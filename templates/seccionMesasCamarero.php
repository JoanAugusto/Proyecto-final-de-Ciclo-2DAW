<?php
  include_once '../db/conectionDB.php';
  include_once '../includesFrontend/orderFlowBD.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mesas del Bar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body class="bg-light">

  <?php
    require '../includesFrontend/Navbar.php';
  ?>

  <!-- ZONAS DE MESAS -->
  <div class="container py-4 ">
    <h2 class="text-center mb-4 fw-bold text-dark">ZONA DE MESAS</h2>

    <!-- Scroll horizontal de zonas -->
    <form id="formZona" class="container d-flex justify-content-center" method="POST"> 
      <input type="hidden" name="zona_seleccionada" id="zonaSeleccionadaInput">
      <div class="d-flex flex-nowrap overflow-auto gap-3 mb-4 px-2">
        <?php
          $zonasMesas = load_zona_mesa_not_repeater($conn);
          if ($zonasMesas === false) {
              echo "<div class='alert alert-danger text-center'>Error al conectar con la base de datos</div>"; 
          } else {
              foreach ($zonasMesas as $valorZona) {
                  $zona = htmlspecialchars($valorZona['zona_mesa']);
                  echo "<button type='submit' name='zona_seleccionada' value='$zona' class='btn btn-warning btn-lg rounded-pill shadow-sm px-4'>$valorZona[zona_mesa]</button>";
              }
          }
        ?>
      </div>
    </form>

    <!-- MESAS -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
      <?php
        if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['zona_seleccionada'])){
          $zonaSeleccionada=$_POST['zona_seleccionada'];

          $mesasZona=load_mesa_por_zona($conn,$zonaSeleccionada);

          if($mesasZona===false){
            echo "<div class='alert alert-danger text-center'>Error al conectar con la base de datos</div>";
          }else{
            foreach($mesasZona as $zonamesitas){
              $urlMesaID="./zonaApuntaComandas.php?id_mesa=".$zonamesitas['id_mesa'];
              
              echo "<div class='col'>
                      <div class='card h-100 border-0 shadow rounded-4 text-center'>
                        <div class='card-body'>
                          <h5 class='card-title fw-bold'>Mesa {$zonamesitas['id_mesa']}</h5>
                          <p class='card-text text-success fw-semibold'>{$zonamesitas['estado_mesa']}</p>
                          <a href='".$urlMesaID."' class='btn btn-outline-success rounded-pill px-4'>Seleccionar</a>
                        </div>
                      </div>
                    </div>";
            }
          }
        }
      ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
