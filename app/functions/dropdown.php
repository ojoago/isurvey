<?php

function dropDown($name='Next Question'){
  $dropDown='
        <div class="dropdown">
          <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <input type="radio" disabled>'.$name.'
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="#" id="radio"> <i class="fa  fa-dot-circle-o mr-1"></i> Multi choice Select One</a></li>
            <li><a class="dropdown-item" href="#" id="checkbox"> <i class="fa fa-check-square mr-1"></i> Multi choice Select Many</a></li>
            <li><a class="dropdown-item" href="#" id="dropdown"> <i class="fa  fa-toggle-down mr-1"></i> Dropdown Select One </a></li>
            <div class="dropdown-divider"></div>
            <li><a class="dropdown-item" href="#" id="linear"> <i class="fa fa-signal"></i> linear Scale</a></li>
            <div class="dropdown-divider"></div>
            <!-- <li><a class="dropdown-item" href="#" id="short"> <i class="fa fa-paragraph mr-1"></i> Paragraph</a></li> -->
            <li><a class="dropdown-item" href="#" id="Sentence"> <i class="fa fa-align-left"></i>Sentence</a></li>
            <div class="dropdown-divider"></div>
            <li><a class="dropdown-item" href="#" id="time"> <i class="fa fa-clock-o mr-1"></i> Time</a></li>
            <li><a class="dropdown-item" href="#" id="date"> <i class="fa fa-calendar mr-1"></i> Date</a></li>
            <!-- <li><a class="dropdown-item" href="#"><i class="fa fa-calendar mr-1"></i>Date & Time</a></li> -->
          </ul>
        </div>
  ';
  return $dropDown;
}
   function productCat($id=0){
     $conn= new Database;
     $conn->query("SELECT id,category FROM ".PRD_CAT_TBL." ORDER BY category ASC");
     $sql = $conn->resultSet();
     if($conn->rowCount() > 0){
       foreach($sql as $row){
           ?><option value = "<?php echo $row->id ?>" <?php if($row->id==$id){echo 'selected';} ?>>
             <?php echo strtoupper($row->category) ?></option><?php
       }
     }else {
       echo '<option>no category</option>';
     }
   }
   function productNameModel($id=0){
     $conn= new Database;
     $conn->query("SELECT id,product_name,model FROM ".PRD_TBL." ORDER BY product_name ASC");
     $sql = $conn->resultSet();
     if($conn->rowCount() > 0){
       foreach($sql as $row){
           ?><option value = "<?php echo $row->id ?>" <?php if($row->id==$id){echo 'selected';} ?>>
             <?php echo strtolower($row->model .'->'. $row->product_name) ?></option><?php
       }
     }else {
       echo '<option>No Product</option>';
     }
   }
   function expenseCat($id=0){
     $conn= new Database;
     $conn->query("SELECT id,category FROM ".EXP_CAT_TBL." ORDER BY category ASC");
     $sql = $conn->resultSet();
     if($conn->rowCount() > 0){
       foreach($sql as $row){
           ?><option ><?php echo strtoupper($row->category) ?></option><?php
       }
     }else {
       echo '<option>no category</option>';
     }
   }
   function loadCustomers($id=0){
     $conn= new Database;
     $conn->query("SELECT cid,names,gsm FROM ".CST_TBL." ORDER BY names ASC");
     $sql = $conn->resultSet();
     if($conn->rowCount() > 0){
       foreach($sql as $row){
           ?><option value = "<?php echo $row->cid ?>" <?php if($row->cid==$id){echo 'selected';} ?>>
             <?php echo ucwords($row->names) .' -> '.$row->gsm ?></option><?php
       }
     }else {
       echo '<option>no category</option>';
     }
   }
   function userCat($id=0){
     $conn= new Database;
     $conn->query("SELECT id,name FROM ".USR_CAT_TBL." ORDER BY name ASC");
     $sql = $conn->resultSet();
     if($conn->rowCount() > 0){
       foreach($sql as $row){
           ?><option value = "<?php echo $row->id ?>" <?php if($row->id==$id){echo 'selected';} ?>>
             <?php echo strtoupper($row->name) ?></option><?php
       }
     }else {
       echo '<option>no category</option>';
     }
   }


   if(isset($_POST['backUpDatabase'])){
     $database_name = "SBM";
     $conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('failed to connect to database');
     // Get connection object and set the charset
     //$conn = mysqli_connect($host, $username, $password, $database_name);
     $conn->set_charset("utf8");


     // Get All Table Names From the Database
     $tables = array();
     $sql = "SHOW TABLES";
     $result = mysqli_query($conn, $sql);

     while ($row = mysqli_fetch_row($result)) {
       $tables[] = $row[0];
     }

     // <!--
     // // <Create SQL Script for Table Data/Structure
     // // After fetching the list of database table name in an array, I loop through this array to generate the SQL script. For each loop iteration, I have generated the SQL script for creating the table structure and dumping data into the table. The SHOW CREATE TABLE statement is used to get the SQL for creating a table structure. Then, I get the column name and data to prepare the SQL for dumping data.
     // // >-->

     $sqlScript = "";
     foreach ($tables as $table) {

       // Prepare SQLscript for creating table structure
       $query = "SHOW CREATE TABLE $table";
       $result = mysqli_query($conn, $query);
       $row = mysqli_fetch_row($result);

       $sqlScript .= "\n\n" . $row[1] . ";\n\n";


       $query = "SELECT * FROM $table";
       $result = mysqli_query($conn, $query);

       $columnCount = mysqli_num_fields($result);

       // Prepare SQLscript for dumping data for each table
       for ($i = 0; $i < $columnCount; $i ++) {
         while ($row = mysqli_fetch_row($result)) {
           $sqlScript .= "INSERT INTO $table VALUES(";
           for ($j = 0; $j < $columnCount; $j ++) {
             $row[$j] = $row[$j];

             if (isset($row[$j])) {
               $sqlScript .= '"' . $row[$j] . '"';
             } else {
               $sqlScript .= '""';
             }
             if ($j < ($columnCount - 1)) {
               $sqlScript .= ',';
             }
           }
           $sqlScript .= ");\n";
         }
       }

       $sqlScript .= "\n";
     }


     // <Save and Download Database Backup File
     // After preparing the SQL script for the database table and the structure, it will be written into a backup file which is created dynamically in the specified target. Then, this file will be downloaded to the user’s browser and removed from the target location. The code for saving and downloading the database backup file is,

     if(!empty($sqlScript))
     {
       // Save the SQL script to a backup file
       $backup_file_name = $database_name . '_backup_' . date('Y-d-m') . '.sql';
       $fileHandler = fopen($backup_file_name, 'w+');
       $number_of_lines = fwrite($fileHandler, $sqlScript);
       fclose($fileHandler);

       // Download the SQL backup file to the browser
       header('Content-Description: File Transfer');
       header('Content-Type: application/octet-stream');
       header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
       header('Content-Transfer-Encoding: binary');
       header('Expires: 0');
       header('Cache-Control: must-revalidate');
       header('Pragma: public');
       header('Content-Length: ' . filesize($backup_file_name));
       ob_clean();
       flush();
       readfile($backup_file_name);
       exec('rm ' . $backup_file_name);
       unlink($backup_file_name);
     }

   }
