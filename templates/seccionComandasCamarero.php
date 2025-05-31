<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sección Comandas Camarero</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <?php
      require '../includesFrontend/Navbar.php';
  ?>

  <!-- ZONAS -->
  <div class="container mt-5">
    <h3 class="text-center mb-4">Elige una zona para ver las comandas</h3>
    <div class="d-flex overflow-auto px-2">
      <button class="btn btn-outline-primary me-2 flex-shrink-0">Zona 1</button>
      <button class="btn btn-outline-primary me-2 flex-shrink-0">Zona 2</button>
      <button class="btn btn-outline-primary me-2 flex-shrink-0">Zona 3</button>
      <button class="btn btn-outline-primary me-2 flex-shrink-0">Zona 4</button>
      <button class="btn btn-outline-primary me-2 flex-shrink-0">Zona 5</button>
    </div>
  </div>

  <!-- COMANDAS -->
  <div class="container mt-5">
    <div class="row g-4 justify-content-center">
      <!-- Comanda ejemplo -->
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card h-100">
          <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Comanda 01</h5>
          </div>
          <div class="card-body">
            <p><strong>Mesa:</strong> 5</p>
            <p><strong>Camarero:</strong> Juan</p>
            <p><strong>Pedido:</strong> 2 x Coca-Cola, 1 x Hamburguesa</p>
          </div>
          <div class="card-footer d-flex justify-content-between">
            <button class="btn btn-outline-info btn-sm">Preparación</button>
            <button class="btn btn-info text-white btn-sm">Preparado</button>
          </div>
        </div>
      </div>
      <!-- Copia más tarjetas aquí si quieres -->
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
