<?php
/************************************************
 	Function file for Feed Them Social plugin
************************************************/
if (isset($_GET['page']) && $_GET['page'] == 'feed-them-settings-page') {
  add_action('admin_enqueue_scripts', 'feed_them_premium_settings');
  
  function feed_them_premium_settings() {
	  wp_register_style( 'feed_them__premium_settings_css', plugins_url( 'admin/css/premium-settings-page.css',  dirname(__FILE__) ) );
	  wp_enqueue_style('feed_them__premium_settings_css'); 
  }
}

// Checks to see if Design Approval System plugin is installed and activated.
add_action( 'admin_notices', 'FTS_prem_dependencies' );

function FTS_prem_dependencies() {
 	if (is_plugin_active('feed-them-social/feed-them.php')) {
	}
	else  {
	deactivate_plugins( 'feed-them-premium/feed-them-premium.php' );
    	echo '<div class="error"><p>' . __( 'Warning: The <strong>Feed Them Social Premium</strong> extension has been deactivated because it needs the <a href="plugin-install.php?tab=search&s=Feed+Them+Social&plugin-search-input=Search+Plugins"><strong>Feed Them Social</strong></a> (Free version) plugin to be <strong>INSTALLED</strong> and <strong>ACTIVATED</strong> to function properly.', 'my-theme' ) . '</p></div>';
	}
}



/******* Add function for All Wordpress Text Widgets ***********/
if (!is_admin())
  add_filter('widget_text', 'do_shortcode', 11);


  

  
//YouTube FTS Widget
//CONSTRUCT Class
class fts_youtube_widget extends WP_Widget {
function fts_youtube_widget() {
    $widget_ops = array('classname' => 'YouTubeFTS', 'description' => 'Feed Them Social, YouTube Feed' );
    //WIDGET Name
    $this->WP_Widget('youtube_fts', 'FTS YouTube', $widget_ops);
}

//WIDGET Args
function widget($args, $instance) {
    extract($args, EXTR_SKIP);
    echo $before_widget;
    //WIDGET Database Checks
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_youtube_fts_title', $instance['title']);
    $youtube_name = empty($instance['youtube_name']) ? ' ' : apply_filters('widget_youtube_fts_youtube_name', $instance['youtube_name']);
 	$number_of_vids = empty($instance['number_of_vids']) ? ' ' : apply_filters('widget_youtube_fts_number_of_vids', $instance['number_of_vids']);
 	$youtube_columns = empty($instance['youtube_columns']) ? ' ' : apply_filters('widget_youtube_fts_youtube_columns', $instance['youtube_columns']);
 	$youtube_first_video = empty($instance['youtube_first_video']) ? ' ' : apply_filters('widget_youtube_fts_youtube_first_video', $instance['youtube_first_video']);
    $youtube_fts_shortcode = empty($instance['youtube_fts_shortcode']) ? ' ' : apply_filters('widget_youtube_fts_youtube_fts_shortcode', $instance['youtube_fts_shortcode']);
//HERE IS WHERE WE OUTPUT OUR TITLE AND SHORTCODE
if ( !empty( $title ) && (strlen($title) > 1 )) { echo $before_title . $title . $after_title; };
echo do_shortcode('[fts youtube username='.$youtube_name.' vid_count='.$number_of_vids.' vids_in_row='.$youtube_columns.' large_vid='.$youtube_first_video.']');
    echo $after_widget;
}
//WIDGET Save
function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['youtube_name'] = strip_tags($new_instance['youtube_name']);
	$instance['number_of_vids'] = strip_tags($new_instance['number_of_vids']);
	$instance['youtube_columns'] = strip_tags($new_instance['youtube_columns']);
	$instance['youtube_first_video'] = strip_tags($new_instance['youtube_first_video']);
    $instance['youtube_fts_shortcode'] = strip_tags($new_instance['youtube_fts_shortcode']);
    return $instance;
}
//WIDGET Admin Form
function form($instance) {
    //set your params, $instance and then any additional variables needed below
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'youtube_fts_shortcode' => '', 'youtube_name' => '' ) );
    $title = strip_tags($instance['title']);
    $youtube_name = strip_tags($instance['youtube_name']);
    $number_of_vids = strip_tags($instance['number_of_vids']);
    $youtube_columns = strip_tags($instance['youtube_columns']);
    $youtube_first_video = strip_tags($instance['youtube_first_video']);
    $youtube_fts_shortcode = strip_tags($instance['youtube_fts_shortcode']);
	
//Add CSS stylesheet for Widgets, I used the premium settings page to extend the widget CSS and save weight
 wp_enqueue_style( 'fts_youtube_css', plugins_url( 'admin/css/premium-settings-page.css',  dirname(__FILE__) ) );
?>
<div class="slickremix-widget-header-wrap">
<h2 class="fts-widget-header-h2">Feed Them Social</h2>
<h2 class="fts-widget-header-h3">YouTube Feed</h2>
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('title'); ?>">Your Title:</label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr__($title); ?>" />
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('youtube_name'); ?>">Youtube Name (required)</label>
  <input required="required" class="widefat" id="<?php echo $this->get_field_id('youtube_name'); ?>" name="<?php echo $this->get_field_name('youtube_name'); ?>" type="text" value="<?php echo esc_attr__($youtube_name); ?>" />
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('number_of_vids'); ?>">Number of Videos (required)</label>
  <input required="required" class="widefat" id="<?php echo $this->get_field_id('number_of_vids'); ?>" name="<?php echo $this->get_field_name('number_of_vids'); ?>" type="text" value="<?php echo esc_attr__($number_of_vids); ?>" />
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('youtube_columns'); ?>">Number of Videos in Each Row:</label>
  <select id="<?php echo $this->get_field_id('youtube_columns'); ?>" name="<?php echo $this->get_field_name('youtube_columns'); ?>" class="widefat" size="1">
    <option value="1" <?php selected('1', $instance['youtube_columns']); ?>>1 video per row</option>
    <option value="2" <?php selected('2', $instance['youtube_columns']); ?>>2 videos per row</option>
    <option value="3" <?php selected('3', $instance['youtube_columns']); ?>>3 videos per row</option>
    <option value="4" <?php selected('4', $instance['youtube_columns']); ?>>4 videos per row</option>
  </select>
</div>
<div class="fts-label-input-wrap last">
  <label for="<?php echo $this->get_field_id('youtube_first_video'); ?>">Show First video full size:</label>
  <select id="<?php echo $this->get_field_id('youtube_first_video'); ?>" name="<?php echo $this->get_field_name('youtube_first_video'); ?>" class="widefat" size="1">
    <option value="yes" <?php selected('yes', $instance['youtube_first_video']); ?>>yes</option>
    <option value="no" <?php selected('no', $instance['youtube_first_video']); ?>>no</option>
  </select>
</div>
<?php
    }
}
 //CREATE Widget
 add_action( 'widgets_init', create_function('', 'register_widget("fts_youtube_widget");') );
 //YouTube FTS Widget End











//Facebook Group FTS Widget
//CONSTRUCT Class
class fts_facebook_group_widget extends WP_Widget {
function fts_facebook_group_widget() {
    $widget_ops = array('classname' => 'FacebookGroupFTS', 'description' => 'Feed Them Social, Facebook Group Feed' );
    //WIDGET Name
    $this->WP_Widget('facebook_group_fts', 'FTS Facebook Group', $widget_ops);
}
//WIDGET Args
function widget($args, $instance) {
    extract($args, EXTR_SKIP);
    echo $before_widget;
    //WIDGET Database Checks
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_facebook_group_fts_title', $instance['title']);
    $facebook_group_name = empty($instance['facebook_group_name']) ? ' ' : apply_filters('widget_facebook_group_fts_facebook_group_name', $instance['facebook_group_name']);
 	$number_of_posts = empty($instance['number_of_posts']) ? ' ' : apply_filters('widget_facebook_group_fts_number_of_posts', $instance['number_of_posts']);
 	$fb_group_title = empty($instance['fb_group_title']) ? ' ' : apply_filters('widget_facebook_group_fts_fb_group_title', $instance['fb_group_title']);
 	$fb_group_description = empty($instance['fb_group_description']) ? ' ' : apply_filters('widget_facebook_group_fts_fb_group_description', $instance['fb_group_description']);
//HERE IS WHERE WE OUTPUT OUR TITLE AND SHORTCODE
if ( !empty( $title ) && (strlen($title) > 1 )) { echo $before_title . $title . $after_title; };
echo do_shortcode('[fts facebook group id='.$facebook_group_name.' posts='.$number_of_posts.' group_title='.$fb_group_title.' group_description='.$fb_group_description.']');
    echo $after_widget;
}
//WIDGET Save
function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['facebook_group_name'] = strip_tags($new_instance['facebook_group_name']);
	$instance['number_of_posts'] = strip_tags($new_instance['number_of_posts']);
    $instance['fb_group_title'] = strip_tags($new_instance['fb_group_title']);
    $instance['fb_group_description'] = strip_tags($new_instance['fb_group_description']);
	
    return $instance;
}
//WIDGET Admin Form
function form($instance) {
    //set your params, $instance and then any additional variables needed below
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'facebook_group_fts_shortcode' => '', 'facebook_group_name' => '', 'fb_group_title' => '', 'fb_group_description' => '' ) );
    $title = strip_tags($instance['title']);
    $facebook_group_name = strip_tags($instance['facebook_group_name']);
    $number_of_posts = strip_tags($instance['number_of_posts']);
    $fb_group_title = strip_tags($instance['fb_group_title']);
    $fb_group_description = strip_tags($instance['fb_group_description']);
?>
<div class="slickremix-widget-header-wrap">
<h2 class="fts-widget-header-h2">Feed Them Social</h2>
<h2 class="fts-widget-header-h3">FB Group Feed</h2>
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('title'); ?>">Your Title:</label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr__($title); ?>" />
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('facebook_group_name'); ?>">Facebook Group ID (required)</label>
  <input required class="widefat" id="<?php echo $this->get_field_id('facebook_group_name'); ?>" name="<?php echo $this->get_field_name('facebook_group_name'); ?>" type="text" value="<?php echo esc_attr__($facebook_group_name); ?>" />
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('number_of_posts'); ?>">Number of posts?</label>
  <input required class="widefat" id="<?php echo $this->get_field_id('number_of_posts'); ?>" name="<?php echo $this->get_field_name('number_of_posts'); ?>" type="text" value="<?php echo esc_attr__($number_of_posts); ?>" />
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('fb_group_title'); ?>">Show group title?</label>
  <select id="<?php echo $this->get_field_id('fb_group_title'); ?>" name="<?php echo $this->get_field_name('fb_group_title'); ?>" class="widefat" size="1">
    <option value="yes" <?php selected('yes', $instance['fb_group_title']); ?>>yes</option>
    <option value="no" <?php selected('no', $instance['fb_group_title']); ?>>no</option>
  </select>
</div>
<div class="fts-label-input-wrap last">
  <label for="<?php echo $this->get_field_id('fb_group_description'); ?>">Show group description?</label>
  <select id="<?php echo $this->get_field_id('fb_group_description'); ?>" name="<?php echo $this->get_field_name('fb_group_description'); ?>" class="widefat" size="1">
    <option value="yes" <?php selected('yes', $instance['fb_group_description']); ?>>yes</option>
    <option value="no" <?php selected('no', $instance['fb_group_description']); ?>>no</option>
  </select>
</div>

<?php
    }
}
 //CREATE Widget
 add_action( 'widgets_init', create_function('', 'register_widget("fts_facebook_group_widget");') );
 //Facebook Group FTS Widget End
 
 
//Twitter FTS Widget
//CONSTRUCT Class
class fts_twitter_widget extends WP_Widget {
function fts_twitter_widget() {
    $widget_ops = array('classname' => 'TwitterFTS', 'description' => 'Feed Them Social, Twitter Feed' );
    //WIDGET Name
    $this->WP_Widget('twitter_fts', 'FTS Twitter', $widget_ops);
}
//WIDGET Args
function widget($args, $instance) {
    extract($args, EXTR_SKIP);
    echo $before_widget;
    //WIDGET Database Checks
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_twitter_fts_title', $instance['title']);
    $twitter_name = empty($instance['twitter_name']) ? ' ' : apply_filters('widget_twitter_fts_twitter_name', $instance['twitter_name']);
 	$number_of_tweets = empty($instance['number_of_tweets']) ? ' ' : apply_filters('widget_twitter_fts_number_of_tweets', $instance['number_of_tweets']);
//HERE IS WHERE WE OUTPUT OUR TITLE AND SHORTCODE
if ( !empty( $title ) && (strlen($title) > 1 )) { echo $before_title . $title . $after_title; };
echo do_shortcode('[fts twitter twitter_name='.$twitter_name.' tweets_count='.$number_of_tweets.']');
    echo $after_widget;
}
//WIDGET Save
function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['twitter_name'] = strip_tags($new_instance['twitter_name']);
	$instance['number_of_tweets'] = strip_tags($new_instance['number_of_tweets']);
    return $instance;
}
//WIDGET Admin Form
function form($instance) {
    //set your params, $instance and then any additional variables needed below
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'twitter_fts_shortcode' => '', 'twitter_name' => '' ) );
    $title = strip_tags($instance['title']);
    $twitter_name = strip_tags($instance['twitter_name']);
    $number_of_tweets = strip_tags($instance['number_of_tweets']);
?>
<div class="slickremix-widget-header-wrap">
<h2 class="fts-widget-header-h2">Feed Them Social</h2>
<h2 class="fts-widget-header-h3">Twitter Feed</h2>
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('title'); ?>">Your Title:</label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr__($title); ?>" />
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('twitter_name'); ?>">Twitter Name (required)</label>
  <input required="required" class="widefat" id="<?php echo $this->get_field_id('twitter_name'); ?>" name="<?php echo $this->get_field_name('twitter_name'); ?>" type="text" value="<?php echo esc_attr__($twitter_name); ?>" />
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('number_of_tweets'); ?>">Number Tweets (required)</label>
  <input required="required" class="widefat" id="<?php echo $this->get_field_id('number_of_tweets'); ?>" name="<?php echo $this->get_field_name('number_of_tweets'); ?>" type="text" value="<?php echo esc_attr__($number_of_tweets); ?>" />
</div>
<?php
    }
}
 //CREATE Widget
 add_action( 'widgets_init', create_function('', 'register_widget("fts_twitter_widget");') );
 //Twitter FTS Widget End
 
 
 
 
 
 
 
 
 
 
 
 
 
//Instagram FTS Widget
//CONSTRUCT Class
class fts_instagram_widget extends WP_Widget {
function fts_instagram_widget() {
    $widget_ops = array('classname' => 'InstagramFTS', 'description' => 'Feed Them Social, Instagram Feed' );
    //WIDGET Name
    $this->WP_Widget('instagram_fts', ' FTS Instagram', $widget_ops);
}

//WIDGET Args
function widget($args, $instance) {
    extract($args, EXTR_SKIP);
    echo $before_widget;
    //WIDGET Database Checks
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_instagram_fts_title', $instance['title']);
    $instagram_name = empty($instance['instagram_name']) ? ' ' : apply_filters('widget_instagram_fts_instagram_name', $instance['instagram_name']);
 	$instagram_id = empty($instance['instagram_id']) ? ' ' : apply_filters('widget_instagram_fts_instagram_id', $instance['instagram_id']);
 	$number_of_pics = empty($instance['number_of_pics']) ? ' ' : apply_filters('widget_instagram_fts_number_of_pics', $instance['number_of_pics']);
//HERE IS WHERE WE OUTPUT OUR TITLE AND SHORTCODE
if ( !empty( $title ) && (strlen($title) > 1 )) { echo $before_title . $title . $after_title; };
echo do_shortcode('[fts instagram instagram_id='.$instagram_id.' pics_count='.$number_of_pics.']');
    echo $after_widget;
}
//WIDGET Save
function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['instagram_name'] = strip_tags($new_instance['instagram_name']);
	$instance['instagram_id'] = strip_tags($new_instance['instagram_id']);
	$instance['number_of_pics'] = strip_tags($new_instance['number_of_pics']);
    return $instance;
}
//WIDGET Admin Form
function form($instance) {
    //set your params, $instance and then any additional variables needed below
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'instagram_fts_shortcode' => '', 'instagram_name' => '' ) );
    $title = strip_tags($instance['title']);
    $instagram_name = strip_tags($instance['instagram_name']);
    $instagram_id = strip_tags($instance['instagram_id']);
    $number_of_pics = strip_tags($instance['number_of_pics']);
?>
<script type="text/javascript">
//START convert Instagram name to id. This widget method could use some improvements.
jQuery("input.feed-them-social-admin-submit-btn").click(function() {	
			jQuery.getJSON("https://api.instagram.com/v1/users/search?q=<?php echo $instagram_name; ?>&access_token=267791236.f78cc02.bea846f3144a40acbf0e56b002c112f8&callback=?",
			  {
				format: "json"
			  },
			  function(data) {
					console.log(data);
					var final_instagram_us_id = data.data[0].id;
					jQuery('input.instagram-id-class').val(final_instagram_us_id);
   			 })
})
</script>
<div class="slickremix-widget-header-wrap">
<h2 class="fts-widget-header-h2">Feed Them Social</h2>
<h2 class="fts-widget-header-h3">Instagram Feed</h2>
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('title'); ?>">Your Title:</label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr__($title); ?>" />
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('instagram_name'); ?>">Instagram Name (required)</label>
  <input required="required" class="widefat instagram-username" id="<?php echo $this->get_field_id('instagram_name'); ?>" name="<?php echo $this->get_field_name('instagram_name'); ?>" type="text" value="<?php echo esc_attr__($instagram_name); ?>" />
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('number_of_pics'); ?>">Number of Photos (required)</label>
  <input required="required" class="widefat number-of-picss" id="<?php echo $this->get_field_id('number_of_pics'); ?>" name="<?php echo $this->get_field_name('number_of_pics'); ?>" type="text" value="<?php echo esc_attr__($number_of_pics); ?>" />

</div>
<div class="fts-label-input-wrap">
<label>Click button Twice to Convert</label>
<input type="submit" name="savewidget" class="feed-them-social-admin-submit-btn button button-primary widget-control-save left" value="Convert Instagram Username">
</div>
<div class="fts-label-input-wrap last" style="display:noneee;">
  <label for="<?php echo $this->get_field_id('instagram_id'); ?>">Instagram ID (required)</label>
   <input class="widefat instagram-id-class" id="<?php echo $this->get_field_id('instagram_id'); ?>" name="<?php echo $this->get_field_name('instagram_id'); ?>" type="text" value="<?php echo esc_attr__($instagram_id); ?>" />
</div>


<?php
    }
}
 //CREATE Widget
 add_action( 'widgets_init', create_function('', 'register_widget("fts_instagram_widget");') );
 //Instagram FTS Widget End
 
 
 
 
 
 
 
//Pinterest FTS Widget
//CONSTRUCT Class
class fts_pinterest_widget extends WP_Widget {
function fts_pinterest_widget() {
    $widget_ops = array('classname' => 'PinterestFTS', 'description' => 'Feed Them Social, Pinterest Feed' );
    //WIDGET Name
    $this->WP_Widget('pinterest_fts', 'FTS Pinterest', $widget_ops);
}
//WIDGET Args
function widget($args, $instance) {
    extract($args, EXTR_SKIP);
    echo $before_widget;
    //WIDGET Database Checks
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_pinterest_fts_title', $instance['title']);
    $pinterest_name = empty($instance['pinterest_name']) ? ' ' : apply_filters('widget_pinterest_fts_pinterest_name', $instance['pinterest_name']);
 	$boards_count = empty($instance['boards_count']) ? ' ' : apply_filters('widget_pinterest_fts_boards_count', $instance['boards_count']);
//HERE IS WHERE WE OUTPUT OUR TITLE AND SHORTCODE
if ( !empty( $title ) && (strlen($title) > 1 )) { echo $before_title . $title . $after_title; };
echo do_shortcode('[fts pinterest pinterest_name='.$pinterest_name.' boards_count='.$boards_count.']');
    echo $after_widget;
}
//WIDGET Save
function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['pinterest_name'] = strip_tags($new_instance['pinterest_name']);
	$instance['boards_count'] = strip_tags($new_instance['boards_count']);
    return $instance;
}
//WIDGET Admin Form
function form($instance) {
    //set your params, $instance and then any additional variables needed below
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'pinterest_fts_shortcode' => '', 'pinterest_name' => '' ) );
    $title = strip_tags($instance['title']);
    $pinterest_name = strip_tags($instance['pinterest_name']);
    $boards_count = strip_tags($instance['boards_count']);
?>
<div class="slickremix-widget-header-wrap">
<h2 class="fts-widget-header-h2">Feed Them Social</h2>
<h2 class="fts-widget-header-h3">Pinterest Feed</h2>
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('title'); ?>">Your Title:</label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr__($title); ?>" />
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('pinterest_name'); ?>">Pinterest Name (required)</label>
  <input required="required" class="widefat" id="<?php echo $this->get_field_id('pinterest_name'); ?>" name="<?php echo $this->get_field_name('pinterest_name'); ?>" type="text" value="<?php echo esc_attr__($pinterest_name); ?>" />
</div>
<div class="fts-label-input-wrap">
  <label for="<?php echo $this->get_field_id('boards_count'); ?>">Number Boards (required)</label>
  <input required="required" class="widefat" id="<?php echo $this->get_field_id('boards_count'); ?>" name="<?php echo $this->get_field_name('boards_count'); ?>" type="text" value="<?php echo esc_attr__($boards_count); ?>" />
</div>
<?php
    }
}
 //CREATE Widget
 add_action( 'widgets_init', create_function('', 'register_widget("fts_pinterest_widget");') );
 //Pinterest FTS Widget End