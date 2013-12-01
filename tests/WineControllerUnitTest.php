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
        $expected_json = '[{"id":1,"title":"wine a"},{"id":2,"title":"some wine"}]';

        $mockServicePDO = $this->getMock('WineServicePDO', ['listWine']);
        $mockServicePDO->expects($this->once())
            ->method('listWine')
            ->will($this->returnValue([['id'=>1, 'title'=>'wine a'], ['id'=>2, 'title'=>'some wine']]));
        $appMock = array('wine_service_pdo'=>$mockServicePDO);
        $wineController =  new WineController($appMock);

        $mockApplication = $this->getMock('Silex\Application');
        $mockRequest = $this->getMock('Symfony\Component\HttpFoundation\Request');

        $actual_json = $wineController->listWine($mockRequest, $mockApplication);
        $this->assertEquals($expected_json, $actual_json);
    }
} 