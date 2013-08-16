<?php
/**
 * Preview post/page widget
 *
 * @package aThemes Widget Pack
 * @version 1.0
 */

/**
 * Adds aThemes_Preview_Post widget.
 */
add_action( 'widgets_init', create_function( '', 'register_widget( "athemes_preview_post" );' ) );
class aThemes_Preview_Post extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'athemes_preview_post',
			'AT Preview Post',
			array(
				'description'	=> __( 'A widget that shows post/page preview', 'athemes' )
			)
		);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
		$fields = array(
			// This widget has no title
			
			// Other fields
			'post_id' => array (
				'athemes_widgets_name'			=> 'post_id',
				'athemes_widgets_title'			=> __( 'Post ID', 'athemes' ),
				'athemes_widgets_field_type'		=> 'number'
			),
			'display_title' => array (
				'athemes_widgets_name'			=> 'display_title',
				'athemes_widgets_title'			=> __( 'Show post title', 'athemes' ),
				'athemes_widgets_field_type'		=> 'checkbox'
			),
			'display_thumbnail' => array (
				'athemes_widgets_name'			=> 'display_thumbnail',
				'athemes_widgets_title'			=> __( 'Show featured image', 'athemes' ),
				'athemes_widgets_field_type'		=> 'checkbox'
			),
			'display_excerpt' => array (
				'athemes_widgets_name'			=> 'display_excerpt',
				'athemes_widgets_title'			=> __( 'Show excerpt', 'athemes' ),
				'athemes_widgets_field_type'		=> 'checkbox'
			),
			'read_more_text' => array (
				'athemes_widgets_name'			=> 'read_more_text',
				'athemes_widgets_title'			=> __( 'Read more link text', 'athemes' ),
				'athemes_widgets_description'	=> __( 'Leave empty for no link', 'athemes' ),
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
		
		$post_id			= $instance['post_id'];
		$display_title		= $instance['display_title'];
		$display_thumbnail	= $instance['display_thumbnail'];
		$display_excerpt	= $instance['display_excerpt'];
		$read_more_text		= $instance['read_more_text'];

		// No need to do anything if 'post_id' field is empty
		if( isset( $post_id ) ) {
		
			// Check if that ID exists
			if( $post_object = get_post( $post_id ) ) {
		
				echo $before_widget;
				
				// Check if title needs to be shown
				if( isset( $display_title ) && isset( $post_object->post_title ) )
					echo $before_title . $post_object->post_title . $after_title;

				// Check if thumbnail needs to be shown and if post has thumbnail
				if( $display_thumbnail && has_post_thumbnail( $post_id ) )
					echo '<div class="widget-preview-thumbnail">' . get_the_post_thumbnail( $post_id, 'thumb-medium' ) . '</div>';

				// Check if excerpt needs to be shown
				if( $display_excerpt )
					echo '<p class="widget-preview-excerpt">' . wpautop( $post_object->post_excerpt ? $post_object->post_excerpt : athemes_limit_string(strip_tags($post_object->post_content), 150) ) . '</p>';			

				// Check if excerpt needs to be shown
				if( $read_more_text )
					echo '<div class="widget-preview-more"><a href="' . get_permalink( $post_id ) . '">' . $read_more_text . '</a></div>';			
				
				echo $after_widget;
				
			}
		
		}
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param	array	$new_instance	Values just sent to be saved.
	 * @param	array	$old_instance	Previously saved values from database.
	 *
	 * @uses	athemes_widgets_updated_field_value()		defined in widget-fields.php
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
	 * @param	array $instance Previously saved values from database.
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