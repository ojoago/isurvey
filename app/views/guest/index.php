<?php include_once(APPROOT.'/views/includes/header.php');?>
<style media="screen">
.stick_header,.footer{
  display: none !important;
}
  body {
    padding: 1rem 3rem 0;
    background-color: #f35353;
    color: #999;
    display: flex;
    flex-wrap: wrap;
    max-width: 680px;
    font-family: "Arial", sans-serif;
    margin: 0 auto;
  }
.colmd6{
  width: 100%;
  padding: 10px;
  border-radius: 40px;
  background: #f35353;
  box-shadow: 13px 13px 20px #cf4747,
              -13px -13px 20px #ff5f5f;
  margin-left: auto;
  margin-right: auto;
}
.head-logo{
  padding: 3px;
  /* padding-bottom: 3rem; */
  margin: 0 auto;
}
.head-logo{
  background-color: #fff;
  width: 25%;
}

.head-logo{
  box-shadow:  6px 6px 10px 0 rgba(255, 255,255, 0.2),
     -6px -6px 10px 0 rgba(2, 0,5, 0.5);
}
.head-logo> #logo{
  width: 100%;
  height: auto;
}
.head-logo{
  width: 100px;
  height: auto;
  margin: 0 auto;
  background-color:transparent;
  /* box-shadow: 0px 0px 2px #5f5f5f,
              0px 0px 5px #cf4747,
              8px 8px 15px #ff5f5f,
              -8px -8px 15px #cf4747; */
}
#logo{
  width: 100%;
  margin: 0 auto;
}
h2 {
  margin-top: 0;
  margin-bottom: 1.5rem;
}

* {
box-sizing: border-box;
}
.card{
  background-color: #fff;
  margin-top: 7px;
}
.card{
  box-shadow: 12px 12px 24px 0 rgba(0, 0, 0, 0.3),
            -12px -12px 24px 0 rgba(255, 255, 255, 0.1);
  width: 95%;
  border-radius: 40px;
  overflow: hidden;
  padding: 1.3rem;
}
.card h2{
  text-align: center;
  align-items: center;
  float: center;
}

.card form{
  /* display: flex; */
  align-items: center;
  text-align: center;
  width: 100%;
  height: 100%;
  border-radius: 10%;
  overflow: hidden;
  padding: 0.65rem;
  padding-bottom: 0;
  box-shadow: inset -8px -8px 16px 0 rgba(0, 0, 0, 0.4),
    inset 8px 8px 16px 0 rgba(55, 55, 55, 0.3);
}
.form-group{
  width: 100%;
  padding: 15px 5px 1px 5px;
}
.form-control{
  margin-bottom: 25px;
  border-radius: 25px;
  box-shadow: inset 8px 8px 8px #cbced1,
  -8px -8px 8px  #ffffff;
}
.form-group input{
  border: none;
  outline: none;
  background: none;
  font-size: 18px;
  color: #555;
  padding: 5px;
}


</style>
    <div class="row">
        <div class="colmd6">
          <div class="head-logo" id="head-logo">
              <img src="<?php echo URLROOT; ?>/isurveyimages/logo.png" class="img img-responsive" id="logo">
          </div>
            <div class="card card-body bg-light mt-3 mb-4">
                <h2  class="text-center title">Sign Up</h2>
                <form action="<?php echo URLROOT;?>/guests/register" method="post">

                    <div class="form-group">
                        <!-- <label for="name">E-Mail: <sup class="text-danger red">*</sup></label> -->
                        <input type="email" placeholder="Enter Email Address" name= "email" class="form-control form-control-sm <?php echo(!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo$data['email'];?>" autocomplete="off">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <!-- <label for="name">PASSWORD: <sup class="text-danger red">*</sup></label> -->
                        <input type="password" placeholder="Enter Password" name= "pwd" class="form-control form-control-sm <?php echo(!empty($data['pwd_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo$data['pwd'];?>">
                        <span class="invalid-feedback"><?php echo $data['pwd_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <!-- <label for="name">Confirm Password: <sup class="text-danger red">*</sup></label> -->
                        <input type="password" placeholder="Enter Confirm Password" name= "cpwd" class="form-control form-control-sm <?php echo(!empty($data['cpwd_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo$data['cpwd'];?>">
                        <span class="invalid-feedback"><?php echo $data['cpwd_err']; ?></span>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $capcha=avaterTxt(); ?>
                            <img class="img img-responsive" src="<?php echo URLROOT;?>/<?php echo $capcha;?>">
                            <input type="hidden" name= "avater" id="avater" value="<?php echo $capcha ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name= "confirmavater" class="form-control  <?php echo(!empty($data['avater_err'])) ? 'is-invalid' : ''; ?>" id="confirmavater" >
                            <span class="invalid-feedback"><?php echo $data['avater_err']; ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="row pb-4">
                        <div class="col">
                            <input type="submit" value="Register" class="btn btn-success btn-block">
                        </div>
                        <div class="col"><a href="<?php echo URLROOT;?>/guests/login" class="btn btn-light btn-block">Have an Account? Login</a></div>
                    </div>
                </form>

<?php include_once(APPROOT.'/views/includes/footer.php');?>
