    <?php
        require_once '../db/conectionDB.php';
        require_once '../includesFrontend/orderFlowBD.php';
        require_once '../includesFrontend/sesiones.php';
        comprobar_sesion();
    ?>

    <?php
        $linea=$_POST['id_linea'];
        $mesaEmpleado=$_POST['id_mesa'];
        $comandaEmpleado=$_POST['id_comanda'];
        $camarero=$_POST['id_empleado'];

        $envioLinea=eliminar_unidad_linea_seguro($conn,$linea);

        header("Location: ./resumenComanda.php?id_mesa=$mesaEmpleado&id_empleado=$camarero&id_comanda=$comandaEmpleado");


    exit;

    
    ?>