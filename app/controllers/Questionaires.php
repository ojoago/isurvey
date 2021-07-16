<?php
  class Questionaires extends Controller{
    public function __construct(){
      $this->model=$this->model('Questionaire');
    }
  function index($id=0){
      $data=['user'=>'','questionaire'=>''];
      $data['forms']=$this->model->loadALLForms();
      $this->view('questionaires/questionaire',$data);
    }

    public function template($tmp=''){
      if(empty($tmp)){
        unset($_SESSION['formId']);
        unset($_SESSION['sectionId']);
      }
      // create new form if session not set
      $this->manageForm();
      redirect('questionaires/edit/'.$_SESSION['formId']);
      // $this->view('questionaires/template');
    }
    public function edit($tmp=''){
      $data='';
      if(!empty($tmp) and isNum($tmp)){
        $_SESSION['formId']=escapeString($tmp);
        $_SESSION['sectionId']=$this->model->getLastSectionId($_SESSION['formId']);
        $data=$this->loadResponse($_SESSION['formId']);
      }
      $this->view('questionaires/template',$data);
    }
    private function loadResponse($id){
      return $this->model->loadResponse($id);
    }
    public function response($id=''){
      if(!empty($id) and isNum($id)){
        $_SESSION['loadresponseById']=escapeString($id);
      }else{
        unset($_SESSION['loadresponseById']);
      }
      $this->view('questionaires/response');
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
          $_SESSION['sectionId']=$this->model->createSection($_SESSION['formId']);
          $this->nextQuestion();
        }
        jsonEncode($_SESSION['formId']);
      }
      // create form section
      if(isset($_POST['createFormSection'])){
        ajaxControl();
        $_SESSION['sectionId']=$this->model->createSection($_SESSION['formId']);
      }
      if(isset($_POST['updateFormSection'])){
        ajaxControl();
        $this->model->updateSection(str_replace('s_','',escapeString($_POST['id'])),escapeString($_POST['txt']));
      }
      if(isset($_POST['mergeSection'])){
        ajaxControl();
        $id=$msg=$error='';
        parse_str($_POST['form'],$_POST);
        if(!isset($_POST['mid']) or empty($_POST['mid'])){
          $error='Select Section to merge';
        }
        if(!isset($_POST['del_']) or empty($_POST['del_'])){
          $error='Select a section';
        }
        if(empty($error)){
          $id=str_replace('del_','',escapeString($_POST['del_']));
          if($this->model->mergeSection($id,escapeString($_POST['mid']))){
            deleteByCol(FMS_STN_TBL,'id',$id);
            $msg=prettyMsg('Section Merged');
          }
        }else{
          $error=prettyMsg($error,'danger');
        }
        jsonEncode(['error'=>$error,'msg'=>$msg,'section'=>@$_POST['mid'],'id'=>$id]);
      }

      if(isset($_POST['removeFormSection'])){
        ajaxControl();
        $id=str_replace('del_','',escapeString($_POST['id']));
        $this->model->deleteSection($id);
        jsonEncode($id);
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
      if(isset($_POST['enableComment'])){
        ajaxControl();
        $this->model->toggleComments(str_replace('comments','',escapeString($_POST['id'])),escapeString($_POST['action']));
      }
      // change question type
      if(isset($_POST['changeQuestionType'])){
        ajaxControl();
        $id=str_replace('qtype','',escapeString($_POST['id']));
        $this->model->changeQuestionType($id,escapeString($_POST['type']));
        $this->getType($id,$_POST['type']);
        jsonEncode($id);
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
        'sectionId'=>$_SESSION['sectionId'],
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
    public function formSubmission(){
      if(isset($_POST['submitForm'])){
        parse_str($_POST['form'],$_POST);
        $comment=@$_POST['comment'];
        $check=@$_POST['check'];
        unset($_POST['comment']);
        unset($_POST['check']);
        foreach($_POST as $key => $val) {
          if(is_array($comment)){
            foreach($comment as $k => $cmt){
              if($key==$k){
                $this->model->postResponse($k,$val,$cmt);
              }else {
                $this->model->postResponse($key,$val);
              }
            }
          }else{
            $this->model->postResponse($key,$val);
          }
        }
        if(is_array($check)){
          $this->loopCheckBox($check);
        }
        jsonEncode('success');
      }
    }

    private function loopCheckBox($array){
      $comment=$array['comment'];
      unset($array['comment']);
      foreach($array AS $key => $val){
        if(is_array($comment)){//check if checkbox option contains comment
          foreach($comment as $k => $cmt){ //if comment not empty add comment
            if($k==$key){
              $this->loopObject($key,$val,$cmt);
            }else{// ignore comment if comment is empty
              $this->loopObject($key,$val);
            }
          }
        }else{// 
          $this->loopObject($key,$val);
        }
      }
    }
    private function loopObject($id,$obj,$cmt=''){
      foreach($obj as $val){
        $this->model->postResponse($id,$val,$cmt);
        $cmt='';//set comment to empty after inserting the first one
      }
    }
  }
