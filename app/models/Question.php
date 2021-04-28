<?php
  /**
   *
   */
  class Question{
    private $db;
    public function __construct(){
      $this->db= new Database;
    }
    public function accountDetail($id){
      $this->db->query("SELECT u.firstname,u.lastname,u.dm_pix,p.note FROM ".USER_TBL." u INNER JOIN ".PRJ_TBL." p ON u.id = p.user_id WHERE pid = ?");
      $this->db->bind(1,$id);
      $row=$this->db->single();
      return ($this->db->rowCount()>0) ? $row : false;
    }
    public function loadQuestionaire($id){
      $this->db->query("SELECT * FROM ".QSN_TBL." WHERE p_qid=? ");
      $this->db->bind(1,$id);
      $row=$this->db->resultSet();
      return $row;
    }
  }
