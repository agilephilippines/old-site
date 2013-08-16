<?php
/**
 * File that holds helper functions that display widget fields in the dashboard
 *
 * @package aThemes Widget Pack
 * @version 1.0
 */

/**
 * Widget form fields helper function
 * 
 *
 * @param	object	$instance		Widget instance
 * @param	array	$widget_field	Widget field array
 * @param	string	$field_value	Field value
 *
 * @since	aThemes Widget Pack 1.0
 */
function athemes_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {
	
	extract( $widget_field );
	
	switch( $athemes_widgets_field_type ) {
	
		// Standard text field
		case 'text' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $athemes_widgets_name ); ?>"><?php echo $athemes_widgets_title; ?>:</label>
				<input class="widefat" id="<?php echo $instance->get_field_id( $athemes_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $athemes_widgets_name ); ?>" type="text" value="<?php echo $athm_field_value; ?>" />
				
				<?php if( isset( $athemes_widgets_description ) ) { ?>
				<br />
				<small><?php echo $athemes_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Textarea field
		case 'textarea' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $athemes_widgets_name ); ?>"><?php echo $athemes_widgets_title; ?>:</label>
				<textarea class="widefat" rows="6" id="<?php echo $instance->get_field_id( $athemes_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $athemes_widgets_name ); ?>"><?php echo $athm_field_value; ?></textarea>
			</p>
			<?php
			break;
			
		// Checkbox field
		case 'checkbox' : ?>
			<p>
				<input id="<?php echo $instance->get_field_id( $athemes_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $athemes_widgets_name ); ?>" type="checkbox" value="1" <?php checked( '1', $athm_field_value ); ?>/>
				<label for="<?php echo $instance->get_field_id( $athemes_widgets_name ); ?>"><?php echo $athemes_widgets_title; ?></label>

				<?php if( isset( $athemes_widgets_description ) ) { ?>
				<br />
				<small><?php echo $athemes_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		// Radio fields
		case 'radio' : ?>
			<p>
				<?php
				echo $athemes_widgets_title; 
				echo '<br />';
				foreach( $athemes_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
					<input id="<?php echo $instance->get_field_id( $athm_option_name ); ?>" name="<?php echo $instance->get_field_name( $athemes_widgets_name ); ?>" type="radio" value="<?php echo $athm_option_name; ?>" <?php checked( $athm_option_name, $athm_field_value ); ?> />
					<label for="<?php echo $instance->get_field_id( $athm_option_name ); ?>"><?php echo $athm_option_title; ?></label>
					<br />
				<?php } ?>
				
				<?php if( isset( $athemes_widgets_description ) ) { ?>
				<small><?php echo $athemes_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		// Select field
		case 'select' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $athemes_widgets_name ); ?>"><?php echo $athemes_widgets_title; ?>:</label>
				<select name="<?php echo $instance->get_field_name( $athemes_widgets_name ); ?>" id="<?php echo $instance->get_field_id( $athemes_widgets_name ); ?>" class="widefat">
					<?php
					foreach ( $athemes_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
						<option value="<?php echo $athm_option_name; ?>" id="<?php echo $instance->get_field_id( $athm_option_name ); ?>" <?php selected( $athm_option_name, $athm_field_value ); ?>><?php echo $athm_option_title; ?></option>
					<?php } ?>
				</select>

				<?php if( isset( $athemes_widgets_description ) ) { ?>
				<br />
				<small><?php echo $athemes_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		case 'number' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $athemes_widgets_name ); ?>"><?php echo $athemes_widgets_title; ?>:</label><br />
				<input name="<?php echo $instance->get_field_name( $athemes_widgets_name ); ?>" type="number" step="1" min="1" id="<?php echo $instance->get_field_id( $athemes_widgets_name ); ?>" value="<?php echo $athm_field_value; ?>" class="small-text" />
				
				<?php if( isset( $athemes_widgets_description ) ) { ?>
				<br />
				<small><?php echo $athemes_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
		
	}
	
}