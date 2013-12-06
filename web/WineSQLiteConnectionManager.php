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

    foreach ($wines as $wine) {
      $stmt->execute($wine);
    }
  }
}
