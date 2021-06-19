<?php
  class Questionaire{
    private $db;
    public function __construct(){
      $this->db=new Database;
    }

    // create quick question
    public function saveQuickQuestion($data){
      return empty($data['id']) ? $this->createQuickQuestion($data) : $this->updateQuickQuestion($data);
    }
    private function createQuickQuestion($data){
      $this->db->query("INSERT INTO ".QUICK_Q_TBL." SET userId=:userId,message=:msg,
                        questionTitle=:q,optionA=:a,optionB=:b,optionC=:c,optionD=:d,
                        optionE=:e,created_on=:time,min=:min ");
      $this->db->bind(':userId',userId());
      $this->db->bind(':msg',$data['message']);
      $this->db->bind(':q',$data['question']);
      $this->db->bind(':a',$data['a']);
      $this->db->bind(':b',$data['b']);
      $this->db->bind(':c',$data['c']);
      $this->db->bind(':d',$data['d']);
      $this->db->bind(':e',$data['e']);
      $this->db->bind(':min',$data['min']);
      $this->db->bind(':time',dateTime());
      return $this->db->execute() ? true :false;
    }
    // update quick question
    private function updateQuickQuestion($data){
      $this->db->query("UPDATE ".QUICK_Q_TBL." SET userId=:userId,message=:msg,
                        questionTitle=:q,optionA=:a,optionB=:b,optionC=:c,optionD=:d,
                        optionE=:e,min=:min WHERE id=:id ");
      $this->db->bind(':userId',userId());
      $this->db->bind(':msg',$data['message']);
      $this->db->bind(':q',$data['question']);
      $this->db->bind(':a',$data['a']);
      $this->db->bind(':b',$data['b']);
      $this->db->bind(':c',$data['c']);
      $this->db->bind(':d',$data['d']);
      $this->db->bind(':e',$data['e']);
      $this->db->bind(':min',$data['min']);
      $this->db->bind(':id',$data['id']);
      return $this->db->execute() ? true :false;
    }

    // load quick question
    public function loadQuickQuestion(){
      $this->db->query("SELECT questionTitle AS title FROM  ".QUICK_Q_TBL." WHERE userId=? ORDER BY created_on DESC");
      $this->db->bind(1,userId());
      return $this->db->resultSet();
    }
    // quick question end here
  }
