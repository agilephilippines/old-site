<?php
/**
 * Adds custom widgets
 *
 * @package aThemes Widget Pack
 * @version 1.0
 */

/**
 * Helper function that updates fields in the dashboard form
 *
 * @since aThemes Widget Pack 1.0
 */
function athemes_widgets_updated_field_value( $widget_field, $new_field_value ) {

	extract( $widget_field );
	
	// Allow only integers in number fields
	if( $athemes_widgets_field_type == 'number' ) {
		return absint( $new_field_value );
		
	// Allow some tags in textareas
	} elseif( $athemes_widgets_field_type == 'textarea' ) {
		// Check if field array specifed allowed tags
		if( !isset( $athemes_widgets_allowed_tags ) ) {
			// If not, fallback to default tags
			$athemes_widgets_allowed_tags = '<p><strong><em><a>';
		}
		return strip_tags( $new_field_value, $athemes_widgets_allowed_tags );
		
	// No allowed tags for all other fields
	} else {
		return strip_tags( $new_field_value );
	}

}

/**
 * Include helper functions that display widget fields in the dashboard
 *
 * @since aThemes Widget Pack 1.0
 */
require ATHEMES_PATH . '/inc/widgets/widget-fields.php';

/**
 * Register Post Preview Widget
 *
 * @since athemes Widget Pack 1.0
 */
require ATHEMES_PATH . '/inc/widgets/widget-preview-post.php';

/**
 * Register Social Icons Widget
 *
 * @since athemes Widget Pack 1.0
 */
require ATHEMES_PATH . '/inc/widgets/widget-social-icons.php';

/**
 * Media Embed Widget
 *
 * @since athemes Widget Pack 1.0
 */
require ATHEMES_PATH . '/inc/widgets/widget-media-embed.php';

/**
 * Flickr Stream Widget
 *
 * @since athemes Widget Pack 1.0
 */
require ATHEMES_PATH . '/inc/widgets/widget-flickr-stream.php';

/**
 * Tabber Widget
 *
 * @since athemes Widget Pack 1.0
 */
require ATHEMES_PATH . '/inc/widgets/widget-tabs.php';