<?php
/**
 *
 */
class Pages extends Controller{

  public function __construct(){
    // code...
  }
  public function index(){
      $this->view('pages/index');
  }
  public function about(){

      $this->view('pages/about');
  }
  public function help(){

      $this->view('pages/help');
  }
  public function logout(){
    session_unset();
    session_destroy();
    redirect('pages');
  }
}
