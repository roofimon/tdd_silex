<?php
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
class RabbitMQServiceIntegrationTest extends PHPUnit_Framework_TestCase {
  function testSendBulk() {
    $connection = new AMQPConnection('119.59.97.9', 5672, 'guest', 'guest');
    for ($i = 1; $i <= 5; $i++) {
      $rabbitClient = new RabbitMQService($connection);
      $rabbitClient->sendMessage();
    }
    $connection->close();
  }
}

