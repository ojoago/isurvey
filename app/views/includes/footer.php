<style media="screen">
/* loader */
.overlay{
  display: none;
  position: fixed;
  width: 100%;
  height: 100%;
  background: #fff;
  z-index: 10;
  opacity: 0.7;
}
.loader{
  display: none;
  width: 150px;
  height: 150px;
  border-radius: 50%;
  border:10px solid #333;
  position: relative;
  margin: 0 auto;
  top:30%;
  animation:loader 2s linear infinite;
}
@keyframes loader{
  50% {
    opacity: 0.5;
  }
  100% {
    transform:rotate(360deg);
  }
}
.loader:after{
  content: "";
    width: 35px;
    height: 35px;
    background: #333;
    position: absolute;
    border-radius: 50%;
    top: -20px;
    left: 55px;
}
.loader:before{
  content: "";
    width: 0;
    height: 0;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;
    border-bottom: 15px solid #333;
    position: absolute;
    transform: rotate(-90deg);
    top: -10px;
    left: 39px;
}
/* loader stop here */
</style>
</div>
        <i class="fa fa-arrow-circle-up fa-2x" id="backToTop"  title="Back to top" data-placement="top"></i>
        <footer class="py-4 bg-light mt-auto bg-dark text-white">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-white ml-4"> &copy; <?php echo SITENAME ?>. 2020</div>
                    <div class="px-2">
                        <a href="#" class="text-white">DEVELOPED BY</a>
                        &middot;
                        <a href="#"  class="text-white">ELEVATE TECHIE</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
</div>
<div class="wait overlay">
	<div class="loader"></div>
</div>
  <?php include_once(APPROOT . '/views/inc/modals.php');?>
<script src="<?php echo URLROOT;?>/js/jquery2.js"></script>
<script src="<?php echo URLROOT;?>/js/jquery-3.4.1.min.js"></script>
<script src="<?php echo URLROOT; ?>/js/jquery-ui.js"></script>
<script src="<?php echo URLROOT;?>/js/bootstrap.min.js"></script>
<script src="<?php echo URLROOT;?>/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo URLROOT;?>/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo URLROOT;?>/js/sidebars.js"></script>
<script src="<?php echo URLROOT;?>/js/scripts.js"></script>
<script src="<?php echo URLROOT;?>/js/select2.min.js"></script>
<script src="<?php echo URLROOT; ?>/js/printThis.js"></script>
<script src="<?php echo URLROOT;?>/js/main.js"></script>
  <script type="text/javascript">
      //select 2
      $(document).ready(function(e) {
          $('select').select2();
      });
  </script>
