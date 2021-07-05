<?php
  function lastID(){
    $db=new Database;
    return $db->lastId();
  }
  function findByCol($tbl,$col,$val){
    $conn = new Database;
    $conn->query("SELECT {$col} FROM {$tbl} WHERE {$col} = ? LIMIT 1 ");
    $conn->bind(1,$val);
    $row = $conn->single();
    return $conn->rowCount() > 0 ? true : false;
  }
  function findMyIdCol($tbl,$col,$val){
    $conn = new Database;
    $conn->query("SELECT {$col} FROM {$tbl} WHERE {$col} = ? AND userId=? LIMIT 1 ");
    $conn->bind(1,$val);
    $conn->bind(2,userId());
    $row = $conn->single();
    return $conn->rowCount() > 0 ? true : false;
  }

  // load form name and description
  function loadFormHeader($id){
    $db = new Database;
    $db->query("SELECT title,note FROM ".FMS_TBL." WHERE id = ? LIMIT 1");
    $db->bind(1,$id);
    $row=$db->single();
    return $db->rowCount() > 0 ? $row : false;
  }
  function loadFormSection($id){
    $db = new Database;
    $db->query("SELECT id,dsc FROM ".FMS_STN_TBL." WHERE fid = ?");
    $db->bind(1,$id);
    return $db->resultSet();
  }
  // load all form question
  function loadFormQuestion(){
    $db = new Database;
    $db->query("SELECT id,question,note,type,option_type,path,requires,comments
                FROM ".QSN_TBL." WHERE fid = ? ");
    $db->bind(1,escapeString($_SESSION['formId']));
    return $db->resultSet();
  }

  // load single question
  function loadSingleQuestion($id){
    $db = new Database;
    $db->query("SELECT id,question,note,type,option_type,path,requires,comments FROM ".QSN_TBL."
                WHERE id = ? LIMIT 1");
    $db->bind(1,$id);
    return $db->resultSet();
  }

  function loadSectionQuestion($id){
    $db = new Database;
    $db->query("SELECT id,question,note,type,option_type,path,requires,comments FROM ".QSN_TBL."
                WHERE sid = ? ");
    $db->bind(1,$id);
    return $db->resultSet();
  }
  function loadNoSectionQuestion($id){
    $db = new Database;
    $db->query("SELECT id,question,note,type,option_type,path,requires FROM ".QSN_TBL."
                WHERE fid = ? ");
    $db->bind(1,$id);
    return $db->resultSet();
  }

  function loadOption($id){
    $db = new Database;
    $db->query("SELECT id,options FROM ".OPN_TBL." WHERE qid = ? ORDER BY created_on ASC");
    $db->bind(1,$id);
    return $db->resultSet();
  }

  // load form response form
  // load section
  function loadFromRespondentSection(){
    $db = new Database;
    $db->query("SELECT id,dsc FROM ".FMS_STN_TBL." WHERE fid = ? ORDER id ASC");
    $db->bind(1,$_SESSION['loadresponseById']);
    return $db->resultSet();
  }
  // load question
  function loadFormQuestionOnResponse(){

  }
  // activity log
  function aLog($msg){
    $db = new Database;
    $db->query("INSERT INTO ".ACTIVITY_LOG_TBL." SET timestamp=:stamp,userId=:id,activity=:msg");
    $db->bind(':stamp',dateTime());
    $db->bind(':id',userId());
    $db->bind(':msg',$msg);
    $db->execute();
  }
 ?>
