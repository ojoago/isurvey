<?php
  /**
   *
   */
  class staticClass{

    static function escapeString($str){
      $str = trim(stripslashes(htmlspecialchars($str)));
      return $str;
    }
    static function isNum($n){
      return is_numeric($n) ? true : false;
    }
    static function jsonEncode($data){
      header("Access-Control-Allow-Origin: *");
      header("Content-Type: application/json: charset-UTF-8");
      http_response_code(200);
      echo json_encode($data);
      exit;
    }
    // reset array function
    static function resetArray($array){
      foreach($array as $key => $r) {
        $array[$key]='';
      }
      return $array;
    }
  }

 ?>
