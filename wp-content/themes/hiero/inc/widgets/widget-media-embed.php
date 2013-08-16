<?php
/**
 * oEmbed widget
 *
 * @package aThemes Widget Pack
 * @version 1.0
 */

/**
 * Adds aThemes_Media_Embed widget.
 */
add_action( 'widgets_init', create_function( '', 'register_widget( "athemes_media_embed" );' ) );
class aThemes_Media_Embed extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'athemes_media_embed',
			'AT Media Embed',
			array(
				'description'	=> __( 'Display media (video/slideshow) widget, support many sites including YouTube, Vimeo, Flickr, etc.', 'athemes' )
			)
		);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
		$fields = array(
			// Title
			'widget_title' => array(
				'athemes_widgets_name'			=> 'widget_title',
				'athemes_widgets_title'			=> __( 'Title', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
			
			// Other fields
			'embed_url' => array (
				'athemes_widgets_name'			=> 'embed_url',
				'athemes_widgets_title'			=> __( 'Embed URL', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
			'embed_width' => array (
				'athemes_widgets_name'			=> 'embed_width',
				'athemes_widgets_title'			=> __( 'Embed width in pixels', 'athemes' ),
				'athemes_widgets_field_type'		=> 'number'
			),
			'embed_description' => array (
				'athemes_widgets_name'			=> 'embed_description',
				'athemes_widgets_title'			=> __( 'Description', 'athemes' ),
				'athemes_widgets_field_type'		=> 'textarea',
				'athemes_widgets_allowed_tags'		=> '<strong>'
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
		
		$widget_title		= apply_filters( 'widget_title', $instance['widget_title'] );
		$embed_url 			= $instance['embed_url'];
		$embed_width		= $instance['embed_width'];
		$embed_description	= $instance['embed_description'];
				
		echo $before_widget; ?>
		
		<div class="widget-oembed">
			<?php
				// Show title
				if( isset( $widget_title ) ) {
					echo $before_title . $widget_title . $after_title;
				}
			?>
			
			<?php
				// Check if embed URL is entered
				if( isset( $embed_url ) ) {
				echo '<div class="widget-oembed-content">';
					// Check if user entered embed width
					if( isset( $embed_width ) && $embed_width > 0 ) {
						echo wp_oembed_get( $embed_url, array( 'width' => $embed_width ) );
					} else {
						echo wp_oembed_get( $embed_url );
					}
				echo '<!-- .widget-oembed-content --></div>';
				}

				if( isset( $embed_description ) ) {
					echo '<div class="widget-oembed-description">' . $embed_description . '</div>';
				}
			?>
		<!-- .widget-oembed --></div>
		
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