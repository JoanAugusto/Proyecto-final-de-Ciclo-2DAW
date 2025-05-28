<?php
    include_once'../includes/conectionDB.php';
    include_once'../includes/orderFlowBD.php';
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
    <?php
        include'../includes/Navbar.php';
    ?>

    <!-- Scroll horizontal de categorias -->
        
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
                          echo "<button type='submit' name='zona_seleccionada' value='$seleccionCategorias' class='btn btn-outline-warning me-3 px-4 py-2 fs-5 rounded-pill flex-shrink-0'>$categoriasMn[nombre_categoria]</button>";
                      }
                  }
                  ?>
              </div>
    </form>
    
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>