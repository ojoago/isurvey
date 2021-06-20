<?php
  // load form header
  if(isset($_POST['loadFormHeader'])){
    $id=escapeString($_POST['formId']);
    $header='
    <input type="text" name="formTitle" id="formTitle" value="Untitled Form" class="form-control">
    <input type="text" name="formDsc" id="formDsc" value="" placeholder="Form Description" class="form-control">
    ';
    echo jsonEncode($header);
  }

  // load more fieldset
  if(isset($_POST['loadFieldSet'])){
    fieldset();
  }

  // question field and description
  if(isset($_POST['loadQuestionHeader'])){
    $input='

    ';
    jsonEncode($input);
  }
  function name_Desc(){

  }
  // load question type Controller
  if(isset($_POST['loadQuestionTypeController'])){
    $dropDown='
          <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <input type="radio" disabled>  Next Question
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="#" id="radio"> <i class="fa  fa-dot-circle-o mr-1"></i> Multi choice Select One</a></li>
              <li><a class="dropdown-item" href="#" id="checkbox"> <i class="fa fa-check-square mr-1"></i> Multi choice Select Many</a></li>
              <li><a class="dropdown-item" href="#" id="dropdown"> <i class="fa  fa-toggle-down mr-1"></i> Dropdown Select One </a></li>
              <div class="dropdown-divider"></div>
              <li><a class="dropdown-item" href="#" id="linear"> <i class="fa fa-signal"></i> linear Scale</a></li>
              <div class="dropdown-divider"></div>
              <!-- <li><a class="dropdown-item" href="#" id="short"> <i class="fa fa-paragraph mr-1"></i> Paragraph</a></li> -->
              <li><a class="dropdown-item" href="#" id="long"> <i class="fa fa-align-left"></i> Sentence</a></li>
              <div class="dropdown-divider"></div>
              <li><a class="dropdown-item" href="#" id="time"> <i class="fa fa-clock-o mr-1"></i> Time</a></li>
              <li><a class="dropdown-item" href="#" id="date"> <i class="fa fa-calendar mr-1"></i> Date</a></li>
              <!-- <li><a class="dropdown-item" href="#"><i class="fa fa-calendar mr-1"></i>Date & Time</a></li> -->
            </ul>
          </div>
    ';
    echo jsonEncode($dropDown);
  }

  if(isset($_POST['loadFormInput'])){
    input();
  }

  // question bottom controller
  if(isset($_POST['loadQuestionController'])){
    jsonEncode(questionFooter());
  }


  if(isset($_POST['loadNextQuestion'])){
    $type=escapeString($_POST['type']);
    fieldset();
  }

  // function goes here

  // load question
  function loadQuestionType($type='radio'){
    $question='';
    switch ($type) {
      case 'checkbox':
        // code...
        break;
      case 'dropdown':
        // code...
        break;
      case 'linear':
        // code...
        break;
      case 'time':
        // code...
        break;
      case 'date':
        // code...
        break;

      default:
        // code...
        break;
    }
  }
  // fieldset option
  function fieldset(){
    $fieldset='
        <fieldset class="border p-4 m-1 mt-3">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                  <div class="" id="questionHeader">
                    <input type="text" name="" value="Question one">
                    <input type="file" name="" value="">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="" id="questionTypeController"></div>

                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="inputType"></div>
              <input type="radio" name="" value="" disabled> <input type="text" id="nextOption" value="Next Option" readonly>
            </div>
            <div class="card-footer">
              <div class="" id="questionController"> '.questionFooter().'</div>
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
    $input='<input type="radio" name="" value="" disabled> <input type="text" name="" value="option "> <i class ="fa fa-times-circle" title="remove Option" data-bs-toggle="tooltip" data-bs-placement="right"></i> <br>';
    jsonEncode($input);
  }
  // fieldset footer
  function questionFooter(){
      '<i class="fa fa-trash-o pointer m-1" id="removeQuestion"></i>
        <i class="fa fa-copy pointer m-1" id="duplicateQuestion"></i>
        |
        required
        <input type="checkbox" name="" value="" data-toggle="tooltip" title="Compulsory ?">
    ';
  }
