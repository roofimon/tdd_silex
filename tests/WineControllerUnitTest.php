<?php
require_once './web/WineServicePDO.php';
require_once './web/WineController.php';
require_once './web/Wine.php';
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

        $actual_json = $wineController->listWine();
        $this->assertEquals($expected_json, $actual_json);
    }

    function testGetWine(){
        $expected_json = '{"id":1,"title":"target"}';
        $mockServicePDO = $this->getMock('WineServicePDO', ['getWine']);
        $mockServicePDO->expects($this->once())
            ->method('getWine')
            ->will($this->returnValue(['id'=>1, 'title'=>'target']));

        $appMock = array('wine_service_pdo'=>$mockServicePDO);
        $wineController =  new WineController($appMock);

        $mockApplication = $this->getMock('Silex\Application');
        $mockRequest = $this->getMock('Symfony\Component\HttpFoundation\Request');
        $mockRequest->expects($this->once())
            ->method('get')
            ->will($this->returnValue(1));

        $actual_json = $wineController->getWine($mockRequest);
        $this->assertEquals($expected_json, $actual_json);
    }
    function testAddWine(){
        $mockServicePDO = $this->getMock('WineServicePDO', ['addWine']);
        $mockServicePDO->expects($this->once())
            ->method('addWine')
            ->will($this->returnValue(new Wine(['title'=>'new wine'])));

        $mockApplication = $this->getMock('Silex\Application');

        $mockRequest = $this->getMock('Symfony\Component\HttpFoundation\Request', ['get']);
        $mockRequest->expects($this->once())
            ->method('get')
            ->will($this->returnValue('new wine'));

        $appMock = array('wine_service_pdo'=>$mockServicePDO);
        $wineController =  new WineController($appMock);

        $result = $wineController->addWine($mockRequest);
        $this->assertEquals('{"success":"true"}', $result);
    }
}
