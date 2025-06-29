<?php
// Importamos las interfaces necesarias desde Ratchet
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

// Cargamos el autoload de Composer para poder usar todas las clases
require './vendor/autoload.php';

/**
 * Clase WebSocketServer
 * Implementa el comportamiento de un servidor WebSocket usando Ratchet.
 */
class WebSocketServer implements MessageComponentInterface {

    // Almacén de conexiones activas con metadatos personalizados
    protected $clients;

    public function __construct() {
        // Inicializamos un almacenamiento especial para objetos (conexiones)
        $this->clients = new \SplObjectStorage;
        echo "Servidor WebSocket iniciado\n";
    }
    /*
    SplObjectStorage es una estructura de PHP que nos permite almacenar objetos como claves, y también añadirles metadatos (como un array con información).*/

    /**
     * Se ejecuta cuando un nuevo cliente se conecta al servidor.
     */
    public function onOpen(ConnectionInterface $conn) {
        // Añadimos al cliente al almacenamiento, con tipo desconocido por defecto
        $this->clients->attach($conn, ['tipo' => 'desconocido']);
        echo "Nueva conexión: {$conn->resourceId}\n";

        // Enviamos mensaje de bienvenida al cliente
        $conn->send(json_encode([
            'tipo'    => 'bienvenida',
            'mensaje' => 'Conexión establecida correctamente'
        ]));
    }

    /**
     * Se ejecuta cuando el servidor recibe un mensaje de un cliente.
     */
    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Mensaje recibido en el servidor: $msg\n";

        // Convertimos el mensaje JSON a array PHP
        $data = json_decode($msg, true);

        // Si hay error en el JSON, lo mostramos y salimos
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "JSON inválido recibido: " . json_last_error_msg() . "\n";
            return;
        }

        // Procesamos el mensaje solo si tiene campo 'tipo'
        if (isset($data['tipo'])) { //el isset verifica si una variable esta definida y si su valor no es null

            // Si el tipo es 'identificacion', lo registramos como 'barra' o 'cocina'
            if ($data['tipo'] === 'identificacion' && isset($data['categoria']) && in_array($data['categoria'], ['barra', 'cocina'])) {
                // Recuperamos los metadatos de ese cliente
                $meta = $this->clients->offsetGet($from);
                $meta['tipo'] = $data['categoria']; // Actualizamos el tipo
                $this->clients->offsetSet($from, $meta); // Guardamos los cambios

                echo "Cliente {$from->resourceId} identificado como {$data['categoria']}\n";

                // Enviamos confirmación al cliente
                $from->send(json_encode([
                    'tipo' => 'confirmacion',
                    'mensaje' => 'Identificado correctamente como ' . $data['categoria']
                ]));
                return;
            }

            // Si el tipo es 'ping', respondemos con 'pong'
            if ($data['tipo'] === 'ping') {
                $from->send(json_encode(['tipo' => 'pong']));
                return;
            }

            // Si el tipo es 'barra' o 'cocina', reenviamos el mensaje a clientes de ese tipo
            if (in_array($data['tipo'], ['barra', 'cocina'])) {
                foreach ($this->clients as $client) {
                    $tipoCliente = $this->clients[$client]['tipo'] ?? 'desconocido';

                    // No reenviamos al que envió el mensaje
                    if ($tipoCliente === $data['tipo'] && $client !== $from) {
                        $client->send(json_encode($data));
                        echo "Enviado a {$tipoCliente} (cliente {$client->resourceId})\n";
                    }
                }
                return;
            }
        }

        // Si no se reconoce el tipo, lo notificamos por consola
        echo "Mensaje con tipo desconocido o no válido\n";
    }

    /**
     * Se ejecuta cuando un cliente se desconecta del servidor.
     */
    public function onClose(ConnectionInterface $conn) {
        // Eliminamos la conexión del almacenamiento
        $this->clients->detach($conn);
        echo "Conexión cerrada: {$conn->resourceId}\n";
    }

    /**
     * Se ejecuta si ocurre un error en una conexión.
     */
    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error en servidor con conexión {$conn->resourceId}: {$e->getMessage()}\n";
        // Cerramos la conexión si hay error
        $conn->close();
    }
}
