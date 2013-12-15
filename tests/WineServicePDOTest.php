<?php

class WineServicePDOTest extends \PHPUnit_Framework_TestCase {

  public function testListWine() {
    $mockStatement = $this->getMock('PDOStatement', array('fetchAll'));
    $mockStatement->expects($this->once())->method('fetchAll');

    $mockPDO = $this->getMock('MockPDO', array('query'));
    $mockPDO->expects($this->once())->method('query')->will($this->returnValue($mockStatement));

    $mockConnectionManager = $this->getMock('WineSQLiteConnectionManager', array('getConnection'));
    $mockConnectionManager->expects($this->once())->method('getConnection')->will($this->returnValue($mockPDO));

    $wineAPI = new WineServicePDO($mockConnectionManager);
    $wineAPI->listWine();
  }

  public function testAddWine() {
    $mockStatement = $this->getMock('PDOStatement', array('execute', 'bindParam'));
    $mockStatement->expects($this->once())->method('execute');

    $mockPDO = $this->getMock('MockPDO', array('prepare'));
    $mockPDO->expects($this->once())->method('prepare')->will($this->returnValue($mockStatement));

    $mockConnectionManager = $this->getMock('WineSQLiteConnectionManager', array('getConnection'));
    $mockConnectionManager->expects($this->once())->method('getConnection')->will($this->returnValue($mockPDO));


    $wineAPI = new WineServicePDO($mockConnectionManager);

    $wine = new Wine(array('title'=>'new wine'));
    $added_wine = $wineAPI->addWine($wine);

    $this->assertEquals(1, $added_wine->getId());
  }


  public function testGetWine() {
    //arrange
    $mockStatement = $this->getMock('PDOStatement', array('fetch', 'execute'));
    $mockStatement->expects($this->once())
      ->method('fetch')
      ->will($this->returnValue(new Wine(array('title'=>'target wine'))));

    $mockPDO = $this->getMock('MockPDO', array('prepare'));
    $mockPDO->expects($this->once())->method('prepare')->will($this->returnValue($mockStatement));

    $mockConnectionManager = $this->getMock('WineSQLiteConnectionManager', array('getConnection'));
    $mockConnectionManager->expects($this->once())->method('getConnection')->will($this->returnValue($mockPDO));


    $wineAPI = new WineServicePDO($mockConnectionManager);

    $wineId = 1;
    //act
    $target_wine = $wineAPI->getWine($wineId);

    //assert
    $this->assertEquals(1, $target_wine->getId());
  }


}
