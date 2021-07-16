<?php
  // log errors and display none
  ini_set('display_errors',1);
  error_reporting(0);
  ini_set('log_errors', 1);
  ini_set('error_log', dirname(dirname(dirname(__FILE__))) . '/error_log.txt');
  error_reporting(E_ALL);
  date_default_timezone_set('Africa/lagos');
  define('DB_HOST','localhost');
  define('DB_USER','root');
  define('DB_PASS','');
  define('DB_NAME','isurvey');
  define('APPROOT',dirname(dirname(__FILE__)));
  define('URLROOT','http://localhost/isurvey.dev');
  define('SITENAME','iSurvey'); //app name
  define('APPVERSION','0.1');//app version
  define('USER_TBL','users_tbl');//login table
  define('ACTIVITY_LOG_TBL','activity_log');
  // questionnaires
  define('FMS_TBL','forms');//form
  define('FMS_STN_TBL','form_section');//form section
  define('QSN_TBL','form_questions');
  define('RESPONSE_TBL','form_response');
  define('OPN_TBL','form_options');
  define('RESPONDENT_TBL','respondent');
  define('QUICK_Q_TBL','quick_questions');// quick question table
  // pulls
  define('PL_TBL','pulls');
  define('PL_ELT_TBL','pull_electorate');
  define('PL_CD_TBL','pull_code');
  define('PL_CNDD_TBL','pull_candidate');
  define('NAIRA','&#8358;');
