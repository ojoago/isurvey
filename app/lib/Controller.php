<?php

// base controller
// loads model and views
class Controller{
    // load model
    public function model($model){
        //Require model file
        require_once('../app/models/'.$model .'.php');
        //instatiate model
        return new $model();
    }
    //load view
    public function view($view,$data=[]){
        // check for the view file
        file_exists('../app/views/'.$view.'.php') ?
        require_once('../app/views/'.$view.'.php'):
        require_once('../app/views/_404.php');
      }
}
