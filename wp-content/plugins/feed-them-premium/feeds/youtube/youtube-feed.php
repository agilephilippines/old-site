<?php

add_action('wp_enqueue_scripts', 'fts_youtube_head');
function  fts_youtube_head() {
    wp_enqueue_style( 'fts_youtube_css', plugins_url( 'youtube/css/styles.css',  dirname(__FILE__) ) );
}

add_shortcode( 'fts youtube', 'fts_youtube_func' );

//Main Funtion
function fts_youtube_func($atts){
	
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	extract( shortcode_atts( array(
		'username' => '',
		'vid_count' => '1',
		'large_vid' => '',
		'vids_in_row' => '',
	), $atts ) );
	
	
ob_start();
?>
 
<script type="text/javascript">
 
function listVideos(data) {
  var firstOutput="";
  var entries = data.feed.entry;
  var myOutput = '<ul>';
  for (var i=0; i<data.feed.entry.length; i++) {
    var entriesID=entries[i].id.$t.substring(38);
    var entriesTitle=entries[i].title.$t;
    var entriesDescription=entries[i].media$group.media$description.$t;
    var entriesThumbnail=entries[i].media$group.media$thumbnail[0].url;
	var vids_in_row='<?php print $vids_in_row?>';
	var largeVid = '<?php print $large_vid?>';
	var vid_id=data.feed.entry[i].id.$t.split('/').reverse()[0];
	
	if (vids_in_row=='1') {
	   myOutput += '<li><div class="entriestitle">' + entriesTitle + '</div>';
	   myOutput+='<iframe id="fts-'+vid_id+'" src="http://www.youtube.com/embed/'+entriesID+'?wmode=transparent&HD=0&rel=0&showinfo=0&controls=1&fs=1&autoplay=0" frameborder="0" allowfullscreen></iframe>';
	   myOutput += '</li>';
	}
	else	{
	 myOutput += '<li><div class="entriestitle">' + entriesTitle + '</div>';
	  myOutput+='<a href="#fts-'+vid_id+'" id="fts-'+vid_id+'-open" onClick="startVideos();" rel="fts-yt-iframe-'+vid_id+'" class="fts-yt-popup-open"><img src="'+ entriesThumbnail +'" /></a>';
	  
	  myOutput+='<div id="fts-'+vid_id+'" class="fts-yt-overlay-wrap">';
	  	myOutput+='<div class="fts-yt-overlay">';
		myOutput+='<iframe id="fts-yt-iframe-'+vid_id+'" class="fts-yt-player" src="http://www.youtube.com/embed/'+entriesID+'?&wmode=transparent&HD=0&rel=0&showinfo=0&controls=1&fs=1" frameborder="0" allowfullscreen></iframe>';
		  myOutput+='<a href="#fts-yt-popup-close" onClick="stopVideos();" rel="fts-yt-iframe-'+vid_id+'" class="fts-yt-popup-close">Close</a>';
		myOutput+='</div>';
	  myOutput+='</div>';
	  myOutput += '</li>';
			  
	 };
	  
	if (largeVid=='yes') {
		if (i==0) {
		  firstOutput += '<div class="fts-yt-first-video">';
		  firstOutput += '<h2>' + entriesTitle + '</h2>';
		  firstOutput += '<iframe src="http://www.youtube.com/embed/'+entriesID+'?wmode=transparent&HD=0&rel=0&showinfo=0&controls=1&autoplay=0" frameborder="0" allowfullscreen></iframe>';
		  firstOutput += '<p>' + entriesDescription + '</p>';
		  firstOutput += '</div>';
		  document.getElementById('fts-yt-large-<?php print $username?>').innerHTML=firstOutput;
		}
	}
  }
  document.getElementById('fts-yt-videolist-<?php print $username?>').innerHTML = myOutput;
  myOutput +='</ul>';

}

function stopVideos() {
   jQuery('a.fts-yt-popup-close').live('click',function(){
	  var this_frame = jQuery(this).attr('rel');
	  var old_fixed_src = jQuery('#'+this_frame).attr('src');
	  new_src = old_fixed_src.replace("&autoplay=1", "");
	  jQuery('#'+this_frame).attr('src', new_src);
    });
}

function startVideos() {
	jQuery('a.fts-yt-popup-open').live('click',function(){
	  var this_frame = jQuery(this).attr('rel');
	  var fixed_src = jQuery('#'+this_frame).attr('src') + '&autoplay=1';
	  jQuery('#'+this_frame).attr('src', fixed_src);
    });
}


</script>

<div id="fts-yt-videogroup-<?php print $username?>" class="fts-yt-videogroup fts-yt-user-<?php print $username?> fts-yt-vids-in-row<?php print $vids_in_row?>">
  <div id="fts-yt-large-<?php print $username?>" class="fts-yt-large"></div>
  <div id="fts-yt-videolist-<?php print $username?>" class="fts-yt-videolist"></div>
</div>
 
<script type="text/javascript" src="http://gdata.youtube.com/feeds/users/<?php print $username?>/uploads?alt=json-in-script&callback=listVideos&max-results=<?php print $vid_count?>"></script>

<?php   	
	return ob_get_clean();
}
?>