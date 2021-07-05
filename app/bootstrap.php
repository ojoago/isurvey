 <?php
   // load config
   ob_start();
   require_once('config/config.php');
   // require_once('functions/url_helper.php');
   require_once('functions/session_helper.php');
      //  include composer required libraries
  // include_once('vendor/autoload.php');

   //load libraries
    spl_autoload_register(function($class){
       $class=strtolower($class);
       require_once("lib/{$class}.php");
    });
   //  require class that require database
    require_once('functions/dbQuery.php');
    require_once('functions/functions.php');
    require_once('functions/dropdown.php');
    require_once('functions/loadmodal.php');
    require_once('functions/formsHelper.php');
    require_once('functions/responseHelper.php');
