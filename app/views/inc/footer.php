

	<u height= "20"><p class = "pull-right"><b>Committed to excel</u><span class = "red"><u>lent service offering </u></span></b></p>
	<div class ="footer">
		<div class = "container-fluid">
			<div class = "row">
				<div class = "col-md-3">
					<span class= "glyphicon glyphicon-phone-alt"></span> Give us a call <P>09079585000</P>
					 <!-- <span class= "fa fa-facebook-square"></span><span> Facebook</span><p>facebook.com/iSurvey</p> -->
				</div>
				<div class = "col-md-6">
					<p><i class="fa fa-thumbs-up"></i> please help us improve... feel free to send suggestion and critics by clicking the red button below <i class="fa fa-thumb-tack"></i> </p>
					<a href ="mailto:isurvey@gmail.com?subject=me&body= "><input type="button" class="btn btn-success createAccount" value="TELL us how to improve"></a>
				</div>
					<div class = "col-md-3">
						<span class= "glyphicon glyphicon-envelope"></span> Mail Us<p>isurvey@gmail.com</p>
						 <p>info@isurvey.com</p>
						<!--<span class= "fa fa-twitter"></span> <span>Twitter</span><p>@iSurvey</p>-->
					</div>

			</div>
			<br>
			<hr>
      <center class="white"><a href="<?php echo URLROOT;?>"> HOME</a>
				<a href="<?php echo URLROOT.'/pages/about';?>"> ABOUT</a>
				<a href="<?php echo URLROOT.'/pages/help';?>"> HELP</a>
				<a href="<?php echo URLROOT.'/guests/login';?>"> LOGIN</a>
				<a href="<?php echo URLROOT.'/guests/index';?>"> SIGN UP</a></center>
		</div>
	</div>
</div>

<button  id="backToTop" title="Go to top">Top</button>
	<footer id = "footer">
	<small>
		Copyright &copy  2020 <span>All Right Reserve</span> ELEVATE TECHIE | iSurvey is a platform designed and developed by <a href="www.elevate.com">ELEVATE TECHIE</a>.
	</small>
	</footer>
  <script src="<?php echo URLROOT;?>/js/jquery2.js"></script>
  <script src="<?php echo URLROOT;?>/js/jquery-3.4.1.min.js"></script>
  <script src="<?php echo URLROOT;?>/js/popper.min.js"></script>
  <script src="<?php echo URLROOT;?>/js/bootstrap.min.js"></script>
  <script src="<?php echo URLROOT;?>/js/select2.min.js"></script>
  <script src="<?php echo URLROOT;?>/js/main.js"></script>
	<script src="<?php echo URLROOT;?>/dist/js/bootstrap.bundle.min.js"></script>
	<?php require_once('mainjs.php'); ?>
  <!-- <script src="<php echo URLROOT;?>/fontawesome/js/font-awesome.min.js"></script> -->
	<script>
			// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {scrollFunction()};

		function scrollFunction() {
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				document.getElementById("backToTop").style.display = "block";
			} else {
				document.getElementById("backToTop").style.display = "none";
			}
		}

		// When the user clicks on the button, scroll to the top of the document

	</script>
