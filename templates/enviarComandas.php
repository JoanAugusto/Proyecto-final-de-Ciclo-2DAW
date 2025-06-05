<?php
    include_once '../db/conectionDB.php';
    include_once '../includesFrontend/orderFlowBD.php';
?>

<?php
    $envioComandaID=$_POST['id_comanda'];
    $envioMesaID=$_POST['id_mesa'];
    $envioNombreEmpleado=$_POST['nombre_empleado'];

    //obtenemos los datos del array Asociativo de linea comanda segun Comanda .

    $lineaComandasSegunID=load_lineas_comanda_con_productos($conn,$envioComandaID);
 
            if (!$lineaComandasSegunID) {
            die("No se encontraron líneas para esa comanda.");
        }
    
    //En mi caso , usaré dos subArryas para guardar dependiendo el tipo de producto 

    $comandaBarra = [];
    $comandaCocina = [];

    //Recorremos $lineaComandasSegunID y haremos una condiciional para meterlos segun sea el tipo de producto que es lo mismo el tipo de lineaComanda

    foreach ($lineaComandasSegunID as $lineasComandas){
        $tipoLineaComanda=$lineasComandas['tipo_lineacomanda'];
        if($tipoLineaComanda==='barra'){
            $comandaBarra[]=$lineasComandas;
        }elseif($tipoLineaComanda==='cocina'){
            $comandaCocina[]=$lineasComandas;
        }

    }

    echo "<pre>";
echo "LINEAS BARRA:\n";
print_r($comandaBarra);
echo "\nLINEAS COCINA:\n";
print_r($comandaCocina);
echo "</pre>";
?>