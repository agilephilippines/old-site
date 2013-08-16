var fb_group_post_count = ' posts=' + jQuery("input#fb_group_post_count").val();
if (fb_group_post_count == " posts=") {
	  var fb_group_post_count_final='';
	}
	if (fb_group_post_count != " posts="){
	  var fb_group_post_count_final = fb_group_post_count;
	  var fb_group_title_option = ' group_title=' + jQuery("select#fb_group_title_option").val();
	  var fb_group_description_option = ' group_description=' + jQuery("select#fb_group_description_option").val();
}
var final_fb_group_shorcode = '[fts facebook group' + fb_group_id  + fb_group_post_count_final + fb_group_title_option + fb_group_description_option + ']'