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
        return json_encode($result);
    }

    public function getWine(Request $request, Application $app){
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

    function setWineService(WineServicePDO $service){
        $this->service = $service;
    }
}
