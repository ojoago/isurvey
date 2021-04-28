// JavaScript Document
 //new user page loading
function module_load(page){
	"use strict";
	//alert(page);
	$("#contents").html('');
	$("#page_loader").html('<img src="images/loading.gif" alt="Loading..."/>');
      $.ajax({
        url: 'config/menu.php?v='+page,
        success: function(response) {
            $("#contents").html(response);
			$("#page_loader").html('');
			
			//DiscountByVal(0);
        }
     });
 }



