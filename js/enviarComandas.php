<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1) Cargar autoloader Composer
require '../w_server/vendor/autoload.php';

include_once '../db/conectionDB.php';
include_once '../includesFrontend/orderFlowBD.php';
use WebSocket\Client;

// 2) Validar datos
if (!isset($_POST['id_comanda'], $_POST['id_mesa'], $_POST['nombre_empleado'])) {
    die("Faltan datos para enviar la comanda.");
}

$envioComandaID      = $_POST['id_comanda'];
$envioMesaID         = $_POST['id_mesa'];
$envioNombreEmpleado = $_POST['nombre_empleado'];

// 3) var_dump para asegurarnos de que llegan datos
var_dump($_POST);

// 4) Cargar líneas de la comanda
$lineaComandasSegunID = load_lineas_comanda_con_productos($conn, $envioComandaID);
if (!$lineaComandasSegunID) {
    die("No se encontraron líneas para esa comanda.");
}

// 5) Separar en barra/cocina
$comandaBarra  = [];
$comandaCocina = [];
foreach ($lineaComandasSegunID as $linea) {
    if ($linea['tipo_lineacomanda'] === 'barra') {
        $comandaBarra[] = $linea;
    } elseif ($linea['tipo_lineacomanda'] === 'cocina') {
        $comandaCocina[] = $linea;
    }
}

// 6) Si no hay nada, salir
if (empty($comandaBarra) && empty($comandaCocina)) {
    die("No hay productos para enviar.");
}

// 7) Enviar al WebSocket
try {
    $wsClient = new Client('ws://localhost:8080');

    if (!empty($comandaBarra)) {
        $jsonBarra = json_encode([
            'tipo'    => 'barra',
            'comanda' => $comandaBarra
        ]);
        $wsClient->send($jsonBarra);
    }
    if (!empty($comandaCocina)) {
        $jsonCocina = json_encode([
            'tipo'    => 'cocina',
            'comanda' => $comandaCocina
        ]);
        $wsClient->send($jsonCocina);
    }

    $wsClient->close();
    echo "Comandas enviadas al WebSocket.";
} catch (\Throwable $e) {
    echo "Error al conectar/enviar al WebSocket: " . $e->getMessage();
}
