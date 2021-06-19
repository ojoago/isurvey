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
      <div class="card-header"> <?php echo userId() ?>
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
              <input type="text" name="formTitle" value="Untitled Form" class="form-control">
              <input type="text" name="fromDsc" value="" placeholder="Form Description" class="form-control">
            </fieldset>
            <fieldset class="border p-4 m-1">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-10">
                      <input type="text" name="" value="">
                      <input type="file" name="" value="">
                    </div>
                    <div class="col-md-2">
                      <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                          <input type="radio" disabled>  Dropdown button
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <li><a class="dropdown-item" href="#"> <i class="fa  fa-dot-circle-o mr-1"></i> Multi choice Select One</a></li>
                          <li><a class="dropdown-item" href="#"> <i class="fa fa-check-square mr-1"></i> Multi choice Select Many</a></li>
                          <li><a class="dropdown-item" href="#"> <i class="fa  fa-toggle-down mr-1"></i> Dropdown Select One </a></li>
                          <div class="dropdown-divider"></div>
                          <li><a class="dropdown-item" href="#"> <i class="fa fa-signal"></i> linear Scale</a></li>
                          <div class="dropdown-divider"></div>
                          <!-- <li><a class="dropdown-item" href="#"> <i class="fa fa-paragraph mr-1"></i> Paragraph</a></li> -->
                          <li><a class="dropdown-item" href="#"> <i class="fa fa-align-left"></i> Sentence</a></li>
                          <div class="dropdown-divider"></div>
                          <li><a class="dropdown-item" href="#"> <i class="fa fa-clock-o mr-1"></i> Time</a></li>
                          <li><a class="dropdown-item" href="#"> <i class="fa fa-calendar mr-1"></i> Date</a></li>
                          <!-- <li><a class="dropdown-item" href="#"><i class="fa fa-calendar mr-1"></i>Date & Time</a></li> -->
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <input type="radio" name="" value="" disabled> <input type="text" name="" value="option 1"><br>
                  <input type="radio" name="" value="" disabled> <input type="text" name="" value="option 2" disabled>
                </div>
                <div class="card-footer">
                  <i class="fa fa-trash-o pointer m-1"></i>
                  <i class="fa fa-copy pointer m-1"></i>
                  |
                  required
                  <input type="checkbox" name="" value="" data-toggle="tooltip" title="Compulsory">
                </div>
              </div>
            </fieldset>
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
    alert()
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
