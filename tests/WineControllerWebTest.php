<?php
/**
 * Created by PhpStorm.
 * User: roofimon
 * Date: 11/30/13 AD
 * Time: 3:34 PM
 */

#require_once __DIR__.'/../vendor/autoload.php';

class WineControllerTest extends Silex\WebTestCase {
  public function createApplication() {
    include __DIR__.'/../web/index.php';
    return $app;
  }

  public function testRoot(){
    $client = $this->createClient();
    $crawler = $client->request('GET', '/');
    $this->assertCount(1, $crawler->filter('h1:contains("Geeky API")'));
  }

  public function testListWine() {
    $client = static::createClient();
    $crawler = $client->request('GET', '/wines');

    $this->assertTrue($client->getResponse()->isOk());
		
		$this->assertTrue(
		    $client->getResponse()->headers->contains(
		        'Content-Type',
		        'application/json'
		    )
		);		
  }

  public function testAddWine(){
    $expected_json = '{"success":true}';
    $client = $this->createClient();
    $client->request(
      'POST',
      '/wines',
      array(),
      array(),
      array('CONTENT_TYPE' => 'application/json'),
      '{"title":"Fabien"}'
    );
    $actual_json = $client->getResponse()->getContent();
    $this->assertEquals($expected_json, $actual_json);
  }

  public function testGetWine(){
    $expected_json = '{"id":"1","title":"Hello!","grapes":"Just testing","price":"100","country":"Australia","region":"Victoria","year":"2010","note":"Note"}';
    $client = $this->createClient();
    $crawler = $client->request('GET', '/wines/1');

    $this->assertTrue($client->getResponse()->isOk());
    $actual_json =  $client->getResponse()->getContent();
    $this->assertEquals($expected_json, $actual_json);
  }



}
