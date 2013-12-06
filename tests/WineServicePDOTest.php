<?php
require_once './web/WineServicePDO.php';
require_once './web/Wine.php';

class WineServicePDOTest extends \PHPUnit_Framework_TestCase {

  public function testListWine() {
    $mockStatement = $this->getMock('PDOStatement', ['fetchAll']);
    $mockStatement->expects($this->once())->method('fetchAll');

    $mockPDO = $this->getMock('MockPDO', ['query']);
    $mockPDO->expects($this->once())->method('query')->will($this->returnValue($mockStatement));

    $mockConnectionManager = $this->getMock('WineSQLiteConnectionManager', ['getConnection']);
    $mockConnectionManager->expects($this->once())->method('getConnection')->will($this->returnValue($mockPDO));

    $app = array('wine_sqlite_connection_manager'=>$mockConnectionManager);
    $wineAPI = new WineServicePDO($app);
    $wineAPI->listWine();
  }

  public function testAddWine() {
    $mockStatement = $this->getMock('PDOStatement', ['execute']);
    $mockStatement->expects($this->once())->method('execute');

    $mockPDO = $this->getMock('MockPDO', ['prepare']);
    $mockPDO->expects($this->once())->method('prepare')->will($this->returnValue($mockStatement));

    $mockConnectionManager = $this->getMock('WineSQLiteConnectionManager', ['getConnection']);
    $mockConnectionManager->expects($this->once())->method('getConnection')->will($this->returnValue($mockPDO));

    $app = array('wine_sqlite_connection_manager'=>$mockConnectionManager);
    $wineAPI = new WineServicePDO($app);

    $wine = new Wine(['title'=>'new wine']);
    $added_wine = $wineAPI->addWine($wine);

    $this->assertEquals(1, $added_wine->getId());
  }


  public function testGetWine() {
    //arrange
    $mockStatement = $this->getMock('PDOStatement', ['fetch']);
    $mockStatement->expects($this->once())
      ->method('fetch')
      ->will($this->returnValue(new Wine(['title'=>'target wine'])));

    $mockPDO = $this->getMock('MockPDO', ['prepare']);
    $mockPDO->expects($this->once())->method('prepare')->will($this->returnValue($mockStatement));

    $mockConnectionManager = $this->getMock('WineSQLiteConnectionManager', ['getConnection']);
    $mockConnectionManager->expects($this->once())->method('getConnection')->will($this->returnValue($mockPDO));

    $app = array('wine_sqlite_connection_manager'=>$mockConnectionManager);
    $wineAPI = new WineServicePDO($app);

    $wineId = 1;
    //act
    $target_wine = $wineAPI->getWine($wineId);

    //assert
    $this->assertEquals(1, $target_wine->getId());
  }

}
