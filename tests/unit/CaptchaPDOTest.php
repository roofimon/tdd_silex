<?php
class AccessLogPDOTest extends PHPUnit_Extensions_Database_TestCase {
  private $pdo;

  public function createTable(PDO $pdo) {
    $query = "
      CREATE TABLE api_logccess_log (
        id number PRIMARY KEY,
        ip varchar(15) NOT NULL,
        access_date datetime,
        response_time decimal(7,4),
        service_url varchar(50) NOT NULL DEFAULT 0
      );
    ";
    $pdo->query($query);
  }

  public function getConnection() {
    $this->pdo = new PDO('sqlite:memory');
    $this->createTable($this->pdo);
    return $this->createDefaultDBConnection($this->pdo, ':memory:');
  }

  public function testSomething(){
    $accessLogPdo = new AccessLogPDO($this->pdo);
    $result = $accessLogPdo->count();
    assertThat(2, is(equalTo($result)));
  }

  public function getDataSet() {
    return new PHPUnit_Extensions_Database_DataSet_YamlDataSet(
      dirname(__FILE__)."/access_log.yml"
    );
  }
}
