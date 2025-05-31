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
              <h3 class="mb-0">Añadir Mesa</h3>
            </div>
                    <?php
                        // require './seccionesAdmin/gestionEmpleadosAdmin.php';
                        require_once '../db/conectionDB.php';
                        require_once '../includesAdmin/OrderFlowBDAdmin.php';

                     error_reporting(0);

                        //Obtengo los valores en las variable de ese empleado con esa id

                    ?>

     <div class="card-body">

                            <form action="guardarAñadirMenu.php" method="POST">
                <div class="mb-3">
                    <label for="id_categoria" class="form-label">ID Menu</label>
                    <input type="text" class="form-control" id="id_categoria" name="id_categoria"  readonly>
                </div>

                <div class="mb-3">
                    <label for="nombre_categoria" class="form-label">Nombre Categoria</label>
                    <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" >
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