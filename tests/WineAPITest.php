<?php
require_once '../web/WineAPI.php';

class WineAPITest extends \PHPUnit_Framework_TestCase {
  public function testGetWine() {
    $stub = $this->getMock('MockPDO');
    $stub->expects($this->once())->method('query')->with($this->any())->will($this->returnValue('mock return'));
    
    $wineAPI = new WineAPI();
    $wineAPI->setPDO($stub);

    $result = $wineAPI->getWine();
  }
}
