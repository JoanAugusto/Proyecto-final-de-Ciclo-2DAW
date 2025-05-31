<?php
    function comprobar_sesion() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // Usamos 'correo_empleado' porque así lo guardaste en el login
    if (!isset($_SESSION['correo_empleado'])) {
        header("Location: login.php?redirigido=true");
        exit();
    }
}

?>