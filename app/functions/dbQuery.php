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
  function deleteByCol($tbl,$col,$val){
    $conn = new Database;
    $conn->query("DELETE FROM {$tbl} WHERE {$col} = ? LIMIT 1 ");
    $conn->bind(1,$val);
    return $conn->execute() ? true : false;
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
  function loadSectionToMerge($id){
    $db = new Database;
    $db->query("SELECT id,dsc,section FROM ".FMS_STN_TBL." WHERE fid = ? AND id <> ?");
    $db->bind(1,escapeString($_SESSION['formId']));
    $db->bind(2,$id);
    return $db->resultSet() > 0 ? $db->resultSet() : false;
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
  function loadQuestionAndAnswer(){
    $db = new Database;
    $db->query("SELECT q.question, COUNT(r.qid) AS count,r.answer,r.comment FROM ".QSN_TBL." q
                INNER JOIN ".RESPONSE_TBL." r ON q.id=r.qid WHERE q.fid=?
                GROUP BY answer,comment ORDER BY question DESC");
    $db->bind(1,$_SESSION['formId']);
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
    $db = new Database;
    $db->query("SELECT id,question FROM ".QSN_TBL." WHERE fid=?");
    $db->bind(1,$_SESSION['formId']);
    return $db->resultSet();
  }

  // load option ans response
  function loadOption_Response($id){
    $db = new Database;
    $db->query("SELECT COUNT(qid) AS count,answer,comment  FROM
                ".RESPONSE_TBL."  WHERE qid=? GROUP BY answer,comment");
    $db->bind(1,$id);
    return $db->resultSet();
  }
  // load option and response
  function loadOptionOnly(){
    $db=new Database;
    $db->query("SELECT COUNT(qid) AS count,answer,comment  FROM
                ".RESPONSE_TBL." r INNER JOIN ".QSN_TBL." q ON r.qid=q.id
                WHERE fid=? GROUP BY answer,comment");
    $db->bind(1,$_SESSION['formId']);
    return $db->resultSet();
  }
  // load option and response and date
  function loadOptionAndDate(){
    $db=new Database;
    $db->query("SELECT COUNT(qid) AS count,answer,comment,
                DATE(respond_on) AS date  FROM
                ".RESPONSE_TBL." r INNER JOIN ".QSN_TBL." q ON r.qid=q.id
                WHERE fid=? GROUP BY DATE(respond_on),answer,comment ORDER BY date DESC");
    $db->bind(1,$_SESSION['formId']);
    return $db->resultSet();
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
