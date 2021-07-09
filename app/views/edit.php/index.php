<?php include_once(APPROOT.'/views/inc/header.php');?>
<div class="container-fluid mt-2">
 <div class="row">
   <div class="col-md-6">

   </div>
   <div class="col-md-6">
     <p> <a href="<?php echo URLROOT ?>/pulls/create"><button type= "button" class="btn btn-primary">CREATE NEW PROJECT </button></a> </p>
     <p><button type= "button" data-bs-toggle="modal" data-bs-target="#quickSurveyModal" class="btn iSurveyColor">Quick Question</button></p>
     <p><button type= "button" class="btn iSurveyColor"> Blank Form</button></p>
     <p><button type= "button" class="btn iSurveyColor"> Form Template</button></p>
   </div>
 </div>
</div>
<?php include_once(APPROOT.'/views/inc/footer.php');?>
