<?php
    @session_start();
    // flash msg helper
    function flash($name='',$msg='',$class='success'){
        if(!empty($name)){
            if(!empty($msg) and empty($_SESSION[$name])){
                if(!empty($_SESSION[$name])){
                    unset($_SESSION[$name]);
                }
                if(!empty($_SESSION[$name .'_class'])){
                    unset($_SESSION[$name .'_class']);
                }
                $_SESSION[$name]=$msg;
                $_SESSION[$name .'_class']=$class;
            }elseif(empty($msg) and !empty($_SESSION[$name])){
                $class = !empty( $_SESSION[$name .'_class']) ?  $_SESSION[$name .'_class'] : '';
                echo '<div class="alert alert-'.$class.' alert-dismissible text-dark" role ="alert" id="msg-flash"><button style="margin-right:20px; padding-top:2px;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button> '.$_SESSION[$name].'</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name .'_class']);
            }
        }
    }

    function isLoggedIn(){
        return  isset($_SESSION['iSurveyUserId']) ? true : false;
    }
    // url helper
    function redirect($page){
        header('Location: '. URLROOT .'/'.$page);
    }
