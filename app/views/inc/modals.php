
<!-- Message box modal stop here -->
<!-- Message box modal -->
<div class="modal fade" id="deposit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Customer Deposit Without Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span class="flashMsg"></span>
        <form id="custDepositForm">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <small>Names:</small>
                <input type="text" name="name" autocomplete="off" class="form-control form-control-sm" placeholder="customer's name">
              </div>
              <div class="form-group">
                <small>Cash:</small>
                <input type="number" name="cash" autocomplete="off" class="form-control form-control-sm" placeholder="Cash Paid">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <small>GSM:</small>
                <input type="text" name="gsm" autocomplete="off" class="form-control form-control-sm" placeholder="customer phone number">
              </div>
              <div class="form-group">
                <small>Transfer:</small>
                <input type="number" name="bank" autocomplete="off" class="form-control form-control-sm" placeholder="amount transfered">
              </div>
            </div>
          </div>
          <div class="form-group">
            <small>Note:</small>
            <textarea type="text" name="note" autocomplete="off" class="form-control form-control-sm" placeholder="deposit note"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer bg-success">
        <div class="btn-group">
          <button type="button" class="btn btn-primary btnBox btn-sm" id="directDepositBtn">Submit</button>
          <button type="button" class="btn btn-warning btnBox btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="updatepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Update Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span class="updpwdMsg"></span>
        <form id="updatePwdForm">
          <div class="form-group">
            <small>Old Password:</small>
            <input type="password" name="pwd" class="form-control form-control-sm" placeholder="old Password">
          </div>
          <div class="form-group">
            <small>New Password:</small>
            <input type="password" name="npwd" class="form-control form-control-sm" placeholder="new Password">
          </div>
          <div class="form-group">
            <small>Confirm New Password:</small>
            <input type="password" name="cpwd" class="form-control form-control-sm" placeholder="new Password">
          </div>
        </form>
      </div>
      <div class="modal-footer bg-success">
        <div class="btn-group">
          <button type="button" class="btn btn-primary btnBox btn-sm" id="updatePwdBtn">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Message box modal stop here -->
<div class="modal fade" id="reversePayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h6 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-exchange mr-1"></i>Reverse Payment</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="reversePaymentForm" method="post">
          <div class="form-group">
            <input type="text" name="orderid" class="form-control form-control-sm" placeholder="order id">
          </div>
          <div class="form-group">
            <input type="number" name="amount" class="form-control form-control-sm" placeholder="amount ">
          </div>
        </form>
      </div>
      <div class="modal-footer bg-primary">
        <button type="button" class="btn btn-success btn-sm btnBox" id="reversePaymentBtn" >Submit</button>
        <button type="button" class="btn btn-warning btn-sm btnBox" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class = "modal fade" id = "addCategory" tabindex="-1" role = "dialog"aria-labelledby="myModalLabel">
	<div class = "modal-dialog modal-sm" role="document">
		<div class = "modal-content">
      <div class="modal-header bg-light">
        <h6 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-exchange mr-1"></i>Poduct Category</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
			<div class = "modal-body">
				<div class = "form-group text-center">
					<input type = "text" id = "cat"  autofocus class = "form-control  form-control-sm" placeholder ="ENTER CATEGORY"required>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id = "uploadCat" class="btn btn-primary btn-sm" >Add</button>
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" align = "left">Close</button>
			</div>
		</div>
	</div>
</div>
<div class = "modal fade" id = "expCategory" tabindex="-1" role = "dialog"aria-labelledby="myModalLabel">
	<div class = "modal-dialog modal-sm" role="document">
		<div class = "modal-content">
      <div class="modal-header bg-light">
        <h6 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-exchange mr-1"></i>Expense Category</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
			<div class = "modal-body">
				<div class = "form-group text-center">
					<input type = "text" id = "expenseCat"  autofocus class = "form-control form-control-sm" placeholder ="ENTER CATEGORY" >
				</div>
			</div>
			<div class="modal-footer bg-light">
				<button type="submit" id = "addExpenseCat" class="btn btn-primary btn-sm" >Add</button>
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" align = "left">Close</button>
			</div>
		</div>
	</div>
</div>
<div class = "modal fade" id = "sqrMeterModal" tabindex="-1" role = "dialog"aria-labelledby="myModalLabel">
	<div class = "modal-dialog modal-sm" role="document">
		<div class = "modal-content">
      <div class="modal-header bg-light">
        <h6 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-squre mr-1"></i>Tiles Square Meter</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
			<div class = "modal-body">
  			<form id="sqrMeterForm" method="post">
          <label>Demension</label>
							<div class = "row">
							<div class = "col">
								<div class = "form-group">
									<input type = "text" id = "length" name="l" maxlength="2" autofocus placeholder ="e.g 40" maxlength = "2" class = "form-control form-control-sm" >
								</div>
							</div>
								<div class = "col">
									<div class = "form-group">
										<input type = "text" id = "width" name="w"  maxlength="2" placeholder ="e.g 25" maxlength ="2" class = "form-control form-control-sm">
									</div>
								</div>
							</div>
					<div class = "form-group">
            <label>SQUARE METER per Carton</label>
						<input type = "number" name="n" id = "ncarton" placeholder ="e.g 17" class = "form-control form-control-sm">
					</div>
        </form>
			</div>
			<div class="modal-footer">
				<button type="submit" id = "addSqrMeterBtn" class="btn btn-primary btn-sm">Add</button>
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" align = "left">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade right" id="timeOut" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
    <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document">
        <div class="modal-content-full-width modal-content ">
            <div class=" modal-header-full-width   modal-header text-center">
                <h5 class="modal-title w-100" id="exampleModalPreviewLabel"><?php  echo strtoupper(uid());?> <small>logged in</small></h5>
                <!-- <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span style="font-size: 1.3em;" aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
              <input type="password" style="margin-left: auto !important;margin-right: auto!important;width:250px;float:center!important;" id="unlock" class="form-control form-control-sm mb-3" autofocus placeholder="ENTER PASSWORD TO UNLUCK" >
              <center><img src="<?php echo URLROOT ?>/images/shafa bm.png" width="600" class="img img-responsive" id="lockScreenImg"></center>
            </div>
            <div class="modal-footer-full-width  modal-footer">
                <!-- <button type="button" class="btn btn-danger btn-md btn-rounded" data-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary btn-md btn-rounded">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<!-- reverse order modal -->
<!-- Message box modal -->
<div class="modal fade" id="reverseOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h6 class="modal-title text-center" id="exampleModalLabel"><i class="fa fa-exchange mr-1"></i>Return Order</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="ROsMsg"></p>
        <form id="reverseOrderFrom" method="post">
          <div class="form-group">
            <select class="form-control form-control-sm" id="whereIsId" style="width:100%;">
              <option disabled selected> Select Products</option>
              <?php echo productNameModel(); ?>
            </select>
          </div>
          <div id="itemsDsc"> </div>
          <div class="form-group">
            <input type="text" name="orderid" id="RIO" class="form-control form-control-sm" placeholder="order id">
          </div>
        </form>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-info btn-sm btnBox"id="reverseOrderBtn" >Submit</button>
        <button type="button" class="btn btn-warning btnBox btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
