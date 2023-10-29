<?php

class DB {
    private $conn;
    public $pdo;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $this->pdo = new PDO('mysql:dbname='. DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASS);

    }

    public function query($sql) {
        $query = $this->pdo->query($sql);
        $data = $query->fetchAll();
        return $data;
    }

    //select id,name from res_users
    public function select_all($table_name, $columns = array()) {
        $query = 'SELECT ';
        $string = '';
        foreach($columns as $column) {
            $string .= ' ' . $column . ',';
        }
        $subString = substr($string, 0, -1);
        $query .= $subString . ' FROM ' . $table_name;
        try {
          $result = mysqli_query($this->conn, $query);
        } catch (Exception $e) {
          echo 'Error selecting record[select_all]: ',  $e->getMessage(), "\n";
        }
        $result_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
          
        return $result_array;
    }

    public function insert_one ($tableName, $columns = array()) {

        $strCol = '';
        foreach($columns as $colName => $colValue) {
            $strCol .= ' ' . $colName . ',';
        }
        $strCol = substr($strCol, 0, -1);

        $strColValues = '';
        foreach($columns as $colName => $colValue) {
            $strColValues .= " '" . $colValue . "' ,";
        }
        $strColValues = substr($strColValues, 0, -1);

        $query = "INSERT INTO $tableName ($strCol) VALUES ($strColValues)";
        //var_dump($query); die;
        if (mysqli_query($this->conn, $query)) {
            $lastId = mysqli_insert_id($this->conn);

            return $lastId;
        } else {

            return -1;
        }
    }

    public function select_one($table_name, $columns = array(), $id) {
        $query = 'SELECT ';
        $string = '';
        foreach($columns as $column) {
            $string .= ' ' . $column . ',';
        }
        $subString = substr($string, 0, -1);
        $query .= $subString . ' FROM ' . $table_name . ' WHERE  id = ' . $id;
        $result = mysqli_query($this->conn, $query);
        $result_array = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        try {
          $result = mysqli_query($this->conn, $query);
        } catch (Exception $e) {
          echo 'Error selecting record[select_one]: ',  $e->getMessage(), "\n";
        }
        return $result_array;
    }

    public function update_one($tableName, $columns = array(), $id) {

        $strCol = '';
        foreach($columns as $colName => $colValue) {
          $strCol .= " " . $colName . " = '$colValue' ,";
        }
        $strCol = substr($strCol, 0, -1);
    
        $query = "UPDATE $tableName SET $strCol WHERE id = $id";
    
        if (mysqli_query($this->conn, $query)) {
          $rowsAffected = mysqli_affected_rows($this->conn);
    
          return $rowsAffected;
        } else {
    
          return -1;
        }
      }

    public function delete_one($tableName, $id) {

        $query = "DELETE FROM $tableName WHERE id = $id";

        if (mysqli_query($this->conn, $query)) {
            $rowsAffected = mysqli_affected_rows($this->conn);

            return $rowsAffected;
        } else {

            return -1;
        }
        }

}

//LIVELLO DI ASTRAZIONE SUPERIORE ALLA CLASSE SUPERIORE
class DBManager {
    protected $db;
    protected $columns;
    protected $tableName;

    public function __construct(){
        $this->db = new DB();
    }

    public function get($id) {
        $resultArr = $this->db->select_one($this->tableName, $this->columns, (int)$id);
        return (object) $resultArr;
      }
    
      public function getAll() {
        $results = $this->db->select_all($this->tableName, $this->columns);
        $objects = array();
        foreach($results as $result) {
          array_push($objects, (object)$result);
        }
        return $objects;
      }
    
      public function create($obj) {
        $newId = $this->db->insert_one($this->tableName, (array) $obj);
        return $newId;
      }
    
      public function delete($id) {
        $rowsDeleted = $this->db->delete_one($this->tableName, (int)$id);
        return (int) $rowsDeleted;
      }
    
      public function update($obj, $id) {
        $rowsUpdated = $this->db->update_one($this->tableName, (array) $obj, (int)$id);
        return (int) $rowsUpdated;
      }
}