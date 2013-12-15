<?php

class WineServicePDO {
  public $dbh;
  private $connectionManager;

  function __construct($connectionManager){
    $this->connectionManager = $connectionManager;
  }

  function listWine() {
    try {
      $sql = "select * from wines";
      $local_dbh = $this->connectionManager->getConnection();
      echo get_class($local_dbh);
      $stmt = $local_dbh->query($sql);
      $wines = $stmt->fetchAll(PDO::FETCH_OBJ);
      $local_dbh = null;
      return $wines;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function addWine($wine) {
    $properties = array('title', 'grapes', 'country', 'price');
    $prepare_columns = implode(',', $properties);
    $prepare_values = ':' . implode(', :', $properties);
    try {
      $sql = "insert into wines(" . $prepare_columns . ") values (" . $prepare_values . ")";
      $db = $this->connectionManager->getConnection();
      $stm = $db->prepare($sql);
      $this->bindData($stm, (array)$wine, $properties);
      $stm->execute();
      return $wine;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function getWine($wineId){
    try {
      $sql = "select * from wines where id = :wineId";
      $dbh = $this->connectionManager->getConnection();
      $stmt = $dbh->prepare($sql);
      $stmt->execute(array($wineId));
      $wine = $stmt->fetch(PDO::FETCH_OBJ);
      $dbh = null;
      return $wine;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function bindData($statement, $data, $properties) {
    foreach ($properties as $property_name) {
      $statement->bindParam($property_name, $data[$property_name]);
    }
  }

  public function setPDO($dbh) {
    $this->dbh = $dbh;
  }

}
