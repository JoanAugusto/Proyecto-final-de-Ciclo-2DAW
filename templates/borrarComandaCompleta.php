    <?php
        require_once '../db/conectionDB.php';
        require_once '../includesFrontend/orderFlowBD.php';
        require_once '../includesFrontend/sesiones.php';
        comprobar_sesion();
    ?>

    <?php
       $mesaEmpleado=$_POST['id_mesa'];
       
        $camarero=$_POST['id_empleado'];
        $comandaEliminar=$_POST['id_comanda'];
        

        $envioEliminacion=vaciar_lineas_comanda($conn,$comandaEliminar);
        $envioEliminacionComanda=eliminar_comanda($conn,$comandaEliminar);
         header("Location: ./resumenComanda.php?id_mesa=$mesaEmpleado&id_empleado=$camarero&id_comanda=$comandaEmpleado");


    exit;

    
    ?>