<?php
/**
 *
 */
class Guests extends Controller{

  public function __construct(){
    $this->userModel=$this->model('Login');
  }

  public function index(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
      $data=[
        'email'=>$_POST['email'],
        'pwd'=>$_POST['pwd'],
        'cpwd'=>$_POST['cpwd'],
        'email_err'=>'',
        'pwd_err'=>'',
      ];
      if(!verifyEmail($data['email'])){
        $data['email_err']='Wrong Email Address';
      }
      if(findByCol(USER_TBL,'mail',$data['email'])){
        $error=$data['email_err']='EMail Address Exist!';
      }
      if(empty($data['pwd'])){
        $data['pwd_err']='Enter Password!';
      }elseif(!minLength($data['pwd'])){
        $data['pwd_err']='Minimum of 6 character!';
      }
      // elseif(!(upperCase($data['pwd']))) {
      //   $data['pwd_err']='Password must contain at least one uppercase character!';
      // }elseif (ctype_alnum($data['pwd'])) {
      //   $data['pwd_err']='Password must contain number, letter and special character!';
      // }elseif ($this->preg($data['pwd'])) {
      //   $data['pwd_err']='Password must contain number, letter and special character!';
      // }
      elseif(!($data['pwd']===$data['cpwd'])) {
        $data['pwd_err']=$data['cpwd_err']='Password did not match!';
      }
      // if($data['avater']!==$data['confirmavater']){
      //   $data['avater_err']='Wrong input!';
      // }
       if($this->userModel->resgister($data)){
         flash('register_success','you are now registered and can login');
         redirect('guests/login');
       }
       flash('register_success','Something Went Wrong','danger');
    }else{
      $data=[
        'email'=>'',
        'pwd'=>'',
        'cpwd'=>'',
        'email_err'=>'',
        'pwd_err'=>'',
      ];
    }
    $this->view('guest/index',$data);
  }

  public function login(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
      $data=[
        'email'=>StaticClass::escapeString($_POST['email']),
        'pwd'=>$_POST['pwd']
      ];
      if(empty($data['email'])){
          $error=$data['email_err']='Please enter email';
      }
      if(empty($data['pwd'])){
          $error=$data['pwd_err']='Please enter password';
      }
      if(!findByCol(USER_TBL,'mail',$data['email'])){
        $error=$data['email_err']='No User found!';
        flash('register_success','No User found!','danger');
      }
      // make sure error are empty
      if(empty($error)){
          $loggedInUser=$this->userModel->login($data);
          if($loggedInUser){
            $loggedInUser->status==='active' ? $this->createUserSession($loggedInUser) : flash('register_success','Please Verify your email');//$data['email_err']='';
          }else{
            flash('register_success','Wrong Password!','danger');
          }
      }
    }else{
      $data=[
        'email'=>'',
        'pwd'=>''
      ];
    }
    $this->view('guest/login',$data);
  }
  public function reset(){
    $data=[
      'email'=>'',
      'pwd'=>''
    ];
    $this->view('guest/reset',$data);
  }
  private function createUserSession($user){
    $_SESSION['isurvey_id']=$user->id;
    redirect('dashboards');
  }

  public function logout(){
    
    $this->view('guest/login',$data);
  }
}
