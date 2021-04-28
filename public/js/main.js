$(document).ready(function(){
    // dropdown search
    $('.select2').select2();

    // When the user clicks on the button, scroll to the top of the document
    $('#backToTop').click(function(e){
		e.preventDefault();
	$('html, body').animate({scrollTop:0},'100000');
	});

});
