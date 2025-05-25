<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Modificar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-lg rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
          <h3 class="mb-0">Modificar Producto</h3>
        </div>

        <?php
          require_once './conectionDB.php';
          require_once './includes/OrderFlowBDAdmin.php';
          error_reporting(0);

          $id_producto = $_REQUEST['id_producto'];
          $producto = load_producto($conn, $id_producto);
        ?>

        <div class="card-body">
          <form action="guardarModificacionProducto.php" method="POST">

            <!-- CAMPO OCULTO PARA EL ID -->
            <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($producto['id_producto']); ?>">

            <div class="mb-3">
              <label for="nombre_producto" class="form-label">Nombre Producto</label>
              <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" value="<?php echo htmlspecialchars($producto['nombre_producto']); ?>"  required>
            </div>

            <div class="mb-3">
              <label for="precio_producto" class="form-label">Precio Producto</label>
              <input type="number" step="0.01" class="form-control" id="precio_producto" name="precio_producto" value="<?php echo htmlspecialchars($producto['precio_producto']); ?>"  required>
            </div>

            <div class="mb-3">
              <label for="descripcion_producto" class="form-label">Descripción Producto</label>
              <textarea class="form-control" id="descripcion_producto" name="descripcion_producto" rows="3"><?php echo htmlspecialchars($producto['descripcion_producto']); ?></textarea>
            </div>

            <div class="mb-3">
              <label for="tipo" class="form-label">Tipo Producto</label>
              <select class="form-select" id="tipo" name="tipo" required>
                <?php
                  $enumProductos = load_enum_empleados($conn, 'producto', 'tipo');
                  foreach ($enumProductos as $tipo) {
                      $selected = ($tipo === $producto['tipo']) ? 'selected' : '';
                      echo '<option value="' . htmlspecialchars($tipo) . '" ' . $selected . '>' . ucfirst(htmlspecialchars($tipo)) . '</option>';
                  }
                ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="id_categoria" class="form-label">Categoría del Producto</label>
              <select class="form-select" id="id_categoria" name="id_categoria" required>
                <?php
                  $categorias = load_menus($conn);
                  foreach ($categorias as $cat) {
                      $selected = ($cat['id_categoria'] == $producto['id_categoria']) ? 'selected' : '';
                      echo '<option value="' . htmlspecialchars($cat['id_categoria']) . '" ' . $selected . '>' . ucfirst(htmlspecialchars($cat['nombre_categoria'])) . '</option>';
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
