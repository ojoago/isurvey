<?php
  class Questionaires extends Controller{
    public function __construct(){
      $this->qsModel=$this->model('Questionaire');
    }
  function index($id=0){
      $data=['user'=>'','questionaire'=>''];
      // if($_SERVER['REQUEST_METHOD']=='POST'){}else{
      //
      // }
      // if(isNum(escapeString($id))){
      //   $data['user']=$this->qModel->accountDetail($id);
      //   $data['questionaire']=$this->qModel->loadQuestionaire($id);
      // }else{
      //   $data=[];
      // }
      $this->view('questionaires/questionaire',$data);
    }

    public function template($tmp=''){
      $data=[];
      $this->view('questionaires/template',$data);
    }
    public function quickQuestion(){
      if(isset($_POST['submitQuickQuestion'])){
        parse_str($_POST['form'],$_POST);
        print_r($_POST);
        $data=[
          'message'=>escapeString($_POST['message']),
          'question'=>escapeString($_POST['question']),
          'a'=>escapeString($_POST['optionA']),
          'b'=>escapeString($_POST['optionB']),
          'c'=>escapeString($_POST['optionC']),
          'd'=>escapeString($_POST['optionD']),
          'e'=>escapeString($_POST['optionE']),
          'min'=>escapeString($_POST['min_res']),
          'id'=>escapeString(@$_POST['quickQuestionId']),
        ];
        if(empty($data['question'])){
          $error='Type A Question fro your Respondent';
        }
        if(empty($data['a'])){
          $error='Enter Option A';
        }
        if(empty($data['b'])){
          $error='Enter Option B';
        }
        if(empty($data['id'])){
          if(findMyIdCol(QUICK_Q_TBL,'questionTitle',$data['question'])){
            $error=$data['question'].' Exist In your list';
          }
        }
        if(empty($error)){
          $this->qsModel->saveQuickQuestion($data);
        }

        $questionTitle='';
      }
    }
  }
