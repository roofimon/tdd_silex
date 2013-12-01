<?php

class WineServicePDO {
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

    function bindData($statement, $data, $properties) {
        foreach ($properties as $property_name) {
            $statement->bindParam($property_name, $data[$property_name]);
        }
    }

    public function setPDO($dbh) {
        $this->dbh = $dbh;
    }

}
