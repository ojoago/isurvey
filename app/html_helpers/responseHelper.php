<?php
  if(isset($_POST['loadFormByid'])){
    $form=loadFormHeader($_SESSION['loadresponseById']);
    $header='<div class="text-center"><h2>'.html_entity_decode($form->title).'</h2>';
    $header.='<p>'.$form->note.'</p></div>';
    $section=loadFormSection($_SESSION['loadresponseById']);
    switch($section){
      case 0 :
        $form='';
        break;
      case 1 :
        $form='';
        break;
      default:
        $form=loadQuestionSection($section);
        break;
    }
    jsonEncode($header.$form);
  }
   function loadQuestionSection($result){
     $section='<form id ="responseForm">';
     foreach($result as $row){
       $section.='
        <fieldset class="border p-2 m-1">
          <legend  class="w-auto small text-center"><h4>'.$row->dsc.'</h4> </legend><br>';
          $section.=loopFormQuestion(loadSectionQuestion($row->id));
        $section.='</fieldset>
       ';
     }
     $section.='
      <button type="button" id ="responseFormBtn" class="btn btn-sm iSurveyColor"> <i></i>Submit</button>
     </form>';
     return $section;
   }

   function loopFormQuestion($result){
     $question='';$n=0;
     foreach($result as $row){
       $question.='<fieldset class="border p-2 mb-2">';
       $src = $row->type=='image' ? '<img src="'.URLROOT.'/questionImages/'.$row->path.'" class="img img-responsive questionImage">' : '';
       $note= empty($row->note) ? '' : '<label>'.sentenceCase($row->note).'</label><br>';
       $question.=$note.$src;
       $question.='<h4>'.++$n.': '.$row->question.'</h4>';
       $question.=getQuestionType($row->id,$row->option_type,$row->requires,$row->comments) .'</fieldset>';
     }
     return $question;
   }
   function getQuestionType($id,$type,$require,$comment){
     $inputSize='form-control form-control-sm';
     switch ($type) {
       case 'linear':
         $inputType='1-10';
         $inputType.=$comment== 'enable' ? showComment($id): '';
         break;
       case 'time':
         $inputType='<input type="text" name="'.$id.'" class="datepicker '.$inputSize.'" '.$require.' placeholder="00:00" readonly>';
         $inputType.=$comment== 'enable' ? showComment($id): '';
         break;
       case 'date':
         $inputType='<input type="text" name="'.$id.'"  class="datepicker '.$inputSize.'"  '.$require.' placeholder="dd-mm-yyyy" readonly>';
         $inputType.=$comment== 'enable' ? showComment($id): '';
       break;
       case 'Sentence':
         $inputType='<textarea type="text" name="'.$id.'" class="'.$inputSize.'"  '.$require.' name="paragraph" id="paragraph" placeholder ="Paragraph" ></textarea>';
       break;
       case 'dropdown':
         $inputType=
         '<select type="text" name="'.$id.'" class="'.$inputSize.'"  '.$require.' name="paragraph"  >
              <option disabled selected> Select Option</option>
              '.loopDropDown(loadOption($id)).'
         </select>';
          $inputType.=$comment== 'enable' ? showComment($id,$type): '';
       break;
       default:
       $inputType=loopOptions(loadOption($id),$type,$require,$id);
       $inputType.=$comment== 'enable' ? showComment($id,$type): '';
       break;
     }
     return $inputType;
   }
   function showCOmment($id,$type='radio'){
      $type = $type=='checkbox' ? 'check[comment]['.$id.']' : 'comment['.$id.']' ;
     return '<h6>Please Comment</h6><textarea type="text" name="'.$type.'" class="form-control form-control-sm" placeholder ="Paragraph" ></textarea>';
   }
   function loopOptions($result,$type,$require,$id){
     $in='';
     $array=$type=='checkbox' ? 'check['.$id.'][]' : $id;
     foreach ($result as $row){
       $in.='<input type ="'.$type.'" name="'.$array.'" '.$require.' value="'.$row->options.'"> <label>'.$row->options.'</label><br>';
     }
     return $in;
   }
   function loopDropDown($result){
     $drop='';
     foreach($result as $row){
       $drop.='
       <option>'.$row->options.'</option>
       ';
     }
     return $drop;
   }
