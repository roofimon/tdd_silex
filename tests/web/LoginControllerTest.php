<?php
require_once __DIR__.'/../../vendor/autoload.php';
class LoginControllerTest extends Silex\WebTestCase {
  public function createApplication() {
    include __DIR__.'/../../web/index.php';
    return $app;
  }

  public function testFail() {
    $client = $this->createClient();
    $crawler = $client->request('GET', '/login');

    $this->assertTrue($client->getResponse()->isOk());
  }
}
