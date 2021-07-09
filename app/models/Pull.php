<?php
/**
 *
 */
class Pull{
  private $db;
  public function __construct(){
    $this->db=new Database;
  }
  // create new pull
  public function createPull($name){
    $this->db->query("INSERT INTO ".PL_TBL." SET names=:name,created_on=:date,modified_on=:date,userId=:id");
    $this->db->bind(':name',ucfirst($name));
    $this->db->bind(':date',dateTime());
    $this->db->bind(':id',userId());
    return $this->db->execute() ? lastID() : false;
  }
}
