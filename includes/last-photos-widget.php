<?php
/**
 * Last Photos Widget
 *
 * Displays last photos widget
 *
 * @author WpWolf
 * @category Widgets
 * @package WolfAlbums/Widgets
 * @version 1.0.0
 * @extends WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WA_Widget_Last_Photos extends WP_Widget {

	/**
	 * constructor
	 *
	 */
	function WA_Widget_Last_Photos() {

		// Widget settings
		$ops = array( 'classname' => 'widget_last_photos', 'description' => __( 'Display your last photos', 'wolf' ) );

		// Create the widget
		$this->WP_Widget( 'widget_last_photos', __( 'Last Photos', 'wolf' ), $ops );
		
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {
		global $wolf_albums;
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$desc = $instance['desc'];
		$count = isset( $instance['count'] ) ? $instance['count'] : 12;
		echo $before_widget;
		if (! empty( $title ) ) echo $before_title . $title . $after_title;
		if (! empty( $desc ) ) {
			echo '<p>';
			echo $desc;
			echo '</p>';
		}
		echo $wolf_albums->widget( $count );
		echo $after_widget;
	
	}

	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['desc'] = $new_instance['desc'];
		$instance['count'] = $new_instance['count'];
		return $instance;
	}

	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @param array $instance
	 */
	function form( $instance ) {

		// Set up some default widget settings
		$defaults = array(
			'title' => __( 'Last Photos', 'wolf' ), 
			'desc' => '',
			'count' => 12, 
			);
		$instance = wp_parse_args( ( array ) $instance, $defaults);
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e(  'Title' , 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Optional Text', 'wolf' ); ?>:</label>
			<textarea class="widefat"  id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" ><?php echo $instance['desc']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Count', 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>">
		</p>
		<?php
	}

}