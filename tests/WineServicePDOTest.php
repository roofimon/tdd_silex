<?php
require_once '../web/WineServicePDO.php';

class WineServicePDOTest extends \PHPUnit_Framework_TestCase
{

    public function testGetWine()
    {
        $mockStatement = $this->getMock('PDOStatement', ['fetchAll']);
        $mockStatement->expects($this->once())->method('fetchAll');
        $mockPDO = $this->getMock('MockPDO', ['query']);
        $mockPDO->expects($this->once())->method('query')->will($this->returnValue($mockStatement));

        $wineAPI = new WineServicePDO();
        $wineAPI->setPDO($mockPDO);
        $wineAPI->listWine();
    }
}
