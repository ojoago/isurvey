<?php
  /**
   *
   */
   function escapeString($str){
     return stripslashes(htmlspecialchars(trim($str)));
   }
   function isNum($n){
     return is_numeric($n) ? true : false;
   }
   function jsonEncode($data){
     header("Access-Control-Allow-Origin: *");
     header("Content-Type: application/json: charset-UTF-8");
     http_response_code(200);
     echo json_encode($data);
     exit;
   }
   function formRandomId(){
     return date('hism');
   }
   function avaterTxt(){
     $num='0123456789';
     $txt="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
     $str=str_shuffle($txt.$num);
     return substr($str,0,6);
   }
   function avater($txt){
     header('Content-type: image/jpeg');
     $font= dirname(__FILE__).'/font.TTF';
     $len=strlen($txt);
     $size=30;
     $height=50;//ImageFontHeight($size);
     // $width=200;
     $width=$size * $len+10;
     $image=imagecreate($width,$height);
     imagecolorallocate($image,255,255,255);
     $color = imagecolorallocate($image,0,0,0);
     // for($x=1; $x<=30;$x++){
     //   imageline($image,rand(1,140),rand(1,10),rand(1,100),rand(1,150),$color);
     // }
     // imagettftext($image,$size,0,10,30,$color,$font,$txt);
     imagestring($image,$size,0,0,$txt,$color);
     imagejpeg($image);
   }
   // some public methods goes down here
  function extractImg($name,$tmp,$dir='images'){
    $Ext = explode('.', $name);
    $Ext = strtolower(end($Ext));
    $size=filesize($tmp);
    $allowed = array('jpg','jpeg','png','JPG','JPEG','PNG');
    if(in_array($Ext,$allowed)){
      //$name=rand(10,1000).$name;
      $file = $dir."/".$name;
      move_uploaded_file($tmp,$file);
      if(is_file($file)){
        $percent=0.26;
        if($size< 1024*1024)
          $percent=1;
        list($width,$height)=getimagesize($file);
        $newW=$width*$percent;
        $newH=$height*$percent;
        $thumb=imagecreatetruecolor($newW,$newH);
        if($Ext=='jpg' or $Ext=='jpeg')
        $sourceImg=imagecreatefromjpeg($file);
        elseif($Ext=='gif' or $Ext=='GIF')
        $sourceImg=imagecreatefromgif($file);
        elseif($Ext=='png' or $Ext=='PNG')
        $sourceImg=imagecreatefrompng($file);
        imagecopyresized($thumb,$sourceImg,0,0,0,0,$newW,$newH,$width,$height);
        imagejpeg($thumb,$file);
      }else{ return false;}
    }else{return false;}
    return $name;
  }
   // reset array function
   function resetArray($array){
     foreach ($array as $key => $r) {
       $array[$key]='';
     }
     return $array;
   }
   function minLength($n,$l=6){
     return strlen($n) >=$l ? true : false;
   }
   function maxLength($n,$l=11){
     return strlen($n)==$l ? true : false;
   }
   function upperCase($str){
     return preg_match('/[A-Z]/',$str) ? true : false;
   }
   function getIpAddress(){
     if(isset($_SERVER['HTTP_CLIENT_IP'])){
       $ip=$_SERVER['HTTP_CLIENT_IP'];
     }elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
       $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
     }else{
       $ip=$_SERVER['REMOTE_ADDR'];
     }
     return $ip;
   }
   function preg($str){
     return preg_match('[@_!#$%^&*()/\|}{~:]',$str) ? true : false;
   }

   function verifyEmail($mail){
     return filter_var($mail,FILTER_VALIDATE_EMAIL) ? true : false;
   }
   function toDay(){
     return date('Y-m-d');
   }

   function dateTime(){
     return date('Y-m-d H:i:s');
   }
   function userName(){
      return base64_decode($_SESSION['iSurveyUserEMail']);
   }
   function userId(){
     return isset($_SESSION['iSurveyUserId']) ? base64_decode($_SESSION['iSurveyUserId']) : false;
   }
   function printMsg($msg,$class='success'){
     echo '<div class="alert alert-dismissible alert-'.$class.' p-1" role ="alert" >
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       '.$msg.'
     </div>';
     exit;
   }
   function prettyMsg($msg,$class='success'){
     return '<div class="alert alert-dismissible alert-'.$class.' p-1" role ="alert" >
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       '.$msg.'
     </div>';
   }
   // format date
   function prettyDateTime($date){
     return date('d-m-Y H:i:s',strtotime($date));
   }
   function prettyDate($date){
     return date('d-M, Y',strtotime($date));
   }
   function decodeHtmlEntity($str){
     return html_entity_decode($str);
   }
   function sentenceCase($str){
     $cap = true;
     $ret='';
     for($x = 0; $x < strlen($str); $x++){
         $letter = substr($str, $x, 1);
         if($letter == "." || $letter == "!" || $letter == "?"){
             $cap = true;
         }elseif($letter != " " && $cap == true){
             $letter = strtoupper($letter);
             $cap = false;
         }
         $ret .= $letter;
     }
     return $ret;
   }
   function ajaxControl(){
     isLoggedIn() ?: exit();
   }
