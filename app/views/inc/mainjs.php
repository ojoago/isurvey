<script>
  $( function() {
    $(".datepicker").datepicker();
  });
  $(document).ready(function(){
    $('[rel=tooltip]').tooltip({trigger: "hover"});
    $('#backToTop').click(function(e){
		e.preventDefault();
	$('html, body').animate({scrollTop:0},'3000');
	});
	window.onscroll = function() {scrollFunction()};
		function scrollFunction() {
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				document.getElementById("backToTop").style.display = "block";
			} else {
				document.getElementById("backToTop").style.display = "none";
			}
		}
		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
			document.body.scrollTop = 0; // For Safari
			document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
		}
    $('#generalSearch').keyup(function(){
      var txt=$(this).val();
      $.ajax({
        url:"<?php echo URLROOT ?>/functions/dropdown.php",
        type:"post",
        data:{loopSearch:true,txt:txt},
        success:function(data){
          if(data !==''){
            $('#searchDropDown').html(data);
            $('#searchDropDown').show(500);
          }else{
            $('#searchDropDown').hide(500);
          }
        }
      });
    });

    $('#searchById').keyup(function(){
      var txt=$(this).val();
      $.ajax({
        url:"<?php echo URLROOT ?>/functions/dropdown.php",
        type:"post",
        data:{loopSearch:true,txt:txt},
        success:function(data){
          if(data !==''){
            $('#searchDropDown').html(data);
            $('#searchDropDown').show(500);
          }else{
            $('#searchDropDown').hide(500);
          }
        }
      });
    });

    $('#reversePaymentBtn').click(function(){
      var form= $('#reversePaymentForm');
      $.ajax({
        url:"<?php echo URLROOT ?>/financies/reverse",
        type:"POST",
        data:{reversePay:true,form:form.serialize()},
        success:function(data){
          $('#reversePaymentForm')[0].reset();
          alert(data);
          location.reload();
        }
      });
    });

    $('#addExpenseCat').click(function(){
      var txt=$('#expenseCat').val();
      if(txt!=''){
        $.ajax({
          url:"<?php echo URLROOT ?>/defines/expense",
          type:"POST",
          data:{expense:true,txt:txt},
          success:function(data){
            alert(data);
            $('#expenseCat').val('');
            $('#expCategory').modal('hide');
          }
        });
      }else {
        alert('Enter Category');
      }
    });

    $('.editExpenseCat').click(function(){
      var id=$(this).attr('id');
      var txt=$('#e'+id).text();
      $.ajax({
        url:"<?php echo URLROOT ?>/defines/expense",
        type:"POST",
        data:{updateXpense:true,txt:txt,id:id},
        success:function(data){
          alert(data);
        }
      });
    });

    $('.deleteExpenseCat').click(function(){
      var id=$(this).attr('id');
      if(confirm('delete Category ?')){
        $.ajax({
          url:"<?php echo URLROOT ?>/defines/expense",
          type:"POST",
          data:{deleteXpense:true,id:id},
          success:function(data){
            alert(data);
            location.reload();
          }
        });
      }
    });

    $('#uploadCat').click(function(){
      var txt=$('#cat').val();
      if(txt!=''){
        $.ajax({
          url:"<?php echo URLROOT ?>/defines/category",
          type:"POST",
          data:{addCategory:true,txt:txt},
          success:function(data){
            $('#cat').val('');
            alert(data);
          }
        });
      }
    });

    $('.editPrdCat').click(function(){
      var id=$(this).attr('id');
      var txt=$('#c'+id).text();
      $.ajax({
        url:"<?php echo URLROOT ?>/defines/category",
        type:"POST",
        data:{updateCat:true,txt:txt,id:id},
        success:function(data){
          alert(data);
        }
      });
    });

    $('.deletePrdCat').click(function(){
      var id=$(this).attr('id');
      if(confirm('delete Category ?')){
        $.ajax({
          url:"<?php echo URLROOT ?>/defines/category",
          type:"POST",
          data:{deleteCat:true,id:id},
          success:function(data){
            alert(data);
            location.reload();
          }
        });
      }
    });

    $('#addSqrMeterBtn').click(function(){
      var form=$('#sqrMeterForm');
        $.ajax({
          url:"<?php echo URLROOT ?>/defines/square",
          type:"POST",
          data:{addSqrMeter:true,form:form.serialize()},
          success:function(data){
            if(data=='success'){
              $('#sqrMeterForm')[0].reset();
              alert(data);
            }else{
              alert(data);
            }
          }
        });
    });

    $('#EditSqrMeterBtn').click(function(){
      var form=$('#editSqrMeterForm');
        $.ajax({
          url:"<?php echo URLROOT ?>/defines/editSqrMeter",
          type:"POST",
          data:{editSqrMeter:true,form:form.serialize()},
          success:function(data){
            if(data=='success'){
              $('#editSqrMeterForm')[0].reset();
              alert(data);
              location.reload();
            }else {
              alert(data);
            }
          }
        });
    });

    $('.deleteTile').click(function(){
      var id=$(this).attr('id');
      if(confirm('delete Square Meter ?')){
        $.ajax({
          url:"<?php echo URLROOT ?>/defines/square",
          type:"POST",
          data:{deleteSqrm:true,id:id},
          success:function(data){
            alert(data);
            location.reload();
          }
        });
      }
    });

    $('#directDepositBtn').click(function(){
      var form=$('#custDepositForm');
      $.ajax({
        url:"<?php echo URLROOT ?>/financies/directDeposit",
        type:"POST",
        data:{custDyrectDeposit:true,form:form.serialize()},
        success:function(data){
          if(data.error==''){
            window.location.href="<?php echo URLROOT ?>/customers/depositreceipt/"+data.id;
          }else{
            $('.flashMsg').html(data.error);
          }
        }
      });
    });

    $('#updatePwdBtn').click(function(){
      var form=$('#updatePwdForm');
      $.ajax({
        url:"<?php echo URLROOT ?>/pages/updatePassword",
        type:"POST",
        data:{updatePwd:true,form:form.serialize()},
        success:function(data){
          if(data.includes('success')){
            $('#updatePwdForm')[0].reset();
          }
          $('.updpwdMsg').text(data);
        }
      });
    });
  var idleTime=0;
	var idleInterval = setInterval(timerIncrement,90000);
	$(this).mousemove(function(e){
		idleTime=0;
	});
	$(this).keypress(function(e){
		idleTime=0;
	});
	$(this).click(function(e){
		idleTime=0;
	});
	$('#sleepOff').click(function(){
		sleepOff();
	})
	function timerIncrement(){
		idleTime++;
		if(idleTime > 1){
			sleepOff();
		}
	}
	function sleepOff(){
		$.ajax({
			url:"<?php echo URLROOT ?>/pages/sleepOff",
			success:function(data){
        close();
			}
		});
	}
  function close(){
    $("#timeOut").modal({
      backdrop: 'static',
      keyboard: false
    });
    $('.btn').hide();
    // $('.modal').hide();
  }
  <?php
    if(isset($_SESSION['sleepOff'])){
      ?>
        close();
       <?php
    }
   ?>
	$('#unlock').keyup(function(){
		var pwd=$(this).val();
		$.ajax({
      url:"<?php echo URLROOT ?>/pages/unLock",
			method:"post",
			data:{resumeScreen:true,key:pwd},
			success:function(data){
				if(data.includes('success')){
					$('#timeOut').modal('hide');
					$('.btn').show();
					$('#unlock').val('');
				}
			}
		});
	});
	// manual backup
	$('#backupDb').click(function(){
	   backupDb();
	});
	var Time= new Date();
	setInterval(function(){
		var time = Time.getHours();
		var min = Time.getMinutes();
		if((time == 17 || time ==05) && min < 1 ){
       backupDb();
		}
	}, 60000);
	function backupDb(){
		location.href="<?php echo URLROOT ?>/backup";
	}
  $('#giveDiscount').click(function(){
    var val=Number($('#discountVal').val());
    var total=Number($('#subTotal').val());
    if(val > 0 && total > 0)
    $.ajax({
      type:"POST",
      url:"<?php echo URLROOT ?>/carts/askManager",
      data:{requestDiscount:true,discount:val,amount:total},
      success:function(data){
        $('#cartsMessage').html(data);
        checkDiscountRequest();
      }
    });
  });
  setInterval(function(){
		checkDiscountRequest();
	}, 10000);
  function checkDiscountRequest(){
    <?php if(role()=='manager') : ?>
    $.ajax({
      type:"POST",
      url:"<?php echo URLROOT ?>/carts/checkDiscountRequest",
      success:function(data){
        $('#discountRequest').html(data);
      }
    });
    <?php endif; ?>
  }

  $('#whereIsId').change(function(){
    var id=$(this).val();
    $.ajax({
      url:"<?php echo URLROOT ?>/loadmodal.php",
      type:"POST",
      data:{returnItem:true,id:id},
      success:function(data){
        $('#itemsDsc').append(data);
        // $('#advanceBalanceDetails').modal('show')
      }
    });
  });

  // process reverse order
  $('#reverseOrderBtn').click(function(){
    var form =$('#reverseOrderFrom');
    var id=$('#RIO').val();
    $.ajax({
      url:"<?php echo URLROOT?>/carts/reverseOrder",
      type:"POST",
      data:{reverseOrder:true,form:form.serialize()},
      success:function(data){
        if(data.includes('success')){
            location.href="<?php echo URLROOT ?>/carts/receipt/"+id;
        }else{
          $('#ROsMsg').show(500);
          $('#ROsMsg').html(data);
        };
      }
    });
  });

  });
</script>
