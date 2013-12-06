<?php
class WineSQLiteConnectionManager{
  private $pdo;

  function __construct(){
    $this->pdo = new PDO('sqlite::memory:');
  }

  function setPDO($pdo){
    $this->pdo = $pdo;
  }

  function getConnection(){
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->createWineTable();
    $this->initialDataForWineTable();
    return $this->pdo;
  }

  function createWineTable(){
    $this->pdo->exec("CREATE TABLE IF NOT EXISTS wines (
      id INTEGER PRIMARY KEY AUTOINCREMENT, 
      title TEXT, 
      grapes TEXT, 
      price INTEGER,
      country TEXT,
      region TEXT,
      year TEXT,
      note TEXT
    )");
  }

  function initialDataForWineTable(){
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
    $stmt = $this->pdo->prepare($insert);
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
  }
}
