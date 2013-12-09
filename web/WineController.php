<?php
require_once 'Wine.php';
/**
 * Created by PhpStorm.
 * User: roofimon
 * Date: 11/30/13 AD
 * Time: 5:56 PM
 */
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class WineController {

  private $service;
  private $twigEnvironment;

  public function __construct($service, $twigEnvironment) {
    $this->service = $service;//$app['wine_service_pdo'];
    $this->twigEnvironment = $twigEnvironment;//$app['twig'];
  }

  public function rootPage(){
    return $this->twigEnvironment->render('index.html'); 
  }

  public function listWine() {
    $result = $this->service->listWine();
    return json_encode($result);
  }

  public function getWine(Request $request) {
    $data = $request->get('id');
    $target_wine = $this->service->getWine($data);
    return json_encode($target_wine);
  }

  public function addWine(Request $request) {
    $data = $request->get('title');
    $wine = new Wine(['title' => $data]);
    $this->service->addWine($wine);
    return '{"success":"true"}';
  }
}
