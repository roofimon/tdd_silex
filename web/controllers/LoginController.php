<?php
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
class LoginController {
	private $app;
  private $service;
  private $twigEnvironment;

  public function __construct($app) {
    $this->service = $app['wine_service_pdo'];
    $this->twigEnvironment = $app['twig'];
		$this->app = $app;
  }
  public function login() {
    return $this->jsonWithSuccessStatus("success");
  } 

	function jsonWithSuccessStatus($result) {
		$status = 200;
		$headers = array('Content-Type'=>'application/json');			
		return new JsonResponse($result, $status, $headers);
	}
}
