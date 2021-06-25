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

  if(isset($_POST['loadFormInput'])){
    input();
  }

  // function goes here

  // load question
  function loadQuestionType($type='radio'){
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
        $inputType='<div id="inputType"></div>
          <input type="radio" name="" value="" disabled> <input type="text" id="nextOption" value="Next Option" readonly>
        ';
        break;
    }
    fieldset($inputType);
  }
  function dropDown($name='Next Question'){
    $dropDown='
          <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <input type="radio" disabled>'.$name.'
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="#" id="radio"> <i class="fa  fa-dot-circle-o mr-1"></i> Multi choice Select One</a></li>
              <li><a class="dropdown-item" href="#" id="checkbox"> <i class="fa fa-check-square mr-1"></i> Multi choice Select Many</a></li>
              <li><a class="dropdown-item" href="#" id="dropdown"> <i class="fa  fa-toggle-down mr-1"></i> Dropdown Select One </a></li>
              <div class="dropdown-divider"></div>
              <li><a class="dropdown-item" href="#" id="linear"> <i class="fa fa-signal"></i> linear Scale</a></li>
              <div class="dropdown-divider"></div>
              <!-- <li><a class="dropdown-item" href="#" id="short"> <i class="fa fa-paragraph mr-1"></i> Paragraph</a></li> -->
              <li><a class="dropdown-item" href="#" id="Sentence"> <i class="fa fa-align-left"></i>Sentence</a></li>
              <div class="dropdown-divider"></div>
              <li><a class="dropdown-item" href="#" id="time"> <i class="fa fa-clock-o mr-1"></i> Time</a></li>
              <li><a class="dropdown-item" href="#" id="date"> <i class="fa fa-calendar mr-1"></i> Date</a></li>
              <!-- <li><a class="dropdown-item" href="#"><i class="fa fa-calendar mr-1"></i>Date & Time</a></li> -->
            </ul>
          </div>
    ';
    return $dropDown;
  }
  // fieldset option
  function fieldset($type=''){
    $fieldset='
        <fieldset class="border p-4 m-1 mt-3 questionFieldset" id="'.date('hism').'">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                  <div class="" id="questionHeader">
                    <input type="text" name="" class="inputBox" value="Question one">
                    <input type="file" name="" value="">
                  </div>
                </div>
                <div class="col-md-2">
                  <div>'.dropDown('Change Type').'</div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="questionNote"></div>
              '.$type.'
            </div>
            <div class="card-footer">
              <div class="" id="fieldsetBottom">
                <i class="fa fa-trash-o pointer m-1" id="removeQuestion"></i>
                  <i class="fa fa-copy pointer m-1" id="duplicateQuestion"></i>
                  |
                  required
                  <input type="checkbox" name="" value="" data-toggle="tooltip" title="Compulsory ?">
              </div>
            </div>
          </div>
        </fieldset>
    ';
    jsonEncode($fieldset);
  }

  // question type option
  function questionType($type='radio'){
    '<select>
      <option disabled selected>Change Type</option>
        <option '. $type !='radio' ?: 'selected' .' >Multi choice Select One</option>
        <option '. $type !='checkbox' ?: 'selected' .'>Multi choice Select Many</option>
        <option '. $type !='dropdown' ?: 'selected' .'>Dropdown Select One</option>
        <option '. $type !='linear' ?: 'selected' .'>linear Scale</option>
        <option '. $type !='Sentence' ?: 'selected' .'>Sentence</option>
        <option '. $type !='Time' ?: 'selected' .'>Time</option>
        <option '. $type !='Date' ?: 'selected' .'>Date</option>
    </select>';
  }

  // input option
  function input($type='radio'){
    $input='<input type="radio" name="" value="" disabled> <input type="text" name="" value="option " class ="inputBox"> <i class ="fa fa-times-circle" title="remove Option" data-bs-toggle="tooltip" data-bs-placement="right"></i> <br>';
    jsonEncode($input);
  }


  if(isset($_POST['loadNextQuestion'])){
    jsonEncode(loadQuestion());
  }
  if(isset($_POST['loadActiveOption'])){
    jsonEncode(option(escapeString($_POST['id'])));
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
  // load question and option from Database goes here
  function loadQuestion(){
    $fieldset='';
    foreach(loadFormQuestion() as $row){
      $id=$row->id;
      $question=$row->question;
      $note=$row->note;
      $option_type=$row->option_type;
      $fieldset.='
          <fieldset class="border p-4 m-1 mt-3 questionFieldset" id="fieldset_r'.$row->id.'">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-10">
                    <div class="" id="questionHeader">';
                    $fieldset.='<input type="text" name="" class="inputBox questionTitle" id="'.$row->id.'" value="'.$row->question.'">
                                <input type="file" class="questionImage" name="image" id="image'.$row->id.'" accept="image/*">';
                      if($row->type=='image') {
                        $fieldset.='<img src="'.URLROOT.'/questionImages/'.$row->path.'" id="showImage'.$row->id.'" class="questionImageDisplay img-responsive" >';
                      }
                  $fieldset.='</div>
                  </div>
                  <div class="col-md-2">
                    <div>'.dropDown('Change Type').'</div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="questionNote">'.$row->note.'</div>
                ';
                $check=$row->requires=='required' ? 'checked' : '';
                  $option = loadOptionType($id,$option_type);
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
    $option='<div class ="inputType" id="inputType'.$qid.'"></div>';
    foreach (loadOption($qid) as $rows) {
      $option.=option($rows->id,$rows->options);
    }
    $option.='
      <input type="radio" name="" value="" disabled> <input type="text" class="createNextOption" id="'.$qid.'" value="Next Option" readonly>
    ';
    return $option;
  }
