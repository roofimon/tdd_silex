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
		return $this->jsonWithSuccessStatus($results);
  }

  public function getWine(Request $request) {
		$id = $request->get('id');
		$result = $this->service->getWine($id);
		return $this->jsonWithSuccessStatus($result);
  }

  public function addWine(Request $request) {
    $data = $request->get('title');
    $wine = new Wine(['title' => $data]);
    $this->service->addWine($wine);
		$result =  array("success"=>true);		
		return $this->jsonWithSuccessStatus($result);
  }
	
	function jsonWithSuccessStatus($result) {
		$status = 200;
		$headers = array('Content-Type'=>'application/json');			
		return new JsonResponse($result, $status, $headers);
	}
}
