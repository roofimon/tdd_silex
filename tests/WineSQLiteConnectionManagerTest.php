<?php
require_once './web/WineSQLiteConnectionManager.php';
class WineSQLiteConnectionManagerTest extends PHPUnit_Framework_TestCase{
  function testGetConnection(){
    $mockPDO = $this->getMock('MockPDO', array('setAttribute'));
    $mockPDO->expects($this->once())
            ->method('setAttribute');
    $wineSQLiteConnectionManager = new WineSQLiteConnectionManager();
    $wineSQLiteConnectionManager->setPDO($mockPDO);
    $wineSQLiteConnectionManager->getConnection();
  }
}
