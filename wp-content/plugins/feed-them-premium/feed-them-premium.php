<?php
/*
Plugin Name: Feed Them Social Premium
Plugin URI: http://slickremix.com/
Description: This is a premium extension for the Feed Them Social plugin.
Version: 1.1.5
Author: SlickRemix
Author URI: http://slickremix.com/
Requires at least: wordpress 3.4.0
Tested up to: wordpress 3.6
Stable tag: 1.1.5

 * @package    			Feed Them Social Premium
 * @category   			Core
 * @author     		    SlickRemix
 * @copyright  			Copyright (c) 2013 SlickRemix

If you need support or want to tell us thanks please contact us at info@slickremix.com or use our support forum on slickremix.com

This is the main file for building the plugin into wordpress
*/

// Include core files and classes
include( 'includes/feed-them-premium-functions.php' );

include( 'feeds/youtube/youtube-feed.php' );

include( 'feeds/pinterest/pinterest.php' );

?><?php //BEGIN::SELF_HOSTED_PLUGIN_MOD
					
	/**********************************************
	* The following was added by Self Hosted Plugin
	* to enable automatic updates
	* See http://wordpress.org/extend/plugins/self-hosted-plugins
	**********************************************/
	require "__plugin-updates/plugin-update-checker.class.php";
	$__UpdateChecker = new PluginUpdateChecker('http://www.slickremix.com/extend/plugins/feed-them-premium/update', __FILE__,'feed-them-premium');			
	
//END::SELF_HOSTED_PLUGIN_MOD ?>