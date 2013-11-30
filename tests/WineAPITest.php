<?php
require_once '../web/WineAPI.php';

class WineAPITest extends \PHPUnit_Framework_TestCase {

  public function testGetWine() {

    $mockStatement = $this->getMock('PDOStatement', ['fetchAll']);
    $mockStatement->expects($this->once())->method('fetchAll')->will($this->returnValue('mock return'));
    $mockPDO = $this->getMock('MockPDO', ['query']);
    $mockPDO->expects($this->once())->method('query')->will($this->returnValue($mockStatement));

    $wineAPI = new WineAPI();
    $wineAPI->setPDO($mockPDO);

    $result = $wineAPI->listWine();
    $this->assertEquals('mock return', $result);
  }
}
