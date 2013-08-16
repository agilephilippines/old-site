<?php
/**
 * aThemes functions and definitions
 *
 * @package aThemes
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'athemes_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function athemes_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /lang/ directory
	 * If you're building a theme based on aThemes, use a find and replace
	 * to change 'athemes' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'athemes', get_template_directory() . '/lang' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'thumb-small', 50, 50, true );
	add_image_size( 'thumb-medium', 300, 135, true );
	add_image_size( 'thumb-featured', 250, 175, true );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'main' => __( 'Main Menu', 'athemes' ),
	) );
}
endif; // athemes_setup
add_action( 'after_setup_theme', 'athemes_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function athemes_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'athemes' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Header', 'athemes' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sub Footer 1', 'athemes' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sub Footer 2', 'athemes' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sub Footer 3', 'athemes' ),
		'id'            => 'sidebar-5',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sub Footer 4', 'athemes' ),
		'id'            => 'sidebar-6',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
}
add_action( 'widgets_init', 'athemes_widgets_init' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since aThemes 1.0
 */
function athemes_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-6' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'site-extra extra-one';
			break;
		case '2':
			$class = 'site-extra extra-two';
			break;
		case '3':
			$class = 'site-extra extra-three';
			break;
		case '4':
			$class = 'site-extra extra-four';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

/**
 * Enqueue scripts and styles
 */
function athemes_scripts() {
	$protocol = is_ssl() ? 'https' : 'http';
	$query_args = array(
		'family' => 'Yanone+Kaffeesatz:200,300,400,700',
	);
	wp_enqueue_style( 'athemes-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ) );
	wp_enqueue_style( 'athemes-glyphs', get_template_directory_uri() . '/css/athemes-glyphs.css' );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'athemes-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ) );
	wp_enqueue_script( 'supersubs', get_template_directory_uri() . '/js/supersubs.js', array( 'jquery' ) );
	wp_enqueue_script( 'athemes-settings', get_template_directory_uri() . '/js/settings.js', array( 'jquery' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'athemes_scripts' );

define('ATHEMES_PATH', get_template_directory() );
/**
 * Custom functions that act independently of the theme templates.
 */
require ATHEMES_PATH . '/inc/extras.php';

/**
 * Custom template tags for this theme.
 */
require ATHEMES_PATH . '/inc/template-tags.php';

/**
 * Add social links on user profile page.
 */
require ATHEMES_PATH . '/inc/user-profile.php';

/**
 * Add custom widgets
 */
require ATHEMES_PATH . '/inc/custom-widgets.php';