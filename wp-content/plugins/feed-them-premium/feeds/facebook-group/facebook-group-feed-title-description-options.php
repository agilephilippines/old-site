<?php 
// Print our Facebook Group Title or Description....Or Not, you can also choose one or the other.
	print '<div class="fts-jal-fb-group-display">';
  if ($group_title_yes == 'yes') {
    print '<div class="fts-jal-fb-header"><h1><a href="http://www.facebook.com/home.php?sk=group_'.$group_id.'&ap=1">'.$des->name.'</a></h1>';
  }
  if ($group_description_yes == 'yes') {
     print '<div class="fts-jal-fb-group-header-desc">'.$des->description.'</div></div>';	
   }
   
   // this is in place for our prevoius 20k downloaders so they are not forced to redo the short code on existing posts.
   if ($group_title_yes == '') {
    print '<div class="fts-jal-fb-header"><h1><a href="http://www.facebook.com/home.php?sk=group_'.$group_id.'&ap=1">'.$des->name.'</a></h1>';
  }
  if ($group_description_yes == '') {
     print '<div class="fts-jal-fb-group-header-desc">'.$des->description.'</div></div>';	
   }
?>