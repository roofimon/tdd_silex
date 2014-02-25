<?php
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPConnection;
class RabbitMQService {
  function __construct($connection){
    $this->connection = $connection;
  }

  function sendMessage() {
    $channel = $this->connection->channel();
    $date = new DateTime(); 
    $payload = '- Message!'.date_format($date , 'l jS \of F Y h:i:s:u A');
    $msg = new AMQPMessage($payload, array('delivery_mode' => 2));
    $channel->queue_declare('api_log', false, false, false, false);
    $channel->basic_publish($msg, '', 'api_log');
    $channel->close();
  }
}
