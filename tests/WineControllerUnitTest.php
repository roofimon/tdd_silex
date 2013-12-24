<?php
/**
 * Created by PhpStorm.
 * User: roofimon
 * Date: 11/30/13 AD
 * Time: 6:01 PM
 */
use Symfony\Component\HttpFoundation\JsonResponse;

class WineControllerUnitTest extends \PHPUnit_Framework_TestCase {
	
  function testListWine() {
		$expected_json = array(['id'=>1, 'title'=>'wine a'], ['id'=>2, 'title'=>'some wine']);
		$status = 200;
		$headers = array('Content-Type'=>'application/json');			
		$expected = new JsonResponse($expected_json, $status, $headers);
		

    $mockServicePDO = $this->getMockBuilder('WineServicePDO', ['listWine'])
                           ->disableOriginalConstructor()
                           ->getMock();
    $mockServicePDO->expects($this->once())
                   ->method('listWine')
                   ->will($this->returnValue([['id'=>1, 'title'=>'wine a'], ['id'=>2, 'title'=>'some wine']]));


		$appMock = array('wine_service_pdo'=>$mockServicePDO, 'twig'=>'', 'json' => '');
		
		
		$wineController =  new WineController($appMock);

    $actual_json = $wineController->listWine();
    $this->assertEquals($expected, $actual_json);
  }

  function testGetWine() {
		$expected_json = array('id'=>1, 'title'=>'target');		
		$status = 200;
		$headers = array('Content-Type'=>'application/json');			
		$expected = new JsonResponse($expected_json, $status, $headers);		
		
    $mockServicePDO = $this->getMockBuilder('WineServicePDO', ['getWine'])
                           ->disableOriginalConstructor()
                           ->getMock();
    $mockServicePDO->expects($this->once())
                   ->method('getWine')
                   ->will($this->returnValue(['id'=>1, 'title'=>'target']));

		$appMock = array('wine_service_pdo'=>$mockServicePDO, 'twig'=>'');
		$wineController =  new WineController($appMock);

    $mockRequest = $this->getMock('Symfony\Component\HttpFoundation\Request');
    $mockRequest->expects($this->once())
                ->method('get')
                ->with($this->equalTo('id')) // XXX: do we need to make sure to call get('id')? - Roong
                ->will($this->returnValue(1));

    $actual_json = $wineController->getWine($mockRequest);
    $this->assertEquals($expected, $actual_json);
  }

  function testAddWine(){
		$expected_json = array('success'=>true);		
		$status = 200;
		$headers = array('Content-Type'=>'application/json');			
		$expected = new JsonResponse($expected_json, $status, $headers);		
		
    $mockServicePDO = $this->getMockBuilder('WineServicePDO', ['addWine'])
                           ->disableOriginalConstructor()
                           ->getMock();
    $mockServicePDO->expects($this->once())
                   ->method('addWine')
                   ->will($this->returnValue(new Wine(['title'=>'new wine'])));

    $mockRequest = $this->getMock('Symfony\Component\HttpFoundation\Request', ['get']);
    $mockRequest->expects($this->once())
                ->method('get')
                ->will($this->returnValue('new wine'));

		$appMock = array('wine_service_pdo'=>$mockServicePDO, 'twig'=>'');
		$wineController =  new WineController($appMock);

    $result = $wineController->addWine($mockRequest);
    $this->assertEquals($expected, $result);
  }

  function testRootPage(){
    $mockTwigEnvironment = $this->getMock('Twig_Environment');
    $mockTwigEnvironment->expects($this->once())
                        ->method('render');

    $appMock = array('wine_service_pdo'=>"", 'twig'=>$mockTwigEnvironment);
		$wineController =  new WineController($appMock);

    $wineController->rootPage();
  }
}
