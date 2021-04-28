<?php
  /**
   *
   */
  class Login{
    private $db;
    public function __construct(){
      $this->db=new Database;
    }
    public function login($data){
      $this->db->query("SELECT pwd,status,id FROM ".USER_TBL." WHERE mail=? LIMIT 1");
      $this->db->bind(1,$data['email']);
      $row=$this->db->single();
      return password_verify($data['pwd'],$row->pwd) ? $row : false;
    }

    public function resgister($data){
      $this->db->query("INSERT INTO ".USER_TBL." SET mail=:mail,pwd=:pwd ");
      $this->db->bind(':mail',$data['email']);
      $this->db->bind(':pwd',password_hash($data['pwd'],PASSWORD_DEFAULT));
      return $this->db->execute() ? true : false;
    }
  }

 ?>
