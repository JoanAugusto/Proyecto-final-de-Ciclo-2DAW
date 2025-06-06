<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require './vendor/autoload.php';

class WebSocketServer implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        echo "Servidor WebSocket iniciado\n";
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "Nueva conexión: {$conn->resourceId}\n";

        // Mensaje de bienvenida
        $conn->send(json_encode([
            'tipo'    => 'bienvenida',
            'mensaje' => 'Conexión establecida correctamente'
        ]));
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Mensaje recibido en el servidor: $msg\n";
        // Reenviar a todos los clientes excepto el remitente
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Conexión cerrada: {$conn->resourceId}\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error en servidor: {$e->getMessage()}\n";
        echo $e->getTraceAsString();
        $conn->close();
    }
}
