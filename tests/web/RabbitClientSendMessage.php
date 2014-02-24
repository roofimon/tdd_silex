<?php
require_once '../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPConnection('119.59.97.9', 5672, 'guest', 'guest');
$channel = $connection->channel();

for ($i = 1; $i <= 5; $i++) {

  $channel->queue_declare('api_log', false, false, false, false);

  $msg = new AMQPMessage($i.'- Hello World!'.date('Format String'));
  $channel->basic_publish($msg, '', 'hello');

  echo $i." [x] Sent 'Hello World!'\n";
}
$channel->close();
$connection->close();


