//delete customer record
function deleteCustomer(id) {
    "use strict";
    $.ajax({
        url: 'src/core.php?delCust=' + id,
        success: function (response) {
            $("#result").html(response);
        }
    });
}

//delete supplier record
function deleteSupp(id) {
    "use strict";
    $.ajax({
        url: 'src/core.php?delSupp=' + id,
        success: function (response) {
            $("#result").html(response);
        }
    });
}

//new supplier record
$('#SuppForm').bootstrap3Validate(function (e, data) {
    "use strict";
    e.preventDefault();
    $.ajax({
        url: "src/core.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            $("#supp_result").html(data);
        },
        error: function () {}
    });
});

//cookie writer
function writeCookie(name, value, hours) {
    "use strict";
    var expire = "";
    if (hours !== null) {
        expire = new Date((new Date()).getTime() + hours * 3600000);
        expire = "; expires=" + expire.toGMTString();
    }
    document.cookie = name + "=" + escape(value) + expire;
    location.reload();
}

///category delete selected
function selectRecords(formName, btnDiv) {
    "use strict";
    var formN = '#' + formName + " input[type=checkbox]";
    //alert(formN+btnDiv);
    if ($(formN).is(':checked')) {
        $('#' + btnDiv).fadeIn();
    } else {
        $('#' + btnDiv).fadeOut();
    }

}


//display subcategory
function getSubcategory(elem) {
    "use strict";
    $.ajax({
        url: 'src/core.php?parent_id=' + elem,
        success: function (response) {
            $("#drug_subcategory").html(response);
        }
    });
}
//delete category
function deleteCategory(id) {
    "use strict";
    $.ajax({
        url: 'src/core.php?trigger3=' + id,
        success: function (response) {
            $("#result").html(response);
        }
    });
}

//delete subcategory
function deleteSubCategory(sub_id, p_id) {
    "use strict";
    $.ajax({
        url: 'src/core.php?subCat_del=' + sub_id + '&parent_id=' + p_id,
        success: function (response) {
            $("#result").html(response);
        }
    });
}


//delete single product


//notification box
function alertBox(box, msg, div) {
    "use strict";
    var ms;
    var getLength = msg.length;
    
    if (div == 'warnBox' && box == 'warnBtn' ) {
        ms = $('#' + msg).html();
    } else {
        ms = msg;
    }

    //if(ms != boxItem){
    $('#' + box).click();
    $('#' + div).html(ms); //=ms;
    //}
}

//number verification
function verify(id) {
    "use strict";
    var ob = document.getElementById(id);
    var invalidChars = /[^0-9.]/gi;
    if (invalidChars.test(ob.value)) {
        ob.value = ob.value.replace(invalidChars, "");
    }
}

//preview image before upload
function readURL(input) {
    "use strict";
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('prod-images').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}


//##### Number formatting function #######//
function CommaFormatted(amount) {
    "use strict";
    var delimiter = ","; // replace comma if desired
    var a = amount.split('.', 2);
    var d = a[1];
    var i = parseInt(a[0]);
    if (isNaN(i)) {
        return '';
    }
    var minus = '';
    if (i < 0) {
        minus = '-';
    }
    i = Math.abs(i);
    var n = new String(i);
    var a = [];
    while (n.length > 3) {
        var nn = n.substr(n.length - 3);
        a.unshift(nn);
        n = n.substr(0, n.length - 3);
    }
    if (n.length > 0) {
        a.unshift(n);
    }
    n = a.join(delimiter);
    if (d.length < 1) {
        amount = n;
    } else {
        amount = n + '.' + d;
    }
    amount = minus + amount;
    return amount;
}

// Item calculations
function itemCalc() {
    "use strict";
    var CA;
    var SA;
    var profit;
    var qty = document.getElementById('drug_qty').value;
    var unitCost = document.getElementById('drug_costP').value;
    var sellCost = document.getElementById('drug_sellingP').value;

    SA = sellCost * qty;
    CA = unitCost * qty;
    profit = SA - CA;
    document.getElementById('costAmt').value = CommaFormatted(CA.toFixed(2));
    document.getElementById('selling_amt').value = CommaFormatted(SA.toFixed(2));
    document.getElementById('drug_profit').value = CommaFormatted(profit.toFixed(2));

}

//replenishing products
function itemReplenish() {
    "use strict";
    var currentQty = $('#drug_qty2').val();
    var repl = $('#replenish').val();
    //alert(repl);
    var newQty;
    newQty = (currentQty - 0) + (repl - 0);
    $('#drug_qty').val(newQty);


}

///print receipt
function printDiv(divID) {
    //Get the HTML of div
    //alert(divID); return false;
    var divElements = document.getElementById(divID).innerHTML;
    //Get the HTML of whole page
    var oldPage = document.body.innerHTML;
    //Reset the page's HTML with div's HTML only
    //document.getElementById('printTable').setAttribute(width,'100%');
    document.body.innerHTML = "<html><head><style>body{margin:0px; padding:0px; font-family:'arial';} #s_name{font-size:9px;} #s_address{font-size:7px;} #s_contact{font-size:7px;} #r_title{font-size:11px; margin:2px 0px} #r_ref{font-size:8px; margin:1px 0px; padding-right:2px;} #r_goods{font-size:8px; margin:2px 0px; border-bottom:1px dotted #000; padding-right:2px} table{width:100%; font-size:8px; border:0px} td{border:0px; padding:1px 10px;} #r_footer{font-size:8px; padding:2px} @media print{ margin:0mm 14mm 10mm 0mm;  } @page{ size:auto; margin:0mm 14mm 10mm 0mm; } #t_row{border-bottom:1px solid #000; border-top:1px dotted #000;} </style><title></title></head><body>" +
        divElements + "</body>";
    //Print Page
    //return false;
    window.print();
    //Restore orignal HTML
    document.body.innerHTML = oldPage;
    //regExit();
    location.reload();
}


///printing script

//assign trigger value
function optSelect(val) {
    "use strict";
    //alert(val); return false;
    $("#move").val(val);
}


// Transaction Computation
function transactOpt() {
    "use strict";

    var qtyDemand = document.getElementById('transactQty').value;
    var itemCost = document.getElementById('itemCost').value;

    transact = qtyDemand * itemCost;
    document.getElementById('transactAmt').value = transact.toFixed(2);
    document.getElementById('transactAmt2').innerHTML = CommaFormatted(transact.toFixed(2));
    if (document.getElementById('transactQty').value === 0) {
        document.getElementById('transactQty').value = "";
    } else if (document.getElementById('transactAmt').value === 0) {
        document.getElementById('transactAmt').value = "";
    }
}

//Transaction payment validation
function sales() {
    "use strict";

    var qtyDemand = document.getElementById('transactQty').value;
    var stockQty = document.getElementById('itemQty').value;

    //alert(qtyDemand); return false;

    if (document.getElementById('transactQty').value == "") {
        alert("Enter Qty Demanded");
        return false;
    } else if (parseInt(stockQty) < parseInt(qtyDemand)) {
        alert("Quantity in stock is less than demand");
        return false;
    } else {
        document.form.submit
    }
}

//transaction discount
function calDiscount() {
    "use strict";
    var Ttotal = document.getElementById('Carttotal');
    var Tdiscount = document.getElementById('Cartdiscount');
    var TgrandTotal;

    if ((Tdiscount.value - 0) > (Ttotal.value - 0)) {
        alert("The discount is greater than the total");
        return false;
    } else {
        TgrandTotal = (Ttotal.value - 0) - (Tdiscount.value - 0);
        document.getElementById('grandtotal').value = TgrandTotal.toFixed(2);
        document.getElementById('grandtotal1').value = CommaFormatted(TgrandTotal.toFixed(2));
    }
}




function getliVal(id) {
    "use strict";
    var s = $('#' + id).text();
    $('#pos_search').val(s);
}

// drug recieving searching
function recvSearch(val, suppN) {
    "use strict";
    //	alert(suppN);
    if (val !== ' ') {
        $("#loader").html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
        $.ajax({
            url: 'src/core.php?RecvList=' + val + '&&suppl=' + suppN,
            success: function (response) {
                $("#list_result").html(response);
                $("#loader").html(' ');

            }
        });
    }
}

///post drug to be recieved
function recvDrug(drug_id) {
    "use strict";
    //drug details
    var RecvNum = $("#recvID").val();
    var supplier = $("#supl").val();
    if (drug_id !== ' ') {
        $("#loader").html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
        $.ajax({
            url: 'src/core.php?RecvDrugId=' + drug_id + '&recvID=' + RecvNum + '&suppl=' + supplier,
            success: function (response) {
                $("#result").html(response);
                $("#loader").html(' ');

            }
        });
    }
}

//delete receiving drug
function delRcvDrug(dID) {
    "use strict";
    $("#loader").html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
    $.ajax({
        url: 'src/core.php?drugDelID=' + dID,
        success: function (response) {
            $("#result").html(response);
            $("#loader").html(' ');

        }
    });
}

///updating receiving qty/price
function updateQP(val, field, id) {
    "use strict";
    $("#loader").html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
    $.ajax({
        url: 'src/core.php?recvUpd=' + id + '&rcvfield=' + field + '&rcvval=' + val,
        success: function (response) {
            $("#result").html(response);
            $("#loader").html(' ');

        }
    });
}


//received payment calculations
function recvCalc() {
    var total = document.getElementById('recvtotal').value;
    var paid = document.getElementById('recvpaid').value;
    var bal1 = document.getElementById('recvbal1');
    var bal = document.getElementById('recvbal');

    var result;
    result = (total - 0) - (paid - 0);
    bal1.value = CommaFormatted(result.toFixed(2));
    bal.value = (result);
}

//submitting received drug
function submitRecv() {
    "use strict";
    var suppl = document.getElementById('supl').value;
    var paidAmt = document.getElementById('recvpaid').value;
    var transId = document.getElementById('recvID').value;
    var bal = document.getElementById('recvbal').value;
    $.ajax({
        url: 'src/core.php?CommitRecv=' + transId + '&supplier=' + suppl + '&paidVal=' + paidAmt + '&bals=' + bal,
        success: function (response) {
            $("#result").html(response);
        }
    });

}


//pos drug detail
function drugDetails(val) {
    "use strict";
    //alert(true);
    $.ajax({
        url: 'src/core.php?drug-detail=' + val,
        success: function (response) {
            $("#drug_details").html(response);
        }
    });
}

//customer search
$(function () {
    $("#sales_search").autocomplete({
        source: 'src/core.php?cust_search'
    });
});



//category select
function viewCategory(cat_id, page) {
    "use strict";
    window.location.href = 'default.php?' + page + '&cattype=' + cat_id;
}



//initialize wholesale
function startWholeSale() {
    "use strict";
    $.ajax({
        url: 'src/core.php?wholesale',
        success: function (response) {
            $("#result").html(response);
        }
    });

}

//exit wholesale
function ExitWholeSale() {
    "use strict";
    $.ajax({
        url: 'src/core.php?exit-wholesale',
        success: function (response) {
            $("#result").html(response);
        }
    });

}


//pos submit cart transaction
function commitTrans(val) {
    "use strict";
    var discount = document.getElementById('Cartdiscount').value;
    if (val === 2) {
        $.ajax({
            url: 'src/core.php?submitCart=2&discount=' + discount,
            success: function (response) {
                $("#select_result").html(response);
            }
        });
    } else {
        $.ajax({
            url: 'src/core.php?submitCart=1&discount=' + discount,
            success: function (response) {
                $("#select_result").html(response);
            }
        });
    }
}

//display transaction date filter
$(".filter_date").click(function () {
    $("#sales_filter").hide();
    $("#salesType_filter").hide();
    $("#date_filter").fadeIn();

});

//display transaction sales filter
$(".filter_sales").click(function () {
    $("#date_filter").hide();
    $("#salesType_filter").hide();
    $("#sales_filter").fadeIn();
});

//display transaction sales type
$(".filter_salesType").click(function () {
    $("#date_filter").hide();
    $("#sales_filter").hide();
    $("#salesType_filter").fadeIn();

});
// fileter datepicker1

$(function () {
    "use strict";
    $("#from_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        startDate: '-3d'
    });
});

// filter datepicker2
$(function () {
    $("#to_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        startDate: '-3d'
    });
});



////// application setting /////
//unit of measurement

//open application data modal
function openAppDataModal() {
    //alert(true);
    $.ajax({
        url: 'src/core.php?AppDataModal',
        success: function (response) {
            $("#modal_result").html(response);
        }
    });
}

//exit aplication data modal
function AppDataExit() {
    $.ajax({
        url: 'src/core.php?ExitAppData',
        success: function (response) {
            $("#result").html(response);
        }
    });
}

//preview logo before upload
function LogoreadURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('shop_logo').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// access control panel
function accessControl(id) {
    "use strict";

    $.ajax({
        url: 'src/core.php?access=' + id,
        success: function (response) {
            $("#users_gp").html(response);
        }
    });
}

//exit access control modal
function exitAccess() {
    "use strict";

    $.ajax({
        url: 'src/core.php?ExitAccess',
        success: function (response) {
            $("#users_gp").html(response);
        }
    });
}

//set access right
function setAccess(field, val, id) {
    "use strict";

    if (id) {
        if (document.getElementById(id).checked) {
            val = 1;
        } else {
            val = 0;
        }
    }
    $.ajax({
        url: 'src/core.php?field=' + field + '&val=' + val,
        success: function (response) {
            $("#setRole").html(response);
        }
    });
}

//delete users group
function delGroup(id) {
    "use strict";

    $.ajax({
        url: 'src/core.php?delGroup=' + id,
        success: function (response) {
            $("#config-result").html(response);
        }
    });
}



// delete customers transaction
function deleteCustTransact(id) {
    "use strict";
    $.ajax({
        url: 'src/core.php?delCustTransact=' + id,
        success: function (response) {
            $("#result").html(response);
        }
    });
}

// delete user account
function deleteUser(id) {
    "use strict";

    $.ajax({
        url: 'src/core.php?delUser=' + id,
        success: function (response) {
            $("#result").html(response);
        }
    });
}

//user account activateion/deactivation
function userStatus(val, user) {
    alert(true);
    "use strict";
    $.ajax({
        url: 'src/core.php?status=' + val + '&user=' + user,
        success: function (response) {
            $("#result").html(response);
        }
    });
}


function AdjProductQty(drugId, opt) {
    "use strict";    
    $.ajax({
        url: 'src/core.php?adjQty=' + opt + '&drugId=' + drugId,
        success: function (response) {
            $("#result").html(response);
        }
    });
}

//Post password reset
$('#passReset').bootstrap3Validate(function (e, data) {
    "use strict";
    e.preventDefault();
    $.ajax({
        url: "src/core.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            $("#passReset_Result").html(data);
        },
        error: function () {}
    });

});


//delete location
//delete deposit record
function deleteLocation(id) {
    "use strict";
    $.ajax({
        url: 'src/core.php?delLocation=' + id,
        success: function (response) {
            $("#result").html(response);
        }
    });
}

//delete supplier trasaction
function deleteSuppTrans(id) {
    "use strict";
    $.ajax({
        url: 'src/core.php?delSuppTrans=' + id,
        success: function (response) {
            $("#result").html(response);
        }
    });
}

//delete supplier trasaction
function deleteTransfer(id) {
    "use strict";
    $.ajax({
        url: 'src/core.php?deleteTransfer=' + id,
        success: function (response) {
            $("#result").html(response);
        }
    });
}


///supplier received goods payment
$('#SuppPayment').bootstrap3Validate(function (e, data) {
    e.preventDefault();
    $.ajax({
        url: "src/core.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            $("#select_result").html(data);
        },
        error: function () {}
    });

});



//delete transfer drug
function delTransferDrug(id) {
    "use strict";
    //alert(refNo);
    $.ajax({
        url: 'src/core.php?delTranDrug=' + id,
        success: function (response) {
            $("#result").html(response);
        }
    });
}

//update transfer drug data
function updateTData(id, field, val) {
    "use strict";
    //alert(field);
    $.ajax({
        url: 'src/core.php?TransferItems=' + id + '&fieldTG=' + field + '&valTG=' + val,
        success: function (response) {
            $("#result").html(response);
        }
    });
}



//load user group list
function loadAccessRight(entity, id) {
    "use strict";
    $("#accessPage").html('<center><img src="images/loader1.gif" alt="Loading..."/></center>');
    $.ajax({
        url: 'src/core.php?entity=' + entity + '&AccessLevel=' + id,
        success: function (response) {
            $("#accessPage").html(response);
        }
    });
}

