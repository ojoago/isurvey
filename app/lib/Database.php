<?php
  class Database{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pwd = DB_PASS;
    private $dbname = DB_NAME;
    private $conn;
    private $stmt;
    private $error;
    public function __construct(){
      // set dsn
      $dsn="mysql:host=".$this->host.";dbname=".$this->dbname;
      $options = array(
        PDO::ATTR_PERSISTENT=>true,
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
      );
      // create pdo instance
      try {
        $this->conn = new PDO($dsn,$this->user,$this->pwd,$options);
      }catch(PDOException $e){
        $this->error=$e->getMessage();
        echo $this->error;
      }
    }
    // prepare statement
    public function query($sql){
      $this->stmt=$this->conn->prepare($sql);
    }
    // bind values
    public function bind($param,$value,$type=null){
      if(is_null($type)){
        switch(true) {
          case is_int($value):
            $type=PDO::PARAM_INT;
          break;
          case is_bool($value):
            $type=PDO::PARAM_BOOL;
          break;
          case is_null($value):
            $type=PDO::PARAM_NULL;
          break;
          default:
            $type=PDO::PARAM_STR;
        }
      }
      $this->stmt->bindValue($param,$value,$type);
    }

    // execute statement
    public function execute() {
        return $this->stmt->execute();
    }
    public function resultSet(){
      $this->execute();
      return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function single(){
      $this->execute();
      return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    public function rowCount(){
      return $this->stmt->rowCount();
    }
    public function findById($db,$col,$val){
      $this->query("SELECT * FROM ".$db." WHERE ".$col." =:".$col." LIMIT 1");
      $this->bind(':'.$col.'',$val);
      $row = $this->single();
      return ($this->rowCount()>0) ? true : false;
    }

  }
