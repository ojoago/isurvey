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

    // load Projects/forms
    public function loadALLForms(){
      $this->db->query("SELECT id,title FROM ".FMS_TBL." WHERE userId = ? ORDER BY created_on DESC");
      $this->db->bind(1,userId());
      return $this->db->resultSet();
    }
    // creating iSurvey Projects/form goes here
    public function saveForm($data){
      return empty($data['id']) ? $this->createForm($data) : $this->updateForm($data);
    }
    // crate new form
    private function createForm($data){
      $this->db->query("INSERT INTO ".FMS_TBL." SET userId=:userId,title=:title,
                  note=:dsc,created_on=:date,updated_on=:date");
      $this->db->bind(':userId',userId());
      $this->db->bind(':title',$data['name']);
      $this->db->bind(':dsc',$data['dsc']);
      $this->db->bind(':date',dateTime());
      return $this->db->execute() ? lastID() : false;
    }
    // update form info
    private function updateForm($data){
      $this->db->query("UPDATE ".FMS_TBL." SET title=:title,
                  note=:dsc,updated_on=:date WHERE id =:id");
      $this->db->bind(':title',$data['name']);
      $this->db->bind(':dsc',$data['dsc']);
      $this->db->bind(':id',$data['id']);
      $this->db->bind(':date',dateTime());
      return $this->db->execute() ? $data['id'] : false;
    }
    // create form section
    public function createSection($id,$dsc='',$name="section"){
      $this->db->query("INSERT INTO ".FMS_STN_TBL." SET fid=:fid,section=:sec,dsc=:dsc");
      $this->db->bind(':fid',$id);
      $this->db->bind(':sec',$name);
      $this->db->bind(':dsc',$dsc);
      return $this->db->execute() ? lastID() : false;
    }
    public function getLastSectionId($id){
      $this->db->query("SELECT id FROM ".FMS_STN_TBL." WHERE fid=? ORDER BY id DESC LIMIT 1");
      $this->db->bind(1,$id);
      return @$this->db->single()->id;
    }
    // update section description
    public function updateSection($id,$dsc='',$name="section"){
      $this->db->query("UPDATE ".FMS_STN_TBL." SET section=:sec,dsc=:dsc WHERE id=:id LIMIT 1");
      $this->db->bind(':id',$id);
      $this->db->bind(':sec',$name);
      $this->db->bind(':dsc',$dsc);
      return $this->db->execute() ? true : false;
    }
    public function mergeSection($id,$sid){
      $this->db->query("UPDATE ".QSN_TBL." SET sid=:sid WHERE sid=:id ");
      $this->db->bind(':id',$id);
      $this->db->bind(':sid',$sid);
      return $this->db->execute() ? true : false;
    }
    // delete section and dependent
    public function deleteSection($id){
      $this->db->query("DELETE f FROM ".FMS_STN_TBL." f
                        LEFT JOIN ".QSN_TBL." q ON q.sid = f.id LEFT JOIN ".OPN_TBL." o ON o.qid=q.id
                        LEFT JOIN ".RESPONSE_TBL." r ON r.qid=q.id WHERE f.id = ? ");
      $this->db->bind(1,$id);
      return $this->db->execute() ? true : false;
    }

    public function createFormQuestion($data){
      $this->db->query("INSERT INTO ".QSN_TBL." SET fid=:fid,question=:question,
                        type=:type,option_type=:option_type,sid=:sid");
      $this->db->bind(':fid',$data['formId']);
      $this->db->bind(':question',$data['question']);
      $this->db->bind(':type',$data['type']);
      $this->db->bind(':option_type',$data['option_type']);
      $this->db->bind(':sid',$data['sectionId']);
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
    // enalbe comments on question
    public function toggleComments($id,$action){
      $this->db->query("UPDATE ".QSN_TBL." SET comments=:cm WHERE id=:id LIMIT 1");
      $this->db->bind(':cm',strtolower($action));
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

    // insert response
    public function postResponse($id,$val,$cmt=''){
      $this->db->query("INSERT INTO ".RESPONSE_TBL." SET qid=:id,answer=:an,comment=:cmt,respond_on=:date");
      $this->db->bind(':id',$id);
      $this->db->bind(':an',$val);
      $this->db->bind(':cmt',$cmt);
      $this->db->bind(':date',dateTime());
      return $this->db->execute() ? true : false;
    }

    public function loadResponse($id){
      $this->db->query("SELECT q.question,o.options,COUNT(r.answer) AS count,r.comment FROM
                        ".QSN_TBL." q LEFT JOIN ".OPN_TBL." o ON q.id=o.qid
                        LEFT JOIN ".RESPONSE_TBL." r ON o.id=r.qid WHERE q.fid= ? GROUP BY o.options,r.answer ORDER BY q.id ASC");
      $this->db->bind(1,$id);
      return $this->db->resultSet();
    }
    public function genQuery($data){

    }
 //    $string = "INSERT INTO ".$table_name." (";
 // $string .= implode(",", array_keys($data)) . ') VALUES (';
 // $string .= "'" . implode("','", array_values($data)) . "')";
  }
