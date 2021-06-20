<script>
  // $( function() {
  //   $(".datepicker").datepicker({dateFormat: "yy-mm-dd"}).attr('readonly',true);
  // });
  function showAlert(data,time=2){
    $('#messageBox').text(data);
    $('#messageBox').show();
    setInterval(function(){
      $('#messageBox').hide();
    }, time*1000);
  }
  // $('[rel=tooltip]').tooltip({trigger: "hover"});
  function delayTime(time=2){
    setInterval(function(){
      $('#messageBox').hide();
    }, time*1000);
  }
  $(document).ready(function(){
    // toggle sidebar
    $('#sidebarToggle').click(function(){
      $('.sidebar').toggle();
    });
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

  });
</script>
