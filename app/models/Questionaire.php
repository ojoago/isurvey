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

    // creating iSurvey Projects/form goes here
    public function saveForm($data){
      return empty($data['id']) ? $this->createForm($data) : $this->updateForm($data);
    }
    private function createForm($data){
      $this->db->query("INSERT INTO ".FMS_TBL." SET userId=:userId,title=:title,
                  note=:dsc,created_on=:date,updated_on=:date");
      $this->db->bind(':userId',userId());
      $this->db->bind(':title',$data['name']);
      $this->db->bind(':dsc',$data['dsc']);
      $this->db->bind(':date',dateTime());
      return $this->db->execute() ? lastID() : false;
    }
    private function updateForm($data){
      $this->db->query("UPDATE ".FMS_TBL." SET title=:title,
                  note=:dsc,updated_on=:date WHERE id =:id");
      $this->db->bind(':title',$data['name']);
      $this->db->bind(':dsc',$data['dsc']);
      $this->db->bind(':id',$data['id']);
      $this->db->bind(':date',dateTime());
      return $this->db->execute() ? $data['id'] : false;
    }
    public function createFormQuestion($data){
      $this->db->query("INSERT INTO ".QSN_TBL." SET fid=:fid,question=:question,
                        type=:type,option_type=:option_type");
      $this->db->bind(':fid',$data['formId']);
      $this->db->bind(':question',$data['question']);
      $this->db->bind(':type',$data['type']);
      $this->db->bind(':option_type',$data['option_type']);
      return $this->db->execute() ? lastID() : false;
    }
    public function updateFormQuestion($id,$text){//update question text
      $this->db->query("UPDATE ".QSN_TBL." SET question=:question,type='text' WHERE id =:id LIMIT 1");
      $this->db->bind(':id',$id);
      $this->db->bind(':question',sentenceCase($text));
      return $this->db->execute() ? true : false;
    }
    public function updateQuestionNote($id,$text){//update question text
      $this->db->query("UPDATE ".QSN_TBL." SET note=:note WHERE id =:id LIMIT 1");
      $this->db->bind(':id',$id);
      $this->db->bind(':note',sentenceCase($text));
      return $this->db->execute() ? true : false;
    }
    // make question Compulsory or not
    public function toggleRequired($id,$action){
      $this->db->query("UPDATE ".QSN_TBL." SET requires=:rq WHERE id=:id LIMIT 1");
      $this->db->bind(':rq',strtolower($action));
      $this->db->bind(':id',$id);
      return $this->db->execute() ? true : false;
    }
    // change question type
    public function changeQuestionType($id,$type){
      $this->db->query("UPDATE ".QSN_TBL." SET option_type=:type WHERE id=:id LIMIT 1");
      $this->db->bind(':type',$type);
      $this->db->bind(':id',$id);
      return $this->db->execute() ? true : false;
    }
    // delete options on change type to none option
    public function deleteOption($id){
      $this->db->query("DELETE FROM ".OPN_TBL." WHERE qid =? ");
      $this->db->bind(1,$id);
      return $this->db->execute() ? true : false;
    }
    public function updateQuestionToImage($data){
      $this->db->query("UPDATE ".QSN_TBL." SET path=:path,type='image' WHERE id=:id LIMIT 1");
      $this->db->bind(':path',$data['path']);
      $this->db->bind(':id',$data['id']);
      return $this->db->execute() ? true : false;
    }
    public function deleteQuestion($id){
      $this->db->query("DELETE ".QSN_TBL." FROM ".QSN_TBL."
                        LEFT JOIN ".OPN_TBL." ON ".QSN_TBL.".id = ".OPN_TBL.".qid
                        WHERE ".QSN_TBL.".id = ? ");
      $this->db->bind(1,$id);
      return $this->db->execute() ? true : false;
    }
    public function createQuestionOption($qid,$option){
      $this->db->query("INSERT INTO ".OPN_TBL." SET qid=:qid,options=:option,created_on=:time");
      $this->db->bind(':qid',$qid);
      $this->db->bind(':option',$option);
      $this->db->bind(':time',dateTime());
      return $this->db->execute() ? lastID() : false;
    }
    public function updateQuestionOption($id,$option){
      $this->db->query("UPDATE ".OPN_TBL." SET options=:option WHERE id=:id LIMIT 1");
      $this->db->bind(':id',$id);
      $this->db->bind(':option',$option);
      return $this->db->execute() ? true : false;
    }
    public function deleteQuestionOption($id){
      $this->db->query("DELETE FROM ".OPN_TBL." WHERE id =? LIMIT 1");
      $this->db->bind(1,str_replace('_','',$id));
      return $this->db->execute() ? true : false;
    }
    public function genQuery($data){

    }
 //    $string = "INSERT INTO ".$table_name." (";
 // $string .= implode(",", array_keys($data)) . ') VALUES (';
 // $string .= "'" . implode("','", array_values($data)) . "')";
  }
