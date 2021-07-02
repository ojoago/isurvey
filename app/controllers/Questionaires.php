<?php
  class Questionaires extends Controller{
    public function __construct(){
      $this->model=$this->model('Questionaire');
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
          $this->model->saveQuickQuestion($data);
        }

        $questionTitle='';
      }
    }

    // creating and updating questionaires goes here
    public function manageForm(){
      if(isset($_POST['editFrom'])){
        ajaxControl();
        if(!isset($_SESSION['formId'])){
          $data=[
            'name'=>'Untitled Form',
            'dsc'=>'',
            'id'=>''
          ];
          $_SESSION['formId']=$this->model->saveForm($data);
          $_SESSION['number']=0;
          $this->nextQuestion();
        }
        echo $_SESSION['formId'];
      }
      // update form name and description
      if(isset($_POST['updateFormInfo'])){
        ajaxControl();
          $data=[
            'name'=>escapeString($_POST['name']),
            'dsc'=>escapeString($_POST['note']),
            'id'=>$_SESSION['formId']
          ];
        $this->model->saveForm($data);
      }
      // create next question
      if(isset($_POST['createMoreQuestion'])){
        ajaxControl();
        jsonEncode($this->nextQuestion(escapeString($_POST['type'])));
      }
      // update question text
      if(isset($_POST['updateQuestionTitle'])){
        ajaxControl();
        $this->model->updateFormQuestion(escapeString($_POST['id']),escapeString($_POST['question']));
      }
      // create/update question note
      if(isset($_POST['updateQuestionNote'])){
          ajaxControl();
          $this->model->updateQuestionNote(str_replace('_n_','',escapeString($_POST['id'])),escapeString($_POST['note']));
      }
      // create active question options
      if(isset($_POST['createNextOption'])){
        ajaxControl();
        $id=str_replace('nextOption','',escapeString($_POST['id']));
        $oid =$this->nextOption($id);
        jsonEncode(['id'=>$id,'oid'=>$oid]);
      }
      // update question option on change
      if(isset($_POST['updateQuestionOption'])){
        ajaxControl();
        $this->model->updateQuestionOption(escapeString($_POST['id']),escapeString($_POST['option']));
      }
      if(isset($_POST['deleteQuestionOption'])){
        ajaxControl();
        $this->model->deleteQuestionOption(escapeString($_POST['id']));
        echo str_replace('_','',$_POST['id']);// return in order to remove html
      }
      // delete question and options
      if(isset($_POST['deleteQuestionAndOption'])){
        ajaxControl();
        $this->model->deleteQuestion(str_replace('_r','',escapeString($_POST['id'])));
      }
      // make question answering Compulsory
      if(isset($_POST['requiredCheck'])){
        ajaxControl();
        $this->model->toggleRequired(str_replace('required','',escapeString($_POST['id'])),escapeString($_POST['action']));
      }
      // change question type
      if(isset($_POST['changeQuestionType'])){
        ajaxControl();
        $id=str_replace('qtype','',escapeString($_POST['id']));
        $this->model->changeQuestionType($id,escapeString($_POST['type']));
        $this->getType($id,$_POST['type']);
        echo $id;
      }

    }
    private function getType($id,$type){
      $array=['linear','time','date','Sentence'];
      if(in_array($type,$array)){
        $this->model->deleteOption($id);
      }
    }
    private function nextQuestion($option='radio'){
      $data=[
        'type'=>'text',
        'option_type'=>$option,
        'question'=>'Question '.++$_SESSION['number'],
        'formId'=>$_SESSION['formId'],
      ];
      $id=$this->model->createFormQuestion($data);
      $this->nextOption($id);
      return $id;
    }
    private function nextOption($id,$option='option'){
      $this->model->createQuestionOption($id,$option);
    }

    public function manageImage(){
      ajaxControl();
      $data=[
        'id'=>str_replace('image','',escapeString($_POST['id'])),
        'path'=>rand(10,500) .'-'.$_FILES['file']['name'],
        'type'=>'image',
      ];
      $this->model->updateQuestionToImage($data);
      extractImg($data['path'],$_FILES['file']['tmp_name'],'questionImages');
    }
  }
