<?php 
  require_once './includesFrontend/orderFlowBD.php';
  require_once './db/conectionDB.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $sistemaLogin = load_empleados_Comprobacion_login($_POST['correo_empleado'], $_POST['contrasena_empleado'], $conn);

    if ($sistemaLogin === false) {
        $err = true;
        $correo = $_POST['correo_empleado'];
    } else {
        session_start();
        $_SESSION['correo_empleado'] = $sistemaLogin['correo_empleado'];
        $_SESSION['rol_empleado'] = $sistemaLogin['rol_empleado'];
        $_SESSION['id_empleado']=$sistemaLogin['id_empleado'];
        

        switch ($_SESSION['rol_empleado']) {
            case 'administrador':
                header("Location: ./templatesAdmin/vistaAdmin.php");
                break;
            case 'camarero':
                header("Location: ./templates/camareroVista.php");
                break;
            case 'barra':
                header("Location: ./templates/barraVista.html");
                break;
            case 'cocinero':
                header("Location: ./templates/cocinaVista.html");
                break;
            default:
                echo "rol desconocido";
                break;
        }
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login OrderFlow</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center vh-100">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-11 col-sm-8 col-md-6 col-lg-4">
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-body p-5 bg-light rounded-4">
            <h2 class="text-center mb-4 fw-bold text-dark"><i class="bi bi-person-circle me-2"></i>Login</h2>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
              <div class="mb-3">
                <label for="usuario" class="form-label fw-semibold">Correo Electrónico</label>
                <input type="text" class="form-control form-control-lg rounded-pill shadow-sm" id="usuario" name="correo_empleado" value="<?php if(isset($correo)) echo $correo;?>" placeholder="Tu nombre de usuario">
              </div>

              <div class="mb-4">
                <label for="password" class="form-label fw-semibold">Contraseña</label>
                <input type="password" class="form-control form-control-lg rounded-pill shadow-sm" id="password" name="contrasena_empleado" placeholder="********">
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-warning btn-lg rounded-pill shadow-sm fw-bold text-dark">
                  <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar sesión
                </button>
              </div>

              <?php 
                if (isset($_GET["redirigido"])) {
                  echo "<div class='text-danger text-center mt-3'>Haga login para continuar</div>";
                }

                if (isset($err) && $err === true) {
                  echo "<div class='text-danger text-center mt-3'>Revise usuario y contraseña</div>";
                }
              ?>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
