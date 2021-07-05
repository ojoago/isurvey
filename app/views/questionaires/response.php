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
 });
</script>
