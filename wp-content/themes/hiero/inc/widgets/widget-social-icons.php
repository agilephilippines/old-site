<?php
/**
 * Social icons widget
 *
 * @package aThemes Widget Pack
 * @version 1.0
 */

/**
 * Adds aThemes_Social_Icons widget.
 */
add_action( 'widgets_init', create_function( '', 'register_widget( "athemes_social_icons" );' ) );
class aThemes_Social_Icons extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'athemes_social_icons',
			'AT Social Icons',
			array(
				'description'	=> __( 'Display links to your social network profiles, enter full profile URLs', 'athemes' )
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
			'twitter' => array (
				'athemes_widgets_name'			=> 'twitter',
				'athemes_widgets_title'			=> __( 'Twitter', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
			'facebook' => array (
				'athemes_widgets_name'			=> 'facebook',
				'athemes_widgets_title'			=> __( 'Facebook', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
			'linkedin' => array (
				'athemes_widgets_name'			=> 'linkedin',
				'athemes_widgets_title'			=> __( 'LinkedIn', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
			'gplus' => array (
				'athemes_widgets_name'			=> 'gplus',
				'athemes_widgets_title'			=> __( 'Google+', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
			'pinterest' => array (
				'athemes_widgets_name'			=> 'pinterest',
				'athemes_widgets_title'			=> __( 'Pinterest', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
			'youtube' => array (
				'athemes_widgets_name'			=> 'youtube',
				'athemes_widgets_title'			=> __( 'YouTube', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
			'vimeo' => array (
				'athemes_widgets_name'			=> 'vimeo',
				'athemes_widgets_title'			=> __( 'Vimeo', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
			'flickr' => array (
				'athemes_widgets_name'			=> 'flickr',
				'athemes_widgets_title'			=> __( 'Flickr', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
			'dribbble' => array (
				'athemes_widgets_name'			=> 'dribbble',
				'athemes_widgets_title'			=> __( 'Dribbble', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
			'tumblr' => array (
				'athemes_widgets_name'			=> 'tumblr',
				'athemes_widgets_title'			=> __( 'Tumblr', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
			'instagram' => array (
				'athemes_widgets_name'			=> 'instagram',
				'athemes_widgets_title'			=> __( 'Instagram', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
			'lastfm' => array (
				'athemes_widgets_name'			=> 'lastfm',
				'athemes_widgets_title'			=> __( 'Last.fm', 'athemes' ),
				'athemes_widgets_field_type'		=> 'text'
			),
			'soundcloud' => array (
				'athemes_widgets_name'			=> 'soundcloud',
				'athemes_widgets_title'			=> __( 'SoundCloud', 'athemes' ),
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
		
		$widget_title 			= apply_filters( 'widget_title', $instance['widget_title'] );
				
		echo $before_widget;
		
		// Show title
		if( isset( $widget_title ) ) {
			echo $before_title . $widget_title . $after_title;
		}

		echo '<ul class="clearfix widget-social-icons">';
			// Loop through fields
			$widget_fields = $this->widget_fields();
			foreach( $widget_fields as $widget_field ) {
				// Make array elements available as variables
				extract( $widget_field );
				// Check if field has value and skip title field
				unset( $athemes_widgets_field_value );
				if( isset( $instance[$athemes_widgets_name] ) && 'widget_title' != $athemes_widgets_name ) { 
					$athemes_widgets_field_value = esc_attr( $instance[$athemes_widgets_name] ); 
					if( '' != $athemes_widgets_field_value ) {	?>
					<li class="widget-si-<?php echo $athemes_widgets_name; ?>"><a href="<?php echo $athemes_widgets_field_value; ?>" title="<?php echo $athemes_widgets_title; ?>"><i class="ico-<?php echo $athemes_widgets_name; ?>"></i></a></li>
					<?php }
				}
			}
		echo '<!-- .widget-social-icons --></ul>';
		
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