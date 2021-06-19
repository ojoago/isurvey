<?php
  /**
   *
   */
  class Pulls extends Controller{

    public function __construct(){
      // code...
    }
    public function index(){
      $data=[];
      $this->view('pulls/index',$data);
    }
  }
