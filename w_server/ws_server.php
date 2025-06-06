<?php
require './vendor/autoload.php';
require './WebSocketServer.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$server = IoServer::factory(
    new HttpServer(new WsServer(new WebSocketServer())),
    8080
);

$server->run();
