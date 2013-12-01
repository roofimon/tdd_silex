<?php
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

    public function __construct($app) {
      $this->service = $app['wine_service_pdo'];
    }

    public function listWine(Request $request, Application $app){
        $result = $this->service->listWine();
        return "string";
    }

    function setWineService(WineServicePDO $service){
        $this->service = $service;
    }
}