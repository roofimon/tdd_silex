<?php
require_once './vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPConnection('119.59.97.9', 5672, 'guest', 'guest');
$channel = $connection->channel();

for ($i = 1; $i <= 5; $i++) {
  $channel->queue_declare('api_log', false, false, false, false);
  $date = new DateTime(); 
  $payload = $i.'- Hello World!'.date_format($date , 'l jS \of F Y h:i:s:u A');
  $msg = new AMQPMessage($payload, array('delivery_mode' => 2));
  $channel->basic_publish($msg, '', 'api_log');
  echo $i." [x] Sent '".$payload."'\n";
}
$channel->close();
$connection->close();


