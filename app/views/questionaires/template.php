<?php include_once(APPROOT.'/views/inc/header.php');?>
<style media="screen">
  body{
    position: relative;
  }
  #questions{
    position: relative;
  }
  #formOptionControl{
    right: 0 !important;
    position: absolute;
    z-index: 1;
  }
</style>
<div class="container mt-2">
    <div class="card mb-4">
      <div class="card-header">
        <ul class="nav nav-tabs">
    			<li class="nav-item"><a data-bs-toggle="tab" href="#questions" class="nav-link "><i class="fa fa-cog mr-1"></i>Questions </a></li>
    			<li class="nav-item"><a data-bs-toggle="tab" href="#response" class="nav-link"><i class="fa fa-user mr-1"></i> Response</a></li>
    		</ul>
      </div>
      <div class="card-body">
        <!-- tabs content -->
        <div class="tab-content">
          <!-- first tab | question -->
          <div class="tab-pane fade in show active" id ="questions">
            <fieldset class="border p-4">
              <legend  class="w-auto small text-center" style="float:center"> <label>Questions</label> </legend>
              <div class="" id="formHeader"></div>
            </fieldset>
            <div class="" id="nextQuestion"></div>
            <fieldset id="fieldset"></fieldset>
            <div class="" id="formOptionControl">
              Controller
            </div>
          </div>
          <!-- second tab | response -->
          <div class="tab-pane fade in" id="response">
            <fieldset class="border p-4">
              <legend  class="w-auto small"> Response</legend>

            </fieldset>
          </div>
        </div>
      </div>
    </div>
</div>
<?php include_once(APPROOT.'/views/inc/footer.php');?>
<script>
  $(document).ready(function(){
    formHeader(0)
    function formHeader(id){
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{editFrom:true,formId:id},
        success:function(data){
          loadFormHeader(data);
        }
      });
    }

    function loadFormHeader(id){
      $.ajax({
        url:"<?php echo URLROOT ?>/functions/formsHelper.php",
        type:"POST",
        data:{loadFormHeader:true,formId:id},
        success:function(data){
          $('#formHeader').html(data);
        }
      });
    }
    // update form name goes here
    // update form name
    $(document).on('change','#formTitle',function(){
      var note =$('#formDsc').val();
      var name=$(this).val();
      updateFormName(name,note);
    });
    $(document).on('change','#formDsc',function(){
      var name=$('#formTitle').val();
      var note=$(this).val();
      updateFormName(name,note);
    });
    function updateFormName(name,note){
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{updateFormInfo:true,name:name,note:note},
        success:function(data){
          loadFormHeader(data);
        }
      });
    }
    function loadQuestionHeader(id){
      $.ajax({
        url:"<?php echo URLROOT ?>/functions/formsHelper.php",
        type:"POST",
        data:{loadQuestionHeader:true,id:id},
        success:function(data){
          $('#questionHeader').html(data);
        }
      });
    }

    nextQuestionController('nextQuestion');
    function nextQuestionController(id){
      $.ajax({
        url:"<?php echo URLROOT ?>/functions/formsHelper.php",
        type:"POST",
        data:{loadQuestionTypeController:true},
        success:function(data){
          $('#'+id).html(data);
        }
      });
    }
    // form inputs
    function loadInput(){
      $.ajax({
        url:"<?php echo URLROOT ?>/functions/formsHelper.php",
        type:"POST",
        data:{loadFormInput:true},
        success:function(data){
          $('#inputType').append(data);
        }
      });
    }
    // create question options
    $(document).on('click','.createNextOption',function(){
      id=$(this).attr('id');
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{createNextOption:true,id:id},
        success:function(data){
          loadMoreOption(id,data);
        }
      });
    });
    // load more option on create or reload

    function loadMoreOption(qid,oid){//qid =question id, oid option id
      $.ajax({
        url:"<?php echo URLROOT ?>/functions/formsHelper.php",
        type:"POST",
        data:{loadActiveOption:true,id:oid},
        success:function(data){
          $('#inputType'+qid).append(data);
        }
      });
    }
    loadFieldSet()
    // adding more question
    function loadFieldSet(type='radio'){
      $.ajax({
        url:"<?php echo URLROOT ?>/functions/formsHelper.php",
        type:"POST",
        data:{loadNextQuestion:true,type:type},
        success:function(data){
          $('#fieldset').append(data);
        }
      });
    }

    $(document).on('click','.dropdown-item',function(){
      var type=$(this).attr('id');
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{createMoreQuestion:true,type:type},
        success:function(){
          loadFieldSet()
        }
      });
    });
    $(document).on('change','.questionTitle',function(){
      var id=$(this).attr('id');
      var qs=$(this).val();
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{updateQuestionTitle:true,id:id,question:qs},
        success:function(){}
      });
    });
    // editing question option
    $(document).on('change','.questionOption',function(){
      var id=$(this).attr('id');
      var option=$(this).val();
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{updateQuestionOption:true,id:id,option:option},
        success:function(){}
      });
    });
    // remove question option
    $(document).on('click','.removeOption',function(){
      var id =$(this).attr('id');
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{deleteQuestionOption:true,id:id},
        success:function(data){
          $('#optionWrapper'+id).remove();
        }
      });
    });

    // make question Compulsory
    $(document).on('change','.compulsoryCheck',function(){
      var id=$(this).attr('id');
      if($(this).prop('checked')){
        var action='required';
      }else {
        var action='';
      }
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{requiredCheck:true,id:id,action:action},
        success:function(){
          showAlert('State Toggled');
        }
      });
    });
    // remove question
    $(document).on('click','.removeQuestion',function(){
      id=$(this).attr('id');
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{deleteQuestionAndOption:true,id:id},
        success:function(data){
          $('#fieldset'+id).remove();
        }
      });
    });
    $(document).on('change','.questionImage',function(){
      var id=$(this).attr('id');
      data = new FormData();
      data.append('id',id)
      data.append('file',$(this)[0].files[0]);
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageImage",
        type:"POST",
        data:data,
        enctype:'multipart/form-data',
        processData:false,
        contentType:false,
        success:function(data){
          alert(data);
        }
      });
    })
    // show control btn on active fieldset
    $(document).on('click','.questionFieldset',function(){
      // $('.questionController').hide();
      var id=$(this).attr('id');
      var id =$(this).find('.questionController').attr('id');
      nextQuestionController(id)

    });
  })
</script>

<!-- Modal -->
<!-- Quick Survey modal -->
<div class="modal fade" id="quickSurveyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Quick Question</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group  form" method="post" id="quickSurveyForm">
				<div class="form-group">
					<label>Message</label><br>
				<textarea type = 'text' class='form-control form-control-sm' name = 'message' id='txta' placeholder='Text' required></textarea>
				</div>
        <div class="form-group">
          <label>Question:</label>
					<input type = "text" class="form-control form-control-sm" name="question" id="question" placeholder="Type your Question Here" required>
				</div>
				<div class="form-group">
					<label>Minimum Response:</label>
					<input type = "number" class="form-control form-control-sm" name="min_res" id="min" placeholder="Minimum Number of Response" required>
				</div>
        <div class="form-group m-2">
					<input type = "text" class="form-control form-control-sm" name="optionA" id="quickOptionA" placeholder="Option A" required>
				</div>
				<div class="form-group m-2">
					<input type = "text" class="form-control form-control-sm" name="optionB" id="quickOptionB" placeholder="Option B" required>
				</div>
				<div class="form-group m-2">
					<input type = "text" class="form-control form-control-sm" name="optionC" id="quickOptionC" placeholder="Option C" required>
				</div>
				<div class="form-group m-2">
					<input type = "text" class="form-control" name="optionD" id="quickOptionD" placeholder="Option D" required>
				</div>
				<div class="form-group m-2">
					<input type = "text" class="form-control" name="optionE" id="quickOptionE" placeholder="Option E" required>
					<input type = "hidden" class="form-control" name="questionId" id="quickQuestionId">
				</div>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn iSurveyColor" id="quickSurveyBtn"> <i class="fa fa-plus"></i> Save</button>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('#quickSurveyBtn').click(function(){
      var form=$('#quickSurveyForm');
      $.ajax({
        type:"post",
        url:"<?php echo URLROOT ?>/questionaires/quickQuestion",
        data:{submitQuickQuestion:true,form:form.serialize()},
        success:function(data){
          alert(data)
        }
      });
    });
  });
</script>
