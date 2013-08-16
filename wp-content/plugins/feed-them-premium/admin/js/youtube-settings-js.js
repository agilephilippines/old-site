//START youtube//
jQuery('.youtube_first_video').hide();

jQuery('select#youtube_columns').change(function(){
	var youtube_columns_count = jQuery(this).val();
	
	if (youtube_columns_count == '1') {
		jQuery('.youtube_first_video').hide();
	}
	else	{
		jQuery('.youtube_first_video').show();
	}
});

function updateTextArea_youtube() {
	
	var youtube_name = ' username=' + jQuery("input#youtube_name").val();
	var youtube_vid_count = ' vid_count=' + jQuery("input#youtube_vid_count").val();
	var youtube_columns = ' vids_in_row=' + jQuery("select#youtube_columns").val();
	
	//check # of vids in row//
	var youtube_columns_count = jQuery('select#youtube_columns').val();
	
	if (youtube_columns_count == '1') {
		var youtube_first_video = '';
	}
	else	{
		var youtube_first_video = ' large_vid=' + jQuery("select#youtube_first_video").val();
	}
	
	if (youtube_name == " youtube_name=") {
	  	 jQuery(".youtube_name").addClass('fts-empty-error');  
      	 jQuery("input#youtube_name").focus();
		 return false;
	}
	if (youtube_name != " youtube_name=") {
	  	 jQuery(".youtube_name").removeClass('fts-empty-error');  
	}
	
		var final_youtube_shorcode = '[fts youtube' + youtube_name + youtube_vid_count + youtube_columns + youtube_first_video + ']'


jQuery('.youtube-final-shortcode').val(final_youtube_shorcode);
	
	jQuery('.youtube-shortcode-form .final-shortcode-textarea').slideDown();
}
//END youtube//