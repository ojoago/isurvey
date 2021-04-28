<script>

                $('#productDetails').bootstrap3Validate(function(e, data) {
                    "use strict";
                    e.preventDefault();

                    $.ajax({
                        url: "src/core.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            $("#result").html(data);
                        },
                        error: function() {}
                    });

                });

    $(document).ready(function() {
    $('#product-list').dataTable({
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		language: {
    paginate: {
      next: '<i class="fa fa-angle-double-right">',
      previous: '<i class="fa fa-angle-double-left">'
    }
  }
		});
} );
    //good transfer initialization
    $('#start_transfer').bootstrap3Validate(function(e, data) {
        "use strict";
        // alert(true);
        e.preventDefault();
        $.ajax({
            url: "src/core.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#Transferresult").html(data);
            },
            error: function() {}
        });

    });

    //cancel transfer
    $('#cancel_trx').bootstrap3Validate(function(e, data) {
        e.preventDefault();
        $.ajax({
            url: "src/core.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#result").html(data);
            },
            error: function() {}
        });

    });

    //validate goods transfer
    function ValidateTransfer() {
        "use strict";
        $("#loader").html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
        $.ajax({
            url: 'src/core.php?ValidateTransfer',
            success: function(response) {
                $("#loader").html(response);
            }
        });

    }

    //submit goods tranfer
    function submitTransfer() {
        "use strict";
        //  alert(true);
        // return false;
        var comment = $("#comment").val();


        $("#loader").html('<i class="fa fa-spinner fa-spin fa-lg"></i>');

        $.ajax({
            url: 'src/core.php?submitTransfer=1&comment=' + comment,
            success: function(response) {
                $("#result").html(response);
            }
        });

    }

    //new customer record
                $('#form3').bootstrap3Validate(function(e, data) {
                    "use strict";
                    e.preventDefault();
                    $.ajax({
                        url: "src/core.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            $("#result1").html(data);
                        },
                        error: function() {}
                    });
                });


                //new app user account
                $('#form').bootstrap3Validate(function(e, data) {
                    "use strict";
                    e.preventDefault();
                    $.ajax({
                        url: "src/core.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            $("#result").html(data);
                        },
                        error: function() {}
                    });
                });



    //new expenses record
    $('#form5').bootstrap3Validate(function(e, data) {
        "use strict";
        e.preventDefault();
        $("#expenses_result").html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
        $.ajax({
            url: "src/core.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#expenses_result").html(data);
            },
            error: function() {}
        });

    });



    //Post bank deposit
    $('#form4').bootstrap3Validate(function(e, data) {
        "use strict";
        e.preventDefault();
        $("#bank_result").html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
        $.ajax({
            url: "src/core.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#bank_result").html(data);
            },
            error: function() {}
        });

    });



    //delete deposit record
    function deleteDeposit(id) {
        "use strict";
        $.ajax({
            url: 'src/core.php?delDeposit=' + id,
            success: function(response) {
                $("#result").html(response);
            }
        });
    }

    //delete deposit record
    function deleteExpenses(id) {
        "use strict";
        $.ajax({
            url: 'src/core.php?deleteExpenses=' + id,
            success: function(response) {
                $("#result").html(response);
            }
        });
    }


    //delete uom
    function deleteUOM(id) {
        "use strict";
        $.ajax({
            url: 'src/core.php?deleteUOM=' + id,
            success: function(response) {
                $("#uom_result").html(response);
            }
        });
    }



    //app data form submission
    $('#AppDataForm').bootstrap3Validate(function(e, data) {
        e.preventDefault();
        $.ajax({
            url: "src/core.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#result").html(data);
            },
            error: function() {}
        });

    });

    //Post new user group
    $('#form6').bootstrap3Validate(function(e, data) {
        "use strict";
        e.preventDefault();
        $.ajax({
            url: "src/core.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#ug_result").html(data);
            },
            error: function() {}
        });

    });


    //unit of measurement
    $('#uomForm').bootstrap3Validate(function(e, data) {
        "use strict";
        e.preventDefault();
        $.ajax({
            url: "src/core.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#uom_result").html(data);
            },
            error: function() {}
        });

    });


    ////////////////////////script moving //////////////////////
    //datepicker
    $(function() {
        "use strict";
        $(".date-picker").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            startDate: '-3d'
        });
    });


    //dataTables
    $(document).ready(function() {
        $('.data-table').dataTable({
            language: {
                paginate: {
                    next: '<i class="fa fa-angle-double-right">',
                    previous: '<i class="fa fa-angle-double-left">',
                }
            }

        });
    });


    function clearNotes() {
        $('#note').val('');
        $.ajax({
            url: 'src/core.php?clearNotes',
            success: function(response) {
                $("#save-note").html(response);
            }
        });

    }

    //note keeping submission
    $('#inotes').bootstrap3Validate(function(e, data) {
        "use strict";
        e.preventDefault();
        $.ajax({
            url: "src/core.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#save-note").html(data);
            },
            error: function() {}
        });

    });

                //new location
                $('#new_location').bootstrap3Validate(function(e, data) {
                    "use strict";
                    e.preventDefault();
                    $.ajax({
                        url: "src/core.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            $("#new_result").html(data);
                        },
                        error: function() {}
                    });
                });

//filtering sales

//function for filtering record by date
function filterByDate(page, from, to) {

    "use strict";
    var fromDate = $("#" + from).val();
    var toDate = $("#" + to).val();

    if (fromDate == '') {
        $("#" + from).addClass('alert-warning');
        $("#" + from).focus();
    } else if (toDate == '') {
        $("#" + to).addClass('alert-warning');
        $("#" + to).focus();
    } else {
        location.replace(page + '&from_date=' + fromDate + '&to_date=' + toDate);
    }
}

//function for filtering by sales rep
function filterBySeller(page, id) {
    "use strict";
    //alert(page+id);
    var seller = $("#" + id).val();

    if (seller == '') {
        $("#" + id).addClass('alert-warning');
        $("#" + id).focus();
    } else {
        location.replace(page + '&sales_rep=' + seller);
    }

}

//function for filtering by sales type
function filterByType(page, id) {
    "use strict";
    //alert(page+id);
    var type = $("#" + id).val();

    if (type == '') {
        $("#" + id).addClass('alert-warning');
        $("#" + id).focus();
    } else {
        location.replace(page + '&sales_type=' + type);
    }

}

                //customer payment and returns
                $('#CustPay').bootstrap3Validate(function(e, data) {
                    "use strict";
                    e.preventDefault();
                    $.ajax({
                        url: "src/custTrans_functions.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            $("#payResult").html(data);
                        },
                        error: function() {}
                    });

                });

//display transaction customer filter
$(".filter_cust").click(function(){
 // alert(true);
 $("#date_filter").hide();
 $("#salesType_filter").hide();
$("#sales_filter").hide();
$("#cust_filter").fadeIn();
});

  //display transaction date filter
            $(".filter_date").click(function() {
                $("#store_location").hide();
                $("#date_filter").fadeIn();
				 $("#conditional_filter").hide();
            });

            //display transaction date filter
            $(".filter_location").click(function() {
                $("#date_filter").hide();
				 $("#conditional_filter").hide();
                $("#store_location").fadeIn();
            });
			//display transaction date filter
            $(".filter_con").click(function() {
                $("#date_filter").hide();
				$("#store_location").hide();
                $("#conditional_filter").fadeIn();
            });

</script>
