<?php
use Silex\WebTestCase;
use Silex\Application;
/**
 * Created by PhpStorm.
 * User: roofimon
 * Date: 11/30/13 AD
 * Time: 3:34 PM
 */

class WineControllerTest extends WebTestCase{
    public function createApplication() {
        include __DIR__.'/../web/index.php';
        return $app;
    }

    // XXX: caution here is web test, real db query.
    public function testListWine() {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/wines');

        $this->assertTrue($client->getResponse()->isOk());
    }
}
