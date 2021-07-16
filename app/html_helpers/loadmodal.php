<?php
//display square meter if tiles
 if(isset($_POST['loadTiles'])){
   $db= new Database;
   $db->query("SELECT id FROM ".PRD_CAT_TBL." WHERE category= 'tiles' AND id=? ");
   $db->bind(1,escapeString($_POST['id']));
   $sql = $db->single();
   $r= ($db->rowCount()>0) ? 1 : 0;
   jsonEncode($r);
 }

 // products dinamics search
 if(isset($_POST['dynamicsSearch'])){
   $db= new Database;
   $txt=escapeString($_POST['txt']);
   $db->query("SELECT * FROM ".PRD_TBL." WHERE product_name LIKE ? OR model LIKE ?
              OR dsc LIKE ? OR sellingprice LIKE ? ORDER BY product_name ASC LIMIT 50");
   $db->bind(1,"%$txt%");
   $db->bind(2,"%$txt%");
   $db->bind(3,"%$txt%");
   $db->bind(4,"%$txt%");
   $result=$db->resultSet();
   $data='';
   // <small class="badge badge-dark m-0" style="margin:0px;">'. countNotSuplly($row->id) .'</small>
   if($db->rowCount() >0){
     $data='
     <div class = "table table-responsive mt-1">
     <table class="table table-striped table-hover small">
       <tr>
         <th width="5%">Image</th>
         <th width="15%">Model</th>
         <th width="35%">Description</th>
         <th width="10%">Stuck</th>
         <th width="15%">Price </th>
         <th width="10%">quantity</th>
         <th width="5%"><i  class="fa fa-shopping-cart text-center " style = "margin-top:4px;" ></i></th>
       </tr>
     ';
     $n=0;
     foreach($result as $row){
       $btn='';
       if($row->prd_quantity > 0){
         $btn='<i  class="fa fa-shopping-cart addToCart pointer text-center " style = "margin-top:4px;" id = "'. $row->id .'"  title="Add to Cart"></i>';
       }
       $class= "";
       if($row->prd_quantity <= $row->replenish_limit){$class="text-danger";}
       $data.='
       <tr>
         <td><img src = "'. URLROOT .'/images/'. $row->prd_image .'" class = "img-responsive product_img img-small" id ="'. $row->id .'"></td>
         <td data-placement="left" class="text-primary pointer popdetails" id ="'. $row->id .'" >'. strtolower($row->model) .'</td>
         <td> '. strtolower($row->dsc) .'</td>
         <td class="'.$class.'"> '. $row->prd_quantity .'<small class="badge badge-dark mr-1" style="margin:0px;margin-right:1px;">'. countNotSuplly($row->id) .'</small></td>
         <td><input type = "number" id="price'. $row->id .'" value="'. $row->sellingprice .'" class = "formcontrol"style="max-width:70px;"></td>
         <td><input type = "number" id="qnt'. $row->id .'" value="1" class = "qnt" style="max-width:50px;"></td>
         <td> '.$btn.' </td>
         <input type="hidden" id="prd_img'. $row->id .'" value="'.$row->prd_image.'">
         <input type="hidden" id="price'. $row->id .'" value="'.$row->sellingprice.'">
         <input type="hidden" id="qnty'. $row->id .'" value="'.$row->prd_quantity .'">
         <input type="hidden" id="name'. $row->id .'" value="'.$row->product_name.'">
         <input type="hidden" id="dsc'. $row->id .'" value="'.$row->dsc.'">
         <input type="hidden" id="model'. $row->id .'" value="'.$row->model.'">
         <input type="hidden" id="minprice'. $row->id .'" value="'.$row->min_price.'">
         <input type="hidden" id="cat'. $row->id .'" value="'.$row->category.'">
         <input type="hidden" id="sqr_m'. $row->id .'" value="'.$row->sqr_meter.'">
       </tr>
       ';
     }
     $data.='
         </tbody>
       </table>
     ';
   }
   jsonEncode($data);
 }

 if(isset($_POST['loadProduct'])){
   $db= new Database;
   $txt=escapeString($_POST['txt']);
   $db->query("SELECT * FROM ".PRD_TBL." WHERE product_name LIKE ? OR model LIKE ?
              OR dsc LIKE ? OR sellingprice LIKE ? ORDER BY product_name ASC LIMIT 50");
   $db->bind(1,"%$txt%");
   $db->bind(2,"%$txt%");
   $db->bind(3,"%$txt%");
   $db->bind(4,"%$txt%");
   $result=$db->resultSet();
   $data='';
   if($db->rowCount() >0){
     $data='
     <table class="table table-hover table-striped table-bordered small">
       <thead>
         <tr>
           <th width="3%">S/N</th>
           <th width="5%">Image</th>
           <th width="20%">Product Name</th>
           <th width="15%">Model</th>
           <th width="25%">Description</th>
           <th width="5%">Stuck</th>
           <th width="12%">Price '. UNIT .' </th>
           <th width="10%">Qnt</th>
           <th width="5%"><i class="fa fa-trash mr-1 deletePrd red pointer text-red" id="deletePrd"  data-placement="bottom" title="delete record" ></i></th>
         </tr>
       </thead>
       <tbody>
     ';
     $n=0;
     foreach($result as $row){
       $data.='
       <tr>
         <td> '. ++$n. '</td>
         <td><img src="'. URLROOT .'/images/ '. $row->prd_image .'" class="img img-responsive img-small"></td>
         <td> <input type="text" id="name'. $row->id .'" value=" '.$row->product_name.' " class="form-control form-control-sm name"> </td>
         <td> <input type="text" id="model'.$row->id.'" value="'.$row->model.'" class="form-control form-control-sm model"> </td>
         <td> <input type="text" id="dsc'.$row->id.'" value="'.$row->dsc.'" class="form-control form-control-sm dsc"> </td>
          <input type="hidden" id="stk'.$row->id.'" value="'.$row->prd_quantity.' " >
         <td> '.$row->prd_quantity. ' </td>
         <td> <input type="text" id="price'.$row->id.'" value="'.$row->sellingprice.'" class="form-control form-control-sm price"> </td>
         <td> <input type="number" id="qnt'.$row->id.'" value="" autofocus class="form-control form-control-sm qnt"> </td>
         <td>
           <i class="fa fa-edit mr-1 updatePrd text-warning pointer" id="'.$row->id.'"  data-toggle="tooltip" data-placement="left" title="update record" ></i>
           <input type="checkbox" class="checkbox" name="box" value="'. $row->id .'">
           </small>
        </td>
       </tr>
       ';
     }
     $data.='
         </tbody>
       </table>
     ';
   }
   jsonEncode($data);
 }
 if(isset($_POST['loadProductStuck'])){
   $db= new Database;
   $txt=escapeString($_POST['txt']);
   $db->query("SELECT * FROM ".PRD_TBL." WHERE product_name LIKE ? OR model LIKE ?
              OR dsc LIKE ? OR sellingprice LIKE ? ORDER BY updated_on DESC LIMIT 50");
   $db->bind(1,"%$txt%");
   $db->bind(2,"%$txt%");
   $db->bind(3,"%$txt%");
   $db->bind(4,"%$txt%");
   $result=$db->resultSet();
   $data='';
   if($db->rowCount() >0){
     $data='
     <table class="table table-hover table-striped table-bordered small">
       <thead>
       <tr class="small">
          <th width="5%">S/N</th>
          <th width="50%">NAME</th>
          <th width="25%">MODEL</th>
          <th width="20%">CATEGORY</th>
       </tr>
       </thead>
       <tbody>
     ';
     $n=0;
     foreach($result as $row){
       $data.='
       <tr class="small">
         <td>'. ++$n .'</td>
         <td>'. $row->product_name .'</td>
         <td><a href="'. URLROOT .'/products/card/'. $row->id .'">'. $row->model .'</td>
         <td>'. $row->category .'</td>
       </tr>
     </a>
       ';
     }
     $data.='
         </tbody>
       </table>
     ';
   }
   jsonEncode($data);
 }
 if(isset($_POST['loadProductOnDamage'])){
   $db= new Database;
   $txt=escapeString($_POST['txt']);
   $db->query("SELECT * FROM ".PRD_TBL." WHERE product_name LIKE ? OR model LIKE ?
              OR dsc LIKE ? OR sellingprice LIKE ? ORDER BY product_name ASC LIMIT 50");
   $db->bind(1,"%$txt%");
   $db->bind(2,"%$txt%");
   $db->bind(3,"%$txt%");
   $db->bind(4,"%$txt%");
   $result=$db->resultSet();
   $data='';
   if($db->rowCount() >0){

     $data.='
     <table class="table table-hover table-striped table-bordered small">
       <thead>
         <tr>
           <th width="2%">S/N</th>
           <th width="5%">Image</th>
           <th width="20%">Product Name</th>
           <th width="14%">Model</th>
           <th width="25%">Description</th>
           <th width="5%">Stuck</th>
           <th width="8%">Price '. UNIT .'</th>
           <th width="8%">Qnt</th>
           <th width="11%">New Value '. UNIT .'</th>
           <th width="2%"></th>
         </tr>
       </thead>
       <tbody>
     ';
     $n=0;
     foreach($result as $row){
       $data.='<tr>
         <td>'. ++$n .'</td>
         <td><img src="'. URLROOT .'/images/'.$row->prd_image .'" class="img img-responsive img-small"></td>
         <td> '.$row->product_name .' </td>
         <td> '. $row->model .' </td>
         <td> '. $row->dsc .'</td>
         <td align="right"> '. $row->prd_quantity .' </td>
         <td align="right">'. number_format($row->sellingprice,2) .' </td>
         <td> <input type="text" id="qnt'. $row->id .'" value="" autofocus class="form-control form-control-sm qnt"> </td>
         <td> <input type="text" id="price'. $row->id .'" value="" class="form-control form-control-sm price"> </td>
         <td>
           <i class="fa fa-edit mr-1 moveProduct red pointer text-red" id="'. $row->id .'" data-toggle="tooltip" data-placement="bottom" title="delete record" ></i></small>
        </td>
       </tr>';
     }
     $data.='
         </tbody>
       </table>
     ';
   }
   jsonEncode($data);
 }

 if(isset($_POST['returnItem'])){
   $db= new Database;
   $db->query("SELECT sellingprice, product_name,model FROM ".PRD_TBL." WHERE id=? ");
   $db->bind(1,escapeString($_POST['id']));
   $row=$db->single();
   $result='
          <div class="form-group">
          <input type="hidden" name="id[]" value="'.escapeString($_POST['id']).'">
            <div class="input-group">
              <input type="text" class="form-controls form-control-sm" style="width:65%" name="" value="'.$row->model.' -> '.$row->product_name.'">
              <input type="number" class="form-controls form-control-sm" style="width:20%" name="price[]" value="'.$row->sellingprice.'">
              <input type="number" class="form-controls form-control-sm" name="qnt[]" style="width:15%" value="1">
            </div>
          </div>
          ';
   jsonEncode($result);
 }
