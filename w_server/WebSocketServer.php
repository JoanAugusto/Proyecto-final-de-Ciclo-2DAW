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
        // Almacenar con metadatos (tipo por defecto desconocido)
        $this->clients->attach($conn, ['tipo' => 'desconocido']);
        echo "Nueva conexión: {$conn->resourceId}\n";
        $conn->send(json_encode([
            'tipo'    => 'bienvenida',
            'mensaje' => 'Conexión establecida correctamente'
        ]));
    }

   public function onMessage(ConnectionInterface $from, $msg) {
    echo "Mensaje recibido en el servidor: $msg\n";

    $data = json_decode($msg, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "JSON inválido recibido: " . json_last_error_msg() . "\n";
        return;
    }

    if (isset($data['tipo'])) {
        if ($data['tipo'] === 'identificacion' && isset($data['categoria']) && in_array($data['categoria'], ['barra', 'cocina'])) {
            // CORRECCIÓN: actualizar metadatos en SplObjectStorage correctamente
            $meta = $this->clients->offsetGet($from);
            $meta['tipo'] = $data['categoria'];
            $this->clients->offsetSet($from, $meta);

            echo "Cliente {$from->resourceId} identificado como {$data['categoria']}\n";
            $from->send(json_encode(['tipo' => 'confirmacion', 'mensaje' => 'Identificado correctamente como ' . $data['categoria']]));
            return;
        }

        if ($data['tipo'] === 'ping') {
            $from->send(json_encode(['tipo' => 'pong']));
            return;
        }

        if (in_array($data['tipo'], ['barra', 'cocina'])) {
            foreach ($this->clients as $client) {
                $tipoCliente = $this->clients[$client]['tipo'] ?? 'desconocido';
                if ($tipoCliente === $data['tipo'] && $client !== $from) {
                    $client->send(json_encode($data));
                    echo "Enviado a {$tipoCliente} (cliente {$client->resourceId})\n";
                }
            }
            return;
        }
    }

    echo "Mensaje con tipo desconocido o no válido\n";
}


    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Conexión cerrada: {$conn->resourceId}\n";
    }

   public function onError(ConnectionInterface $conn, \Exception $e) {
    echo "Error en servidor con conexión {$conn->resourceId}: {$e->getMessage()}\n";
    $conn->close(); // MEJOR cerrar si hay error serio
}

}
