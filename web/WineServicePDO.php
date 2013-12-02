<?php

class WineServicePDO {
  public $dbh;

  function getMySqlConnection() {
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

  function getConnection(){
    $pdo = new PDO('sqlite::memory:');
    //$pdo = new PDO('sqlite:./sqlite3/wines.sqlite3');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE TABLE IF NOT EXISTS wines (
      id INTEGER PRIMARY KEY AUTOINCREMENT, 
      title TEXT, 
      grapes TEXT, 
      price INTEGER,
      country TEXT,
      region TEXT,
      year TEXT,
      note TEXT
    )");
    $wines = array(
      array('title' => 'Hello!',
      'grapes' => 'Just testing',
      'price' => 100,
      'country' => 'Australia',
      'region' => 'Victoria',
      'year' => '2010',
      'note' => 'Note'),
    );

    $insert = "INSERT INTO wines (title, grapes, price, country, region, year, note) 
      VALUES (:title, :grapes, :price,  :country, :region, :year, :note)";
    $stmt = $pdo->prepare($insert);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':grapes', $grapes);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':country', $country); 
    $stmt->bindParam(':region', $region); 
    $stmt->bindParam(':year', $year); 
    $stmt->bindParam(':note', $note); 

    foreach ($wines as $m) {
      $stmt->bindValue(':title', $m['title'], SQLITE3_TEXT);
      $stmt->bindValue(':grapes', $m['grapes'], SQLITE3_TEXT);
      $stmt->bindValue(':price', $m['price'], SQLITE3_INTEGER);
      $stmt->bindValue(':country', $m['country'], SQLITE3_TEXT);
      $stmt->bindValue(':region', $m['region'], SQLITE3_TEXT);
      $stmt->bindValue(':year', $m['year'], SQLITE3_TEXT);
      $stmt->bindValue(':note', $m['note'], SQLITE3_TEXT);
      $stmt->execute();
    }
    return $pdo;
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

  function addWine($wine) {
    $properties = ['title', 'grapes', 'country', 'price'];
    $prepare_columns = implode(',', $properties);
    $prepare_values = ':' . implode(', :', $properties);
    try {
      $sql = "insert into wines(" . $prepare_columns . ") values (" . $prepare_values . ")";
      $db = $this->getConnection();
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
      $dbh = $this->getConnection();
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
