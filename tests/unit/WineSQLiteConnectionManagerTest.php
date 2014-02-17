<?php

class WineSQLiteConnectionManagerTest extends PHPUnit_Framework_TestCase{
  function testGetConnection(){
    $mockPDO = $this->getMock('MockPDO', array('setAttribute', 'exec', 'prepare'));
    $mockPDO->expects($this->once())
            ->method('setAttribute');

    $mockStatement = $this->getMock('PDOStatement');
    $mockPDO->expects($this->any())
            ->method('prepare')->will($this->returnValue($mockStatement));

    $wineSQLiteConnectionManager = new WineSQLiteConnectionManager();
    $wineSQLiteConnectionManager->setPDO($mockPDO);
    $wineSQLiteConnectionManager->getConnection();
  }
}
