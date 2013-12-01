<?php
require_once '../web/WineServicePDO.php';
require_once '../web/WineController.php';
/**
 * Created by PhpStorm.
 * User: roofimon
 * Date: 11/30/13 AD
 * Time: 6:01 PM
 */
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class WineControllerUnitTest extends PHPUnit_Framework_TestCase {
    function testListWine(){


        $mockServicePDO = $this->getMock('WineServicePDO', ['listWine']);
        $mockServicePDO->expects($this->once())->method('listWine');
        $appMock = array('wine_service_pdo'=>$mockServicePDO);
        $wineController =  new WineController($appMock);

        $mockApplication = $this->getMock('Silex\Application');
        $mockRequest = $this->getMock('Symfony\Component\HttpFoundation\Request');

        $wineController->listWine($mockRequest, $mockApplication);
    }
} 