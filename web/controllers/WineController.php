<?php
/**
 * Created by PhpStorm.
 * User: roofimon
 * Date: 11/30/13 AD
 * Time: 5:56 PM
 */
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class WineController {
	private $app;
  private $service;
  private $twigEnvironment;

  public function __construct($app) {
    $this->service = $app['wine_service_pdo'];
    $this->twigEnvironment = $app['twig'];
		$this->app = $app;
  }

  public function rootPage(){
    return $this->twigEnvironment->render('index.html');
  }

  public function listWine() {
    $results = $this->service->listWine();
		$status = 200;
		$headers = array('Content-Type'=>'application/json');			
		return new JsonResponse($results, $status, $headers);
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