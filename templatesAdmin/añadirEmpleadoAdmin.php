<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
          <div class="card shadow-lg rounded-4">
            <div class="card-header bg-primary text-white text-center rounded-top-4">
              <h3 class="mb-0">Añadir Empleado</h3>
            </div>
                    <?php
                        // require './seccionesAdmin/gestionEmpleadosAdmin.php';
                        require_once '../db/conectionDB.php';
                        require_once '../includesAdmin/OrderFlowBDAdmin.php';

                     error_reporting(0);

                        //Obtengo los valores en las variable de ese empleado con esa id

                    ?>

     <div class="card-body">

                            <form action="guardarAñadirEmpleado.php" method="POST">
                <div class="mb-3">
                    <label for="id_empleado" class="form-label">ID Empleado</label>
                    <input type="text" class="form-control" id="id_empleado" name="id_empleado"  readonly>
                </div>

                <div class="mb-3">
                    <label for="contrasena_empleado" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contrasena_empleado" name="contrasena_empleado" >
                </div>

                <div class="mb-3">
                    <label for="nombre_empleado" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre_empleado" name="nombre_empleado" >
                </div>

                <div class="mb-3">
                    <label for="apellido_empleado" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellido_empleado" name="apellido_empleado" >
                </div>

                <div class="mb-3">
                    <label for="numero_telefono_empleado" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" id="numero_telefono_empleado" name="numero_telefono_empleado" >
                </div>

                <div class="mb-3">
                    <label for="correo_empleado" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correo_empleado" name="correo_empleado" >
                </div>

                <div class="mb-3">
                    <label for="rol_empleado" class="form-label">Rol</label>
                    <select class="form-select" id="rol_empleado" name="rol_empleado">
                    <?php
                            $enumEmpleados= load_enum_empleados($conn,'empleado','rol_empleado');
                            foreach ($enumEmpleados as $rol){
                               echo '<option value="' . $rol . '">' . ucfirst($rol) . '</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="es_admin" name="es_admin" value="1">
                    <label class="form-check-label" for="es_admin">¿Es administrador?</label>
                </div>

                <div class="mb-3">
                    <label for="id_jefe" class="form-label">ID Jefe</label>
                    <input type="text" class="form-control" id="id_jefe" name="id_jefe" value="<?php echo $empleado['id_jefe']; ?>" readonly>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg rounded-pill">Guardar Cambios</button>
                </div>
                </form>


            </div>
          </div>
        </div>
      </div>
    </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>