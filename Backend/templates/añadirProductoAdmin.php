<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-lg rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
          <h3 class="mb-0">Añadir Producto</h3>
        </div>

        <?php
          require_once './conectionDB.php';
          require_once './includes/OrderFlowBDAdmin.php';
          error_reporting(0);
        ?>

        <div class="card-body">
          <form action="guardarAñadirProducto.php" method="POST">
            
            <div class="mb-3">
              <label for="id_producto" class="form-label">ID Producto</label>
              <input type="text" class="form-control" id="id_producto" name="id_producto" readonly>
            </div>

            <div class="mb-3">
              <label for="nombre_producto" class="form-label">Nombre Producto</label>
              <input type="text" class="form-control" id="nombre_producto" name="nombre_producto">
            </div>

            <div class="mb-3">
              <label for="precio_producto" class="form-label">Precio Producto</label>
              <input type="text" class="form-control" id="precio_producto" name="precio_producto">
            </div>

            <div class="mb-3">
              <label for="descripcion_producto" class="form-label">Descripción Producto</label>
              <input type="text" class="form-control" id="descripcion_producto" name="descripcion_producto">
            </div>

            <div class="mb-3">
              <label for="tipo" class="form-label">Tipo Producto</label>
              <select class="form-select" id="tipo" name="tipo">
                <?php
                  $enumProductos = load_enum_empleados($conn, 'producto', 'tipo');
                  foreach ($enumProductos as $tipo) {
                      echo '<option value="' . $tipo . '">' . ucfirst($tipo) . '</option>';
                  }
                ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="id_categoria" class="form-label">Categoría del Producto</label>
              <select class="form-select" id="id_categoria" name="id_categoria">
                <?php
                  $categorias = load_menus($conn);
                  foreach ($categorias as $cat) {
                      echo '<option value="' . $cat['id_categoria'] . '">' . ucfirst($cat['nombre_categoria']) . '</option>';
                  }
                ?>
              </select>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-success btn-lg rounded-pill">Guardar Producto</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
