<?php
require_once './vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;

class MyDB extends SQLite3
{
  function __construct()
  {
    $this->open('api_log.db');
  }
}
$db = new MyDB();
$db->exec('CREATE TABLE IF NOT EXISTS api_log (service_url STRING)');
$connection = new AMQPConnection('119.59.97.9', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('api_log', false, false, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function($msg) {
  $db = new MyDB();
  $sql =  "INSERT INTO api_log (service_url) VALUES ('".$msg->body."')";

  $ret = $db->exec($sql);
  if(!$ret){
    echo $db->lastErrorMsg();
  } else {
    echo " [x] Received ", $msg->body, "\n";
  }
  $db->close();
};

$channel->basic_consume('api_log', '', false, true, false, false, $callback);

set_time_limit(60);
while(count($channel->callbacks)) {
      $channel->wait();
      sleep(1);
}
$channel->close();
$connection->close();
