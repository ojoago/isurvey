<?php
  /**
   *
   */
  class Dashboards extends Controller{

    public function __construct(){
      // code...
    }
    public function index(){
      $data=[];
      $this->view('dashboard/index',$data);
    }
  }
