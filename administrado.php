<?php
    function comprobar_admin() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (!isset($_SESSION['rol_empleado']) || $_SESSION['rol_empleado'] !== 'administrador') {
        header("Location: login.php?redirigido=true");
        exit();
    }
}

?>