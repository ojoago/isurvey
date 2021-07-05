<?php
  // load form header

  if(isset($_POST['loadFormHeader'])){
    $form =loadFormHeader(escapeString($_POST['formId']));
    $header='
      <input type="text" name="formTitle" id="formTitle" value="'.$form->title.'" class="form-control inputBox">
      <textarea type="text" name="formDsc" id="formDsc" placeholder="Form Description" class="form-control">'.$form->note.'</textarea>
    ';
    jsonEncode($header);
  }

  // load question type Controller
  if(isset($_POST['loadQuestionTypeController'])){
    jsonEncode(dropDown());
  }

  // function goes here
  function select($id,$val=''){
    $select='<select class="select changeQuestionType" name="changeType" id="qtype'.$id.'">
      <option disabled selected>Change Question Type</option>
      <option value="radio"><i class="fa  fa-dot-circle-o mr-1"></i> Multi choice Select One</option>
      <option value="checkbox"><i class="fa fa-check-square mr-1"></i> Multi choice Select Many</option>
      <option value="dropdown"><i class="fa  fa-toggle-down mr-1"></i> Dropdown Select One </option>
      <option value="linear"><i class="fa fa-signal"></i> linear Scale</a> </option>
      <option value="Sentence"><i class="fa fa-align-left"></i>Sentence </option>
      <option value="time"><i class="fa fa-clock-o mr-1"></i> Time</a></option>
      <option value="date"><i class="fa fa-calendar mr-1"></i> Date </option>
    </select>';
    return $select;
  }

  if(isset($_POST['loadNextQuestion'])){
    jsonEncode(wrapSection(loadFormSection($_SESSION['formId'])));
  }
  if(isset($_POST['loadAddedQuestion'])){
    jsonEncode(loadQuestion(loadSingleQuestion(escapeString($_POST['id']))));
  }
  if(isset($_POST['reloadOption'])){
    jsonEncode(loadOptionType(escapeString($_POST['id']),$_POST['type']));
  }
  if(isset($_POST['loadActiveOption'])){
    jsonEncode(loadQuestionOption(escapeString($_POST['id'])));
  }
  function wrapSection($result){
    $section='';
    foreach($result as $row){
      $dsc=$row->dsc=='' ? '' :
      '<input type ="text" value="'.$row->dsc.'" class="inputBox form-control form-content-sm sectionHeader" id="s_'.$row->id.'">';
      $section .='
        <fieldset class ="border p-2 m-1 mt-3 sectionWrapper" id="section_'.$row->id.'">
        <legend class="w-auto small">'.$dsc.'</legend>
        '.loadQuestion(loadSectionQuestion($row->id)).'
        </fieldset>
      ';
    }
    return $section;
  }

  // load section question
  // load question and option from Database goes here
  function loadQuestion($result){
    $fieldset='';
    foreach($result as $row){
      $fieldset.='
          <fieldset class="border p-4 m-1 mt-3 questionFieldset" id="fieldset_r'.$row->id.'">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-9">
                    <div class="" id="questionHeader">';
                    $fieldset.='<input type="text" name="" class="inputBox questionTitle" id="'.$row->id.'" value="'.$row->question.'">
                                <input type="file" class="questionImage" name="image" id="image'.$row->id.'" accept="image/*">';
                      if($row->type=='image') {
                        $fieldset.='<img src="'.URLROOT.'/questionImages/'.$row->path.'" id="showImage'.$row->id.'" class="questionImageDisplay img-responsive" >';
                      }
                  $fieldset.='</div>
                  </div>
                  <div class="col-md-3">
                    <div>'.select($row->id).'</div>
                  </div>
                </div>
              </div>
              <div id="questionNote"> <input type ="text" class="questionNote" id="_n_'.$row->id.'" value="'.$row->note.'"></div>
              <div class="card-body" id="options_'.$row->id.'">';
                $check=$row->requires=='required' ? 'checked' : '';
                $comment=$row->comments=='true' ? 'checked' : '';
                  $option = loadOptionType($row->id,$row->option_type);
                $fieldset.=$option;
                $fieldset.='
              </div>
              <div class="card-footer">
                <div class="" id="fieldsetBottom">
                  <i class="fa fa-trash-o pointer removeQuestion m-1" id="_r'.$row->id.'"></i>
                    <i class="fa fa-copy pointer m-1" id="duplicateQuestion"></i>
                    |
                    required
                    <input type="checkbox" class="compulsoryCheck" '.$check.' id="required'.$row->id.'" data-toggle="tooltip" title="Compulsory ?">
                    Enable Comments<input type="radio" class="compulsoryCheck" '.$comment.' id="comments'.$row->id.'" data-toggle="tooltip" title="Comments ?">
                </div>
              </div>
            </div>
          </fieldset>
      ';
    }
    return $fieldset;
  }

  function loadOptionType($qid,$type='radio'){
    switch ($type) {
      case 'linear':
        $inputType='1-10';
        break;
      case 'time':
        $inputType='<input type="text" value="00:00" readonly>';
        break;
      case 'date':
        $inputType='<input type="text"  value="dd-mm-yyyy" readonly>';
      break;
      case 'Sentence':
        $inputType='<textarea type="text" name="paragraph" id="paragraph" placeholder ="Paragraph" disabled></textarea>';
      break;
      default:
      $inputType=loadQuestionOption($qid);
      break;
    }
    return $inputType;
  }
  function loadQuestionOption($qid){
    $option='<div class ="inputType" id="inputType'.$qid.'">';
    foreach (loadOption($qid) as $rows) {
      $option.=option($rows->id,$rows->options);
    }
    $option.='
      <input type="radio" name="" value="" disabled> <input type="text" class="createNextOption" id="nextOption'.$qid.'" value="Next Option" readonly>
    </div>';
    return $option;
  }
  function option($id,$option='Option'){
    $input='
      <div class="optionContainer" id="optionWrapper_'.$id.'">
      <input type="radio" name="" value="" disabled>
      <input type="text" class="inputBox questionOption" id="'.$id.'" value="'.$option.'" placeholder="option">
      <i class ="fa fa-times-circle removeOption pointer" id="_'.$id.'" title="remove Option" data-bs-toggle="tooltip" data-bs-placement="right"></i> <br>
      </div>
    ';
    return $input;
  }
// creating form stop here
