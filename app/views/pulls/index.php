<?php include_once(APPROOT.'/views/inc/header.php');?>
<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-md-6">

    </div>
    <div class="col-md-6">
      <p><button type= "button" data-bs-toggle="modal" data-bs-target="#quickPullModal" class="btn btn-primary">Quick Pull </button></p>
      <p> <a href="<?php echo URLROOT ?>/pulls/resgistered"><button type= "button" class="btn btn-primary"> Create Pre Registration Pull </button></a> </p>
      <p> <a href="<?php echo URLROOT ?>/pulls/create"><button type= "button" class="btn btn-primary">Create Randown key Pull </button></a> </p>
      <p> <a href="<?php echo URLROOT ?>/pulls/create"><button type= "button" class="btn btn-primary">CREATE Create Open Pull </button></a> </p>
      <p> <a href="<?php echo URLROOT ?>/pulls/create"><button type= "button" class="btn btn-primary">CREATE Create Open Pull </button></a> </p>
      <p> <a href="<?php echo URLROOT ?>/pulls/create"><button type= "button" class="btn btn-primary">CREATE Create Open Pull </button></a> </p>

    </div>
  </div>
</div>
<?php include_once(APPROOT.'/views/inc/footer.php');?>

<script type="text/javascript">
  $(document).ready(function(){
    $('#addMoreOption').click(function(){

    });
  });
</script>

<!-- Modal -->
<div class="modal fade" id="quickPullModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-scrollable">
    <div class="modal-content">
      <div class="bg-light modal-header p-3">
        <h5 class="modal-title pull-left mr-3" id="exampleModalLabel">Quick Pull </h5>
        <button type="button" class="btn btn-sm iSurveyColor ml-3" id ="addMoreOption"> <i class="fa fa-plus ml-3"></i> </button>
        <button type="button" class="btn-close pull-right" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="quickPullForm" class="modalForm">
          <div class="form-group">
            <label>Caption: <i class="redColor">*</i> </label>
            <input type="text" class="form-control form-control-sm" placeholder="Pull Caption" name="caption" value="">
          </div>
          <div class="form-group">
            <label>Description:</label>
            <textarea type="text" class="form-control form-control-sm" placeholder="Description optional" name="dsc" value=""></textarea>
          </div>
          <fieldset class="border p-2 mt-1">
            <legend class="small">Options</legend>
            <div id="quickOption">
              <div class="input-group mb-2" id="input_c_1">
                <input type="text" class="form-control form-control-sm" placeholder="Pull Caption" name="caption" value="">
                <i class="fa fa-times-circle ml-2" id="_c_1"></i>
              </div>
              <div class="input-group mb-2 " id="input_c_2">
                <input type="text" class="form-control form-control-sm mr-2" placeholder="Pull Caption" name="caption" value="">
                <i class="fa fa-times-circle ml-2" id="_c_2"></i>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary modalClose" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="">Save changes</button>
      </div>
    </div>
  </div>
</div>
