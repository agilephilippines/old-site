function updateTextArea_pinterest() {

	var pinterest_name = ' pinterest_name=' + jQuery("input#pinterest_name").val(); 
	
	if (pinterest_name == " pinterest_name=") {
	  	 jQuery(".pinterest_name").addClass('fts-empty-error');  
      	 jQuery("input#pinterest_name").focus();
		 return false;
		 
	}
	if (pinterest_name != " pinterest_name=") {
	  	 jQuery(".pinterest_name").removeClass('fts-empty-error');  
	}
	
	var boards_count = ' boards_count=' + jQuery("input#boards_count").val();

	if (boards_count == " boards_count=") {
	  var boards_count_final='';
	}
	if (boards_count != " boards_count="){
	 var boards_count_final = boards_count;
	}
	
var final_pinterest_shorcode = '[fts pinterest' + pinterest_name  + boards_count_final + ']'

jQuery('.pinterest-final-shortcode').val(final_pinterest_shorcode);
	
	jQuery('.pinterest-shortcode-form .final-shortcode-textarea').slideDown();
}