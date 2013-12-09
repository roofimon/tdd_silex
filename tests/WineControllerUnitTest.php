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
use Silex\Provider\Twig_Environment;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class WineControllerUnitTest extends PHPUnit_Framework_TestCase {

  function testListWine(){
    $expected_json = '[{"id":1,"title":"wine a"},{"id":2,"title":"some wine"}]';

    $mockServicePDO = $this->getMockBuilder('WineServicePDO', ['listWine'])
                           ->disableOriginalConstructor()
                           ->getMock();
    $mockServicePDO->expects($this->once())
      ->method('listWine')
      ->will($this->returnValue([['id'=>1, 'title'=>'wine a'], ['id'=>2, 'title'=>'some wine']]));

    $wineController =  new WineController($mockServicePDO, '');

    $actual_json = $wineController->listWine();
    $this->assertEquals($expected_json, $actual_json);
  }
  
  function testGetWine(){
    $expected_json = '{"id":1,"title":"target"}';
    $mockServicePDO = $this->getMockBuilder('WineServicePDO', ['getWine'])
                           ->disableOriginalConstructor()
                           ->getMock();
    $mockServicePDO->expects($this->once())
      ->method('getWine')
      ->will($this->returnValue(['id'=>1, 'title'=>'target']));

    $appMock = array('wine_service_pdo'=>$mockServicePDO, 'twig'=>'');
    $wineController =  new WineController($mockServicePDO, '');

    $mockApplication = $this->getMock('Silex\Application');
    $mockRequest = $this->getMock('Symfony\Component\HttpFoundation\Request');
    $mockRequest->expects($this->once())
      ->method('get')
      ->will($this->returnValue(1));

    $actual_json = $wineController->getWine($mockRequest);
    $this->assertEquals($expected_json, $actual_json);
  }
  
  function testAddWine(){
    $mockServicePDO = $this->getMockBuilder('WineServicePDO', ['addWine'])
                           ->disableOriginalConstructor()
                           ->getMock();
    $mockServicePDO->expects($this->once())
      ->method('addWine')
      ->will($this->returnValue(new Wine(['title'=>'new wine'])));

    $mockApplication = $this->getMock('Silex\Application');

    $mockRequest = $this->getMock('Symfony\Component\HttpFoundation\Request', ['get']);
    $mockRequest->expects($this->once())
      ->method('get')
      ->will($this->returnValue('new wine'));


    $wineController =  new WineController($mockServicePDO, '');

    $result = $wineController->addWine($mockRequest);
    $this->assertEquals('{"success":"true"}', $result);
  }

  function testRootPage(){
    $mockTwigEnvironment = $this->getMock('Twig_Environment');
    $mockTwigEnvironment->expects($this->once())
      ->method('render');

    $appMock = array('wine_service_pdo'=>"", 'twig'=>$mockTwigEnvironment);
    $wineController = new WineController('',$mockTwigEnvironment );

    $wineController->rootPage();
  }
}
