<?php
require_once '../web/WineServicePDO.php';
require_once '../web/Wine.php';

class WineServicePDOTest extends \PHPUnit_Framework_TestCase {

    public function testListWine() {
        $mockStatement = $this->getMock('PDOStatement', ['fetchAll']);
        $mockStatement->expects($this->once())->method('fetchAll');
        $mockPDO = $this->getMock('MockPDO', ['query']);
        $mockPDO->expects($this->once())->method('query')->will($this->returnValue($mockStatement));

        $wineAPI = new WineServicePDO();
        $wineAPI->setPDO($mockPDO);
        $wineAPI->listWine();
    }

    public function testAddWine() {
        $mockStatement = $this->getMock('PDOStatement', ['execute']);
        $mockStatement->expects($this->once())->method('execute');

        $mockPDO = $this->getMock('MockPDO', ['prepare']);
        $mockPDO->expects($this->once())->method('prepare')->will($this->returnValue($mockStatement));

        $wineAPI = new WineServicePDO();
        $wineAPI->setPDO($mockPDO);

        $wine = new Wine(['title'=>'new wine']);
        $added_wine = $wineAPI->addWine($wine);

        $this->assertEquals(1, $added_wine->getId());
    }

}
