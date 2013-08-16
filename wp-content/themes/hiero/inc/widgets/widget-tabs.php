<?php
/**
 * Tabber widget
 *
 * @package aThemes Widget Pack
 * @version 1.0
 */

/**
 * Adds aThemes_Tabs widget.
 */
add_action( 'widgets_init', create_function( '', 'register_widget( "athemes_tabs" );' ) );
class aThemes_Tabs extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'athemes_tabs',
			'AT Tabs',
			array(
				'description'	=> __( 'Display a tabbed content widget for your popular posts, recent posts and popular tags.', 'athemes' )
			)
		);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
		$fields = array(
			// Other fields
			'tabs_post_count' => array (
				'athemes_widgets_name'				=> 'tabs_post_count',
				'athemes_widgets_title'			=> __( 'Posts to Show', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
			'tabs_tag_count' => array (
				'athemes_widgets_name'				=> 'tabs_tag_count',
				'athemes_widgets_title'			=> __( 'Tags to Show', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
		);
		
		return $fields;
	 }

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		
		$tabs_post_count	= $instance['tabs_post_count'];
		$tabs_tag_count		= $instance['tabs_tag_count'];

		echo $before_widget;
		?>

		<ul id="widget-tab" class="clearfix widget-tab-nav">
			<li class="active"><a href="#widget-tab-popular"><?php _e( 'Popular', 'athemes' ); ?></a></li>
			<li><a href="#widget-tab-latest"><?php _e('Latest', 'athemes' ); ?></a></li>
			<li><a href="#widget-tab-tags"><?php _e( 'Tags', 'athemes' ); ?></a></li>
		</ul>
 
		<div class="widget-tab-content">
			<div class="tab-pane active" id="widget-tab-popular">
				<ul>
				<?php $popular = new WP_Query('orderby=comment_count&ignore_sticky_posts=1&posts_per_page=' . $tabs_post_count );
					while ($popular->have_posts()) : $popular->the_post(); ?>								
					<li class="clearfix">
						<?php if ( has_post_thumbnail() ) { ?>
						<div class="widget-entry-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'thumb-small', array( 'title' => get_the_title() ) ); ?></a>
						</div>
						<div class="widget-entry-summary">
							<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
							<span><?php comments_number( __( 'No Comments', 'athemes' ), __( '1 Comment', 'athemes' ), __( '% Comments', 'athemes' ) ); ?></span>
						</div>
						<?php } else { ?>
						<div class="widget-entry-content">
							<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
							<span><?php comments_number( __( 'No Comments', 'athemes' ), __( '1 Comment', 'athemes' ), __( '% Comments', 'athemes' ) ); ?></span>
						</div>
						<?php } ?>
					</li>
				<?php endwhile; wp_reset_query(); ?>
				</ul>
			<!-- #widget-tab-popular --></div>

			<div class="tab-pane" id="widget-tab-latest">
				<ul>
					<?php $latest = new WP_Query('orderby=post_date&order=DESC&ignore_sticky_posts=1&posts_per_page=' . $tabs_post_count );
					while ( $latest -> have_posts() ) : $latest -> the_post(); ?>
					<li class="clearfix">
						<?php if ( has_post_thumbnail() ) { ?>
						<div class="widget-entry-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'thumb-small', array( 'title' => get_the_title() ) ); ?></a>
						</div>
						<div class="widget-entry-summary">
							<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
							<span><?php the_time('F d, Y'); ?></span>
						</div>							
						<?php } else { ?>
						<div class="widget-entry-content">
							<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
							<span><?php the_time('F d, Y'); ?></span>
						</div>							
						<?php } ?>
					</li>
					<?php endwhile; wp_reset_query(); ?>
				</ul>
			<!-- #widget-tab-latest --></div>

			<div class="tab-pane" id="widget-tab-tags">
				<?php wp_tag_cloud('smallest=1&largest=1.6&unit=em&orderby=count&order=DESC&number=' . $tabs_tag_count ); ?>
			<!-- #widget-tab-tags --></div>
		</div>

	<?php
		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param	array	$new_instance	Values just sent to be saved.
	 * @param	array	$old_instance	Previously saved values from database.
	 *
	 * @uses	athemes_widgets_show_widget_field()		defined in widget-fields.php
	 *
	 * @return	array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach( $widget_fields as $widget_field ) {
			extract( $widget_field );
	
			// Use helper function to get updated field values
			$instance[$athemes_widgets_name] = athemes_widgets_updated_field_value( $widget_field, $new_instance[$athemes_widgets_name] );
			echo $instance[$athemes_widgets_name];
		}
				
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @uses	athemes_widgets_show_widget_field()		defined in widget-fields.php
	 */
	public function form( $instance ) {
		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach( $widget_fields as $widget_field ) {
		
			// Make array elements available as variables
			extract( $widget_field );
			$athemes_widgets_field_value = isset( $instance[$athemes_widgets_name] ) ? esc_attr( $instance[$athemes_widgets_name] ) : '';			
			athemes_widgets_show_widget_field( $this, $widget_field, $athemes_widgets_field_value );
		
		}	
	}

}