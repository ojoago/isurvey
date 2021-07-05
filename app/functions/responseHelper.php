<?php
  if(isset($_POST['loadFormByid'])){
    $form=loadFormHeader($_SESSION['loadresponseById']);
    $header='<div class="text-center"><h2>'.$form->title.'</h2>';
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
     $section='';
     foreach($result as $row){
       $section.='
        <fieldset class="border p-2 m-1">
          <legend  class="w-auto small text-center"><h4>'.$row->dsc.'</h4> </legend><br>';
          $section.=loopFormQuestion(loadSectionQuestion($row->id));
        $section.='</fieldset>
       ';
     }
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
       $question.=getQuestionType($row->id,$row->option_type,$row->requires) .'</fieldset>';
     }
     return $question;
   }
   function getQuestionType($id,$type,$require){
     $inputSize='form-control form-control-sm';
     switch ($type) {
       case 'linear':
         $inputType='1-10';
         break;
       case 'time':
         $inputType='<input type="text" name="'.$id.'" class="datepicker '.$inputSize.'" '.$require.' placeholder="00:00" readonly>';
         break;
       case 'date':
         $inputType='<input type="text" name="'.$id.'"  class="datepicker '.$inputSize.'"  '.$require.' placeholder="dd-mm-yyyy" readonly>';
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
       break;
       // case 'checkbox':
       //   $inputType='<textarea type="text" class="'.$inputSize.'"  '.$require.' name="paragraph" id="paragraph" placeholder ="Paragraph" ></textarea>';
       // break;
       default:
       $inputType=loopOptions(loadOption($id),$type,$require,$id);
       break;
     }
     return $inputType;
   }
   function loopOptions($result,$type,$require,$id){
     $in='';
     foreach ($result as $row){
       $in.='<input type ="'.$type.'" name="'.$id.'" '.$require.'> <label>'.$row->options.'</label><br>';
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
