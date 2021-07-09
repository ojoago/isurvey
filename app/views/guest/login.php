<?php include_once(APPROOT.'/views/includes/header.php');?>
<style>
  body{
    background-color: #f1f2f3;
    background:url('<?php echo URLROOT; ?>/t7images/meters/conlog-3.jpg');
    height: 100% !important;
  }
  .card-body{
    background:url('<?php echo URLROOT; ?>/t7images/t7logo.png');
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
.button,.pointer{
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
</style>
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
            <?php flash('register_success'); ?>
                <h2 class="text-center">Login</h2>
                <form action="<?php echo URLROOT;?>/guests/login" method="post">
                    <div class="form-group">
                        <!-- <label for="name">E-Mail: <sup class="text-danger red">*</sup></label> -->
                      <i class="fa fa-user fa-1x red"> *</i>  <input autocomplete="off" type="email" name= "email" placeholder="E-mail Address"class="form-controls form-control-small <?php echo(!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="dhasmom01@gmail.com<?php echo$data['email'];?>">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <!-- <label for="name">PASSWORD: <sup class="text-danger red">*</sup></label> -->
                        <i class="fa fa-lock fa-1x red"> *</i>
                        <input type="password" name= "pwd" id="pwd" placeholder="Password" class="form-controls form-control-small <?php echo(!empty($data['pwd_err'])) ? 'is-invalid' : ''; ?>" value="1234" >
                        <i id="togglePwd" class="fa fa-eye pointer"></i><span class="invalid-feedback"><?php echo $data['pwd_err']; ?></span>
                    </div>
                    <div class="row mb-3">
                        <div class="col ">
                            <input type="submit" value="Login" class="btn btn-success btn-block">
                        </div>
                        <div class="col"><a href="<?php echo URLROOT;?>/guests/register" class="btn btn-light btn-block">No Account? Register</a></div>

                    </div>
                    <u class="pointer" id="forget">Forget Password?</u>
                </form>
            </div>
        </div>
<?php include_once(APPROOT.'/views/includes/footer.php');?>
<div class="modal fade" id="forgetPwd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Password Reset!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
			<form method = "post" id="data">
        <?php flash('register_success'); ?>
      <div class="modal-body">
			<div class="form-group">
				<label>E-Mail:</label>
				<input type = "email" name = "mail" placeholder="Enter your Registered Email here" class = "form-control" id='mail' value="<?php echo$data['email'];?>" autocomplete="off" required>
			</div>
      </div>
      <div class="modal-footer">
				<button  class="btn btn-primary pull-left" name="uploadcsv" id="getCSVBtn">Go</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
			</form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('#forget').click(function(){
      $('#forgetPwd').modal('show');
    });
  });
</script>
