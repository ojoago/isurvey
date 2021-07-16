<?php include_once(APPROOT.'/views/inc/header.php');?>
<style media="screen">
  body{
    position: relative;
  }
  #questions{
    position: relative;
  }
  .formController{
    right: 0 !important;
    position: fixed;
    z-index: 1;
    padding: 5px;
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

              <div class="formController" id="formController">
                <div id="nextQuestion"></div>
                <div class="dropdown-divider"></div>
                <i class="fa fa-columns mr-1 pointer" id="createSection"> Section</i>
                <div class="dropdown-divider"></div>
                <a href="<?php echo URLROOT ?>/questionaires/template"><i class="fa fa-question-circle mr-1 pointer"></i>New Form</a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo URLROOT .'/questionaires/response/'.@$_SESSION['formId'];?>">Preview</a>
                <div class="dropdown-divider"></div>
              </div>
              <legend  class="w-auto small text-center" style="float:center"> <label>Questions</label> </legend>
              <div class="" id="formHeader"></div>
            </fieldset>
            <fieldset id="fieldset"></fieldset>
          </div>
          <!-- second tab | response -->
          <div class="tab-pane fade in" id="response">
            <fieldset class="border p-4">
              <legend  class="w-auto small"> Response</legend><br>
              <select class="" name="" id="changeView">
                <option disabled selected>Display Mode</option>
                <option value="QAR">Question and Response</option>
                <option value="OAR">Option and Response</option>
                <option value="OARD">Option and Response and date</option>
              </select>
              <button type="button" id="exportPDF" class="btn btn-warning btn-sm exportBtn">PDF</button>
              <button type="button" id="exportCSV" class="btn btn-success btn-sm exportBtn">CSV</button>
              <div class="table table-responsive" id="resultTable">

                  <div id="tableContent"></div>

              </div>
            </fieldset>
          </div>
        </div>
      </div>
    </div>
</div>
<script src="<?php echo URLROOT;?>/js/custom/jquery-3.3.1.slim.min.js"></script>
<?php include_once(APPROOT.'/views/inc/footer.php');?>
<script src="<?php echo URLROOT;?>/js/custom/jspdf.min.js"></script>
<script src="<?php echo URLROOT;?>/js/custom/jspdf.plugin.autotable.min.js"></script>
<script src="<?php echo URLROOT;?>/js/custom/tableHTMLExport.js"></script>

<script>
  $(document).ready(function(){
    function scrollToSection(section){
      document.getElementById(section).scrollIntoView({behavoir :"smooth"});
    }
    $('#changeView').change(function(){
      var type=$(this).val();
      $.ajax({
        url:"<?php echo URLROOT ?>/html_helpers/formsHelper.php",
        type:"POST",
        data:{changeResponseType:true,type:type},
        success:function(data){
          $('#tableContent').html(data);
        }
      });
    });
    loadResponse();
    function loadResponse(){
      $.ajax({
        url:"<?php echo URLROOT ?>/html_helpers/formsHelper.php",
        type:"POST",
        data:{loadResponse:true},
        success:function(data){
          $('#tableContent').html(data);
        }
      });
    }

    // export result
    $('#exportPDF').click(function(){
      $('#resultTable').tableHTMLExport({
        type:'pdf',
        filename:'sample.pdf'
      });
    });
    $('#exportCSV').click(function(){
      exportTableToCSV('simpxxxx.csv');
    });
    function exportTableToCSV(simp) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");

    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        for (var j = 0; j < cols.length; j++)
            row.push(cols[j].innerText);
        csv.push(row.join(","));
    }
    // Download CSV file
    downloadCSV(csv.join("\n"), simp);
}
function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;
    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});
    // Download link
    downloadLink = document.createElement("a");
    // File name
    downloadLink.download = filename;
    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);
    // Hide download link
    downloadLink.style.display = "none";
    // Add the link to DOM
    document.body.appendChild(downloadLink);
    // Click download link
    downloadLink.click();
}
    // response stop here
    formHeader()
    // create new form if not Exist
    function formHeader(id=0){
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{editFrom:true,formId:id},
        success:function(data){
          loadFormHeader(data);
        }
      });
    }
    // load form
    function loadFormHeader(id){
      $.ajax({
        url:"<?php echo URLROOT ?>/html_helpers/formsHelper.php",
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
        url:"<?php echo URLROOT ?>/html_helpers/formsHelper.php",
        type:"POST",
        data:{loadQuestionHeader:true,id:id},
        success:function(data){
          $('#questionHeader').html(data);
        }
      });
    }
    // create form section
    $('#createSection').click(function(){
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{createFormSection:true},
        success:function(data){
          location.reload();
        }
      });
    });
    // update section description
    $(document).on('change','.sectionHeader',function(){
      var txt=$(this).val();
      var id=$(this).attr('id');
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{updateFormSection:true,id:id,txt:txt},
        success:function(){}
      });
    });
    // remove section
    $(document).on('click','.removeSection',function(){
      var id=$(this).attr('id');
      $('#activeSectionId').val(id);
      $('#removingSection').modal('show');
    });
    $('#mergeSection').click(function(){
      var id=$('#activeSectionId').val();
      $('#mergeSectionId').val(id);
      $.ajax({
        url:"<?php echo URLROOT ?>/html_helpers/formsHelper.php",
        type:"POST",
        data:{loadSectionToMerge:true,id:id},
        success:function(data){
          $('#availableSection').html(data);
          $('#removingSection').modal('hide');
          $('#mergeSectionModal').modal('show');
        }
      });
    });
    // merge section
    $('#mergeSectionBtn').click(function(){
      var form=$('#mergeSectionForm');
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        dataType:'JSON',
        data:{mergeSection:true,form:form.serialize()},
        success:function(data){
          if(data.error==''){
            showAlert('success')
            $('#mergeSectionForm')[0].reset();
            $('#mergeSectionModal').modal('hide');
            $('#section_'+data.id).remove();
            scrollToSection('section_'+data.section)
          }else{
            $('#mergeSectionMsg').html(data.error);
          }
        }
      });
    })
    $('#deleteSection').click(function(){
      var id=$('#activeSectionId').val();
      removeSection(id)
    });
    function removeSection(id){
      if(confirm('This will delete Section and all Questions, Options and response under it')){
        $.ajax({
          url:"<?php echo URLROOT ?>/questionaires/manageForm",
          type:"POST",
          data:{removeFormSection:true,id:id},
          success:function(id){
            $('#section_'+id).remove();
            $('#removingSection').modal('hide');
          }
        });
      }
    }
    // change question type
    $(document).on('change','.changeQuestionType',function(){
      var id=$(this).attr('id');
      var type=$(this).val();
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{changeQuestionType:true,id:id,type:type},
        success:function(id){
          reloadQuestion(id,type)
        }
      });
    });
    function reloadQuestion(qid,type){
      $.ajax({
        url:"<?php echo URLROOT ?>/html_helpers/formsHelper.php",
        type:"POST",
        data:{reloadOption:true,id:qid,type:type},
        success:function(data){
          $('#options_'+$.trim(qid)).html(data);
        }
      });
    }
    $(document).on('change','.questionNote',function(){
      var id =$(this).attr('id');
      var txt=$(this).val();
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{updateQuestionNote:true,id:id,note:txt},
        success:function(){}
      });
    });
    nextQuestionController('nextQuestion');
    function nextQuestionController(id){
      $.ajax({
        url:"<?php echo URLROOT ?>/html_helpers/formsHelper.php",
        type:"POST",
        data:{loadQuestionTypeController:true},
        success:function(data){
          $('#'+id).html(data);
        }
      });
    }
    // create question options
    $(document).on('click','.createNextOption',function(){
      id=$(this).attr('id');
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        dataType:'JSON',
        data:{createNextOption:true,id:id},
        success:function(data){
          loadMoreOption(data.id);
        }
      });
    });
    // reload question option on create
    function loadMoreOption(qid){//qid =question id, oid option id
      $.ajax({
        url:"<?php echo URLROOT ?>/html_helpers/formsHelper.php",
        type:"POST",
        data:{loadActiveOption:true,id:qid},
        success:function(data){
          $('#inputType'+qid).html(data);
        }
      });
    }
    loadFieldSet()
    // adding more question
    function loadFieldSet(){
      $.ajax({
        url:"<?php echo URLROOT ?>/html_helpers/formsHelper.php",
        type:"POST",
        data:{loadNextQuestion:true},
        success:function(data){
          $('#fieldset').html(data);
          //scrollBottom()
        }
      });
    }

    function scrollBottom(){
      $("html, body").animate({ scrollTop: 100 + $(document).height()},'slow');
    }
    $(document).on('click','.dropdown-item',function(){
      var type=$(this).attr('id');
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{createMoreQuestion:true,type:type},
        success:function(id){
          loadAddedQuestion(id)
        }
      });
    });
    function loadAddedQuestion(id){
      $.ajax({
        url:"<?php echo URLROOT ?>/html_helpers/formsHelper.php",
        type:"POST",
        data:{loadAddedQuestion:true,id:id},
        success:function(data){
          $('#fieldset').append(data);
          scrollToSection('fieldset_r'+id)
          // document.getElementById('fieldset_r'+id).scrollIntoView({behavoir :"smooth"});
        }
      });
    }

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
      if(confirm('delete ?')){
        $.ajax({
          url:"<?php echo URLROOT ?>/questionaires/manageForm",
          type:"POST",
          data:{deleteQuestionOption:true,id:id},
          success:function(data){
            $('#optionWrapper'+id).remove();
          }
        });
      }
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
    $(document).on('change','.enableComment',function(){
      var id=$(this).attr('id');
      if($(this).prop('checked')){
        var action='enable';
      }else {
        var action='';
      }
      $.ajax({
        url:"<?php echo URLROOT ?>/questionaires/manageForm",
        type:"POST",
        data:{enableComment:true,id:id,action:action},
        success:function(d){}
      });
    });
    // remove question
    $(document).on('click','.removeQuestion',function(){
      id=$(this).attr('id');
      if(confirm('delete question')){
        $.ajax({
          url:"<?php echo URLROOT ?>/questionaires/manageForm",
          type:"POST",
          data:{deleteQuestionAndOption:true,id:id},
          success:function(data){
            $('#fieldset'+id).remove();
          }
        });
      }
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
<!-- Remove section modal -->
<div class="modal fade" id="removingSection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" >Remove Section</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group text-center form" method="post">
          <input type="hidden"  id="activeSectionId">
          <button type="button" class="btn btnBox iSurveyColor" id="mergeSection"> <i class="fa fa-plus"></i> Merge</button>
          <button type="button" class="btn btnBox btn-danger"  id="deleteSection"> <i class="fa fa-trash-o"></i> Delete</button>
			</form>
      </div>
      <div class="modal-footer bg-danger">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn iSurveyColor" id="quickSurveyBtn"> <i class="fa fa-plus"></i> Save</button>
      </div>
    </div>
  </div>
</div>
<!-- Remove section modal end here -->
<!-- Merge section modal -->
<div class="modal fade" id="mergeSectionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" >Merge Section</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <span id="mergeSectionMsg"></span>
          <form class="form-group text-center form" id="mergeSectionForm">
            <input type="hidden" name="del_"  id="mergeSectionId">
           <p id="availableSection"></p>
			    </form>
      </div>
      <div class="modal-footer bg-info">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn iSurveyColor" id="mergeSectionBtn"> <i class="fa fa-plus"></i> Merge</button>
      </div>
    </div>
  </div>
</div>
<!-- Remove section modal end here -->
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
