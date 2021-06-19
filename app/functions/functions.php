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
      return 'OJOago';
   }
   function userId(){
     return isset($_SESSION['isurvey_id']) ? base64_decode($_SESSION['isurvey_id']) : false;
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
