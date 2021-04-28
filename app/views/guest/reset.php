<?php include_once(APPROOT . '/views/includes/header.php');?>
<style>
  body{
    background-color: #f1f2f3;
    background:url('<?php echo URLROOT; ?>/images/meters/conlog-3.jpg');
    height: 100% !important;
  }
  .card-body{
    background:url('<?php echo URLROOT; ?>/images/t7logo.png');
    margin-top: auto;
    margin-bottom: auto;
    background: #fff !important;
    position: relative;
    display: flex;
    justify-content: center;
    flex-direction: column;
    padding: 15px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 5px;
    margin-bottom:10px;
    border:solid #f1f1f1 3px;
  }
h2{
	color:#c74c3c;
}
.card-body form{
  margin: 10px;
  padding: 20px;
  margin-bottom: 50px;
}
.card-body form .form-controls{
	border:none;
	background:#fff;
	border-bottom:2px solid #c74c3c !important;
	margin-bottom: 10px;
  align-content: center;
	width:85%;
	height:50px;
  border-radius: 3px;
}
.card-body form .form-controls:focus {
	box-shadow: none !important;
	outline: 0px !important;
	background:#fff;
}
.button{
	margin-top:20px;
	width:100%;
	font-weight:bold;
	color:white;
	cursor:pointer;
	padding:10px 5px;
}

.btn-success{
	background:#c74c3c !important;
	border:0 none;
	padding:10px 5px;
}
.btn-success:hover,.btn-success:hover, .btn-success:focus,.btn-success:focus{
	box-shadow:0 0 0 2px white, 0 0 0 3px #27ae60;
	color:  #27ae60;
}
u{
  font-size: 14px;
  font-weight: bold;
  color: #444 !important;
}
.invalid-feedback{
  color:#000 !important;
  font-weight:bolder;
}
@media screen and (max-width:450px){
  .card-body form{
      margin: 1px !important;
      padding: 5px !important;
      margin-bottom: 10px;
    }
    .card-body form .form-controls{
      width:99%;
      height:50px;
      border-radius: 3px;
  }
  .btn-success{
	padding:3px 3px;
}
}
</style>

<div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
            <?php flash('register_success'); ?>
                <h2 class="text-center">Reset Password</h2>
                <form action="<?php echo URLROOT;?>/Guests/reset/<?php echo $data['id']; ?>" method="post">
                    <div class="form-group">
                        <i class="fa fa-lock fa-1x red"> *</i>
                        <input type="password" required name= "pwd" id="pwd" placeholder="Password" class="form-controls form-control-small <?php echo(!empty($data['pwd_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pwd']; ?>">
                        <i id="togglePwd" class="fa fa-eye pointer"  data-toggle="tooltip" title="toggle password" data-placement="top"></i><span class="invalid-feedback"><?php echo $data['pwd_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-lock fa-1x red"> *</i>
                        <input type="password" required name= "cpwd" id="cpwd" placeholder="Confim Password" class="form-controls form-control-small <?php echo(!empty($data['cpwd_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['cpwd']; ?>">
                        <span class="invalid-feedback" id="cpwd_err"><?php echo $data['pwd_err']; ?></span>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $capcha=avaterTxt(); ?>
                            <img class="img img-responsive" src="<?php echo URLROOT;?>/Guests/avater/<?php echo $capcha;?>">
                            <input type="hidden" name= "avater" id="avater" value="<?php echo $capcha ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name= "confirmavater" class="form-control  <?php echo(!empty($data['avater_err'])) ? 'is-invalid' : ''; ?>" id="confirmavater" required>
                            <span class="invalid-feedback"><?php echo $data['avater_err']; ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="submit" value="Reset" id"btn" class="btn btn-success btn-block ">
                        </div>
                        <!-- <div class="col"><a href="<php echo URLROOT;?>/guests/register" class="btn btn-light btn-block">No Account? Register</a></div> -->

                    </div>
                    <!-- <u class="pointer" id="forget" data-toggle="tooltip" title="Reset Password" data-placement="top">Forget Password?</u> -->
                </form>
            </div>
        </div>
    </div>

<?php include_once(APPROOT . '/views/includes/footer.php');?>

<script>
  $(document).ready(function(){
    // $('#confirmavater').keyup(function(){
    //   var avater=$('#avater').val();
    //   var txt=$(this).val();
    //   if(avater===txt){
    //     $('#btn').show(500);
    //   }else{$('#btn').hide(500);}
    // });
    // $('#cpwd').keyup(function(){
    //   var cpwd=$(this).val();
    //   var pwd=$("#pwd").val();
    //   console.log(cpwd);
    //   if(cpwd!==pwd){
    //     $('#btn').hide(500);
    //   }else{$('#btn').show(500);}
    // });
  });
</script>
