<?php
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

 ?>
