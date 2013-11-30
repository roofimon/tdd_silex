<?php

class WineAPI {
  public $dbh;

  function getConnection() {
    $dbhost="127.0.0.1";
    $dbuser="root";
    $dbpass="";
    $dbname="wines";
    if ($this->dbh == null) {
      $this->dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $this->dbh;
  }

  function listWine() {
    try {
      $sql = "select * from wines";
      $dbh = $this->getConnection();
      $stmt = $dbh->query($sql);
      $wines = $stmt->fetchAll(PDO::FETCH_OBJ);
      $dbh = null;
      return $wines;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function setPDO($dbh) {
    $this->dbh = $dbh;
  }

}
