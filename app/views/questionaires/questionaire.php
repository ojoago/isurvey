<?php include_once(APPROOT.'/views/inc/header.php');?>
<div class="container-fluid mt-2">
 <div class="row">
   <div class="col-md-6">
     Total FORM <?php echo count($data['forms']) ?>
      <p>
     <?php foreach($data['forms'] as $row): ?>
      <a href="<?php echo URLROOT ?>/questionaires/edit/<?php echo $row->id ?>" class="m-2 mb-2"><button type= "button" class="btn btn-primary mb-1"><?php echo $row->title ?> </button></a>
     <?php endforeach; ?>
   </p>
   </div>
   <div class="col-md-6">
     <p> <a href="<?php echo URLROOT ?>/questionaires/template"><button type= "button" class="btn btn-primary">CREATE NEW PROJECT </button></a> </p>
     <p><button type= "button" data-bs-toggle="modal" data-bs-target="#quickSurveyModal" class="btn iSurveyColor">Quick Question</button></p>
     <p><button type= "button" class="btn iSurveyColor"> Blank Form</button></p>
     <p><button type= "button" class="btn iSurveyColor"> Form Template</button></p>
     <!-- <b class="text-info">share iSurvey with friends ON SOCIAL Media and earn</b><br>
     <a href="https://www.facebook.com/sharer/sharer.php?u=isurvey.com/guests/resgister/" target="_blank">
		<i class="fa fw fa-facebook-square fa-share fa-2x" data-toggle="tooltip" data-placement="top" title="Share on facebook!"></i></a>
    <a href="whatsapp://send?text=isurvey.com/guests/resgister" data-action="share/whatsapp/share">
		<i class="fa fa-whatsapp fa-share fa-2x" data-toggle="tooltip" data-placement="top" title="Share on whatsapp!"></i></a>
    <a href="https://twitter.com/intent/tweet?text=isurvey %20%20%20http://isurvey.com/guests/resgister" target="_blank">
		<i class="fa fa-twitter-square fa-share fa-2x" data-toggle="tooltip" data-placement="top" title="Share on twitter!"> </i></a>
		<a href ="https://www.linkedin.com/sharing/share-offsite/?url=http://isurvey.com/guests/resgister" target="_blank"> <i class="fa fw fa-linkedin-square fa-share  fa-2x" data-toggle="tooltip" data-placement="top" title="Share on linkedin!"></i></a>
		<a href ="mailto: "> <i class="fa fa-envelope fa-2x" data-toggle="tooltip" data-placement="top" title="Share on mail!"> </i></a>
		<input type="button" value="copy link" id="copylink" class="btn btn-success copylink"  data-toggle="tooltip" data-placement="top" title="Copy link to clipboard!">
		<a href ="../signup.php?link='.$id.'"> <i class="fa fa-envelope fa-2x" data-toggle="tooltip" data-placement="top" title="Share on mail!"> </i></a> -->
   </div>
 </div>
</div>
<?php include_once(APPROOT.'/views/inc/footer.php');?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('txt').click(function(){
      $('#exampleModal').modal('show')
    });
  });
</script>
