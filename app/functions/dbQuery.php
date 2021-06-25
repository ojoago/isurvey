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
  // load form question
  function loadFormQuestion(){
    $db = new Database;
    $db->query("SELECT id,question,note,type,option_type,path,requires FROM ".QSN_TBL." WHERE fid = ? ");
    $db->bind(1,escapeString($_SESSION['formId']));
    return $db->resultSet();
  }
  function loadOption($id){
    $db = new Database;
    $db->query("SELECT id,options FROM ".OPN_TBL." WHERE qid = ? ");
    $db->bind(1,$id);
    return $db->resultSet();
  }
 ?>
