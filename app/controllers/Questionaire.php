<?php
  class Questionaire extends Controller{
    public function __construct(){
      $this->qModel=$this->model('Question');
    }
  function index($id=0){
      $data=['user'=>'','questionaire'=>''];
      if($_SERVER['REQUEST_METHOD']=='POST'){}else{

      }
      if(isNum(escapeString($id))){
        $data['user']=$this->qModel->accountDetail($id);
        $data['questionaire']=$this->qModel->loadQuestionaire($id);
      }else{
        $data=[];
      }
      $this->view('pages/questionaire',$data);
    }
  }
