<?php

use Workerman\Worker;

require_once __DIR__.'/../../vendor/autoload.php';
require __DIR__.'/../../config.php';

// Create a Websocket server
$ws_worker = new Worker('websocket://'.WSS['HOST'].':'.WSS['PORT']);
// 4 processes
$ws_worker->count = 4;
// Emitted when new connection come
$ws_worker->onConnect = function ($connection) {
    echo "New connection\n";
};
// Emitted when data received
$ws_worker->onMessage = function ($connection, $data) {
    // Send cached data
    $data = json_decode($data);
    $toSend = getCachedData( $data->pollId );
    $connection->send($toSend);
};
// Emitted when connection closed
$ws_worker->onClose = function ($connection) {
    echo "Connection closed\n";
};
// Run worker
Worker::runAll();

function getCachedData(int $id){
    return file_get_contents(__DIR__.'/../../application/cache/'.$id.'.votes.cache');
}