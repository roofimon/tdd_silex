<?php
class AccessLogPDO {
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function create($data) {
    $prepare_columns = implode(',', array_keys($data));
    $prepare_values = ':'.implode(',:', array_keys($data));
    try{
      $sql = "insert into access_log( $prepare_columns ) values( $prepare_values );";
      $stm = $this->pdo->prepare($sql); 
      $this->bindData($stm, $data, array_keys($data));
      $stm->execute(); 
      return $this->pdo->lastInsertId();
    }catch (PDOException $e) {

    }
  }

  public function count() {
    $sql="select count(*) from access_log";
    $sth = $this->pdo->prepare($sql);
    $sth->execute();
    $rows = $sth->fetch(PDO::FETCH_NUM);
    return $rows[0];
  }

  function bindData($statement, $data, $properties) {
    foreach ($properties as $property_name) {
      $statement->bindParam($property_name, $data[$property_name]);
    }
  }
}
