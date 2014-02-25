<?php
use \Mockery as m;
class RabbitMQServiceTest extends PHPUnit_Framework_TestCase {
  public function tearDown() {
    m::close();
  }
  function testSendSimpleMessageSuccess() {
    $mockChannel = m::mock('channel');
    $mockChannel->shouldReceive('queue_declare')->times(1);
    $mockChannel->shouldReceive('basic_publish')->times(1);
    $mockChannel->shouldReceive('close')->times(1);
    $amqConnection = m::mock('amqConnection');
    $amqConnection->shouldReceive('channel')->times(1)->andReturn($mockChannel);
    $rabbitService = new RabbitMQService($amqConnection);
    $rabbitService->sendMessage("test message");
  }
}
