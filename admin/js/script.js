$(document).ready(function() {

    //$("html").niceScroll(); /* Nice Scroll */

	$(".formValidation").on("submit", function(e){
	  
	  var errorMessage  = $(".errorMessage");
	  var hasError = false;
	  
	  $(".inputValidation").each(function(){
		var $this = $(this);
		
		if($this.val() == ""){
		  hasError = true;
		  $this.addClass("inputError");
		  errorMessage.html("<p>Error: Please correct errors above</p>");
		  e.preventDefault();
		}if($this.val() != ""){
		  $this.removeClass("inputError"); 
		}else{
		  return true; 
		}
	  }); //Input
	  
	  errorMessage.slideDown(1000);
	}); //Form .submit

 });