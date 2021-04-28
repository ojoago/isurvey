<?php include_once(APPROOT.'/views/includes/header.php');?>
<div class="container-fluid mt-4">
	<p><b>VISION STARTS WITH MAKING THESIS ESSIER FOR RESEARCHERS.<p></b>
	<div id="accordion">
		<div class="card">
			<div class="card-header">
				<a class="btn btn-link collapsed" data-toggle="collapse" data-parent="#accordion" href="#all" aria-expanded="false" aria-controls="all">
				Basic </a>
			</div>
			<div id="all" class="collapse" aria-labelledby="all" data-parent="#accordion">
				<div class="card-body p-2">
					<div class="text-center brand_logo_container">
					<img src="<?php echo URLROOT ?>/isurveyimages/isurvey w.png" class="brand_logo" alt="Logo">
				</div>
					Everything on iSurvey is done by clicking button<br>
					click on any of the option below to
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				<a data-toggle="collapse" data-parent="#accordion" href="#signup">
				REGISTRATION (SIGN UP) </a>
			</div>
			<div id="signup" class="collapse">
			  <div class="card-body">
			   To signup, you simply fill the signup form and make sure your email address, names and password is correctly and click on signup button
				<br> click <a href="<?php echo URLROOT ?>/pages"> here to signup </a><br>
				<center><img src = "<?php echo URLROOT ?>/isurveyimages/signup.png" class="img img-responsive text-center"></center><br>
				On clicking the signup button your account is set.
			  </div>
			</div>
	  </div>

		<div class="card">
		<div class="card-header">
			<a data-toggle="collapse" data-parent="#accordion" href="#log"> LOGIN </a>
		</div>
		<div id="log" class="collapse">
		  <div class="card-body">
			<center><img src = "<?php echo URLROOT ?>/isurveyimages/loginin.png" class="img img-responsive text-center"></center><br>
			to login enter your email address and password and click on login button<br>click <a href="<?php echo URLROOT ?>/pages/login"> here to LOGIN </a><br>
			<center><img src = "<?php echo URLROOT ?>/isurveyimages/login.png" class="img img-responsive text-center"></center><br>
		  </div>
		</div>
	  </div>
	  <div class="card">
		<div class="card-header">
			<a data-toggle="collapse" data-parent="#accordion" href="#project">
			CREATE PROJECT </a>
		</div>
		<div id="project" class="collapse">
		  <div class="card-body">
			TO create project, you need to have an iSurvey account. to create an iSurvey account <br> click <a href="<?php echo URLROOT ?>/pages"> here to signup </a><br>
			and then login, click <a href="<?php echo URLROOT ?>/pages/login"> here to LOGIN </a><br>
			after you are logged in click on update pix on a form that will appear, then select an image of yourself that you want your respondent to
			see ontop of your question and click on update image.
			also to create project you simply click on create project button and fill a form that will appear approprietely
			<li>project title i.e the name you want to give the project for identification.</li>
			<li>project description: little introduction about the project and a mature way of asking your respondent to respond willingly.</li>
			<li>lastly minimum of response you need.</li>
		  </div>
		</div>
	  </div>
	  <div class="card">
		<div class="card-header">
			<a data-toggle="collapse" data-parent="#accordion" href="#form">
			CREATE FORM </a>
		</div>
		<div id="form" class="collapse">
		  <div class="card-body">
			To create form you must have an existing project, then click on continue.
			on clicking on continue three buttons will appear, from there you can select either <li>multiple choice question: more than two options (up to five options). or </li?\>
			<li>YES or NO question</li>
			on clicking on any of the button, a form will appear: fill the form as many times as you want and your question will be done.
		  </div>
		</div>
	  </div>
	  <div class="card">
		<div class="card-header">
			<a data-toggle="collapse" data-parent="#accordion" href="#continue">
			VIEW PROJECT </a>
		</div>
		<div id="continue" class="collapse">
		  <div class="card-body">
			To view project again click on continue, three buttons will appear, click on <b>VIEW RESPONSE</b>
		  </div>
		</div>
	  </div>
	  <div class="card">
		<div class="card-header">
			<a data-toggle="collapse" data-parent="#accordion" href="#share">
			SHARE LINK ON SOCIAL MEDIA </a>
		</div>
		<div id="share" class="collapse">
		  <div class="card-body">
			you can also earn by telling people about iSurvey.<br>
			share iSurvey  with friends on social media<br>
			<center><img src = "<?php echo URLROOT ?>/isurveyimages/share isurvey.png" class="img img-responsive text-center"></center><br><br>
			You can share your project with FAF on social media also.<br>
			To share a project click on continue on the project title, then click on view response under update pix then
			scroll down a little and click on any social media icon to share e.g facebook, whatsapp, twitter, linkedin,
			E-mail.<br>
			<center><img src = "<?php echo URLROOT ?>/isurveyimages/share project.png" class="img img-responsive text-center"></center><br><br>
		  </div>
		</div>
	  </div>
	  <div class="card">
		<div class="card-header">
			<a data-toggle="collapse" data-parent="#accordion" href="#analysis">
			REPORT AND ANALYSIS</a>
		</div>
		<div id="analysis" class="collapse">
		  <div class="card-body">
			To view report and analysis of a project, click on continue under the project title, then click on view response
			 then you will the project title and a delete and edit icon next to it. Below it, is your minimum response i.e once the number of response reaches the number you will receive an E-mail notification.
			 under it they is link to preview a project as it will appear to your respondent.
			 then under share on social media icon they are three buttons <ol><li>analyse</li><li> manage </li><li>copy link </li></ol>
			 <h3 class = "text-center"> ANALYSE</h3>
			 click on analyse the system will do the analysis and give you the result in a tabler form with buttons un the top that will allow you to export the report to word document and excel.
			 <center><img src = "<?php echo URLROOT ?>/isurveyimages/report analysis.png" class="img img-responsive text-center"></center><br>
			 <h3 class = "text-center">MANAGE</h3>
			 clicking the manage button will show you all the question(s) on the project with delete and edit icon.
			 <br>
			 click on delete icon to remove a question and edit to modify a question.
			  <center><img src = "<?php echo URLROOT ?>/isurveyimages/manage project.png" class="img img-responsive text-center"></center>
			<h3 class = "text-center">COPY LINK</h3>
			The copy link is an alternative to share on social media.<br>
			you can copy a project link to your clipboard and paste it as text link on various chat platform:
			messanger, whatsapp, facebook, twitter, instagram, linkedin and even as text message etc.
		  </div>
		</div>
	  </div>

	</div>
	<P >if there is anything you understand feel free to contact us</p>
	please help us improve by sending suggestion and critics via mail! <br>
						<a href ="mailto:isurvey@gmail.com?subject=me&body= "><input type="button" class="btn btn-success createAccount" value="TELL us how to improve"></a>
	</div>

</div>

<!-- <section class = "container ovm mt-4">

	  <div class="card">
		<div class="card-header">
		  <h4 class="card-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#log"> LOGIN </a>
		  </h4>
		</div>
		<div id="log" class="collapse">
		  <div class="card-body">
			<center><img src = "<?php echo URLROOT ?>/isurveyimages/loginin.png" class="img img-responsive text-center"></center><br>
			to login enter your email address and password and click on login button<br>click <a href="<?php echo URLROOT ?>/pages/login"> here to LOGIN </a><br>
			<center><img src = "<?php echo URLROOT ?>/isurveyimages/login.png" class="img img-responsive text-center"></center><br>
		  </div>
		</div>
	  </div>
	  <div class="card">
		<div class="card-header">
		  <h4 class="card-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#project">
			CREATE PROJECT </a>
		  </h4>
		</div>
		<div id="project" class="collapse">
		  <div class="card-body">
			TO create project, you need to have an iSurvey account. to create an iSurvey account <br> click <a href="<?php echo URLROOT ?>/pages"> here to signup </a><br>
			and then login, click <a href="<?php echo URLROOT ?>/pages/login"> here to LOGIN </a><br>
			after you are logged in click on update pix on a form that will appear, then select an image of yourself that you want your respondent to
			see ontop of your question and click on update image.
			also to create project you simply click on create project button and fill a form that will appear approprietely
			<li>project title i.e the name you want to give the project for identification.</li>
			<li>project description: little introduction about the project and a mature way of asking your respondent to respond willingly.</li>
			<li>lastly minimum of response you need.</li>
		  </div>
		</div>
	  </div>
	  <div class="card">
		<div class="card-header">
		  <h4 class="card-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#form">
			CREATE FORM </a>
		  </h4>
		</div>
		<div id="form" class="collapse">
		  <div class="card-body">
			To create form you must have an existing project, then click on continue.
			on clicking on continue three buttons will appear, from there you can select either <li>multiple choice question: more than two options (up to five options). or </li?\>
			<li>YES or NO question</li>
			on clicking on any of the button, a form will appear: fill the form as many times as you want and your question will be done.

		  </div>
		</div>
	  </div>
	  <div class="card">
		<div class="card-header">
		  <h4 class="card-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#continue">
			VIEW PROJECT </a>
		  </h4>
		</div>
		<div id="continue" class="collapse">
		  <div class="card-body">
			To view project again click on continue, three buttons will appear, click on <b>VIEW RESPONSE</b>

		  </div>
		</div>
	  </div>
	  <div class="card">
		<div class="card-header">
		  <h4 class="card-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#share">
			SHARE LINK ON SOCIAL MEDIA </a>
		  </h4>
		</div>
		<div id="share" class="collapse">
		  <div class="card-body">
			you can also earn by telling people about iSurvey.<br>
			share iSurvey  with friends on social media<br>
			<center><img src = "<?php echo URLROOT ?>/isurveyimages/share isurvey.png" class="img img-responsive text-center"></center><br><br>
			You can share your project with FAF on social media also.<br>
			To share a project click on continue on the project title, then click on view response under update pix then
			scroll down a little and click on any social media icon to share e.g facebook, whatsapp, twitter, linkedin,
			E-mail.<br>
			<center><img src = "<?php echo URLROOT ?>/isurveyimages/share project.png" class="img img-responsive text-center"></center><br><br>
		  </div>
		</div>
	  </div>
	  <div class="card">
		<div class="card-header">
		  <h4 class="card-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#analysis">
			REPORT AND ANALYSIS</a>
		  </h4>
		</div>
		<div id="analysis" class="collapse">
		  <div class="card-body">
			To view report and analysis of a project, click on continue under the project title, then click on view response
			 then you will the project title and a delete and edit icon next to it. Below it, is your minimum response i.e once the number of response reaches the number you will receive an E-mail notification.
			 under it they is link to preview a project as it will appear to your respondent.
			 then under share on social media icon they are three buttons <ol><li>analyse</li><li> manage </li><li>copy link </li></ol>
			 <h3 class = "text-center"> ANALYSE</h3>
			 click on analyse the system will do the analysis and give you the result in a tabler form with buttons un the top that will allow you to export the report to word document and excel.
			 <center><img src = "<?php echo URLROOT ?>/isurveyimages/report analysis.png" class="img img-responsive text-center"></center><br>
			 <h3 class = "text-center">MANAGE</h3>
			 clicking the manage button will show you all the question(s) on the project with delete and edit icon.

			 <br>
			 click on delete icon to remove a question and edit to modify a question.
			  <center><img src = "<?php echo URLROOT ?>/isurveyimages/manage project.png" class="img img-responsive text-center"></center>
			<h3 class = "text-center">COPY LINK</h3>
			The copy link is an alternative to share on social media.<br>
			you can copy a project link to your clipboard and paste it as text link on various chat platform:
			messanger, whatsapp, facebook, twitter, instagram, linkedin and even as text message etc.

		  </div>
		</div>
	  </div>

	</div>
	<P >if there is anything you understand feel free to contact us</p>
	please help us improve by sending suggestion and critics via mail! <br>
						<a href ="mailto:isurvey@gmail.com?subject=me&body= "><input type="button" class="btn btn-success createAccount" value="TELL us how to improve"></a>
</section> -->

<?php include_once(APPROOT.'/views/inc/footer.php');?>
