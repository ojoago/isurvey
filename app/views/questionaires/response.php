<?php include_once(APPROOT.'/views/inc/header.php');?>
<style media="screen">

</style>
<div class="container mt-2">
  <div id="formContent"></div>
</div>

<?php include_once(APPROOT.'/views/inc/footer.php');?>
<script>
 $(document).ready(function(){
   loadForm();
   function loadForm(){
     $.ajax({
       url:"<?php echo URLROOT ?>/function/responseHelper.php",
       type:"POST",
       data:{loadFormByid:true},
       success:function(data){
         $('#formContent').html(data);
       }
     });
   }
   // submit response
   $(document).on('click','#responseFormBtn',function(){
     var form=$('#responseForm');
     $.ajax({
       url:"<?php echo URLROOT ?>/questionaires/formSubmission",
       type:"POST",
       data:{submitForm:true,form:form.serialize()},
       success:function(msg){
         if(msg=='success'){
           $('#responseForm')[0].reset();
         }
         console.log(msg);
       }
     });
   });
 });
</script>
