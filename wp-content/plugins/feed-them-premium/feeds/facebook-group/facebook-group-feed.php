<?php 
	extract( shortcode_atts( array(
		'id' => '',
		'posts' => '5',
		'group_title' => '',
		'group_description' => '',
	), $atts ) );
	
	$fts_limiter = $posts;
	$group_id = $id;
	$group_title_yes = $group_title;
	$group_description_yes = $group_description;
	$access_token = '226916994002335|ks3AFvyAOckiTA1u_aDoI4HYuuw';
?>