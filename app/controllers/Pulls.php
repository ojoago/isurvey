<?php
  /**
   *
   */
  class Pulls extends Controller{

    public function __construct(){
      $this->pullModel=$this->model('Pull');
    }
    public function index(){
      $data=[];
      $this->view('pulls/index',$data);
    }
    public function create($type=''){
      $data=[];
      $this->view('pulls/edit');
    }

    private function createPull(){
      if(!isset($_SESSION['pull_I'])){
        $_SESSION['pull_I']=$this->pullModel->createPull('new pull');
      }
    }

  }
