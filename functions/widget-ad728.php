<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: BYMe 728x90 Ad Widget
	Description: A widget for 728 x 90 ad (Single banner)
	Version: 1.0

-----------------------------------------------------------------------------------*/


// Load widget.
add_action( 'widgets_init', 'mts_ad_728_widgets' );

// Register widget.
function mts_ad_728_widgets() {
	register_widget( 'mts_ad_728_Widget' );
}

// Widget class.
if( ! class_exists( 'mts_ad_728_widget' ) ){
	class mts_ad_728_widget extends WP_Widget {


	/**
	 * Widget setup
	 */
	function __construct() {

		// Widget settings
		$widget_ops = array(
			'classname' => 'mts_ad_728_widget',
			'description' => __('A widget for 728 x 90 ad (Single banner)', 'crypto' )
		);

		// Widget control settings
		$control_ops = array(
			'width' => 728,
			'height' => 90,
			'id_base' => 'mts_ad_728_widget'
		);

		// Create the widget
		parent::__construct( 'mts_ad_728_widget', sprintf( __('%s728x90 Ad', 'crypto' ), MTS_THEME_WHITE_LABEL ? '' : 'MTS ' ), $widget_ops, $control_ops );
		
	}

	/**
	 * Display widget.
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Variables from the widget settings
		$title = apply_filters('widget_title', $instance['title'] );
		$ad = $instance['ad'];
		$link = $instance['link'];

		// Before widget (defined by theme functions file)
		echo $before_widget;

		// Display the widget title if one was input
		if ( $title )
			echo $before_title . $title . $after_title;
			
		// Display a containing div
		echo '<div class="ad-728">';

		// Display Ad
		if ( $link )
			echo '<a href="' . esc_url( $link ) . '"><img src="' . esc_url( $ad ) . '" width="728" height="90" alt="" /></a>';
			
		elseif ( $ad )
		 	echo '<img src="' . esc_url( $ad ) . '" width="728" height="90" alt="" />';
			
		echo '</div>';

		// After widget (defined by theme functions file)
		echo $after_widget;
	}


	/**
	 * Update widget.
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Strip tags to remove HTML (important for text inputs)
		$instance['title'] = strip_tags( $new_instance['title'] );

		// No need to strip tags
		$instance['ad'] = $new_instance['ad'];
		$instance['link'] = $new_instance['link'];

		return $instance;
	}

	/**
	 * Widget Settings (Displays the widget settings controls on the widget panel)
	 *
	 * @param array $instance
	 *
	 * @return string|void
	 */
	function form( $instance ) {

		// Set up some default widget settings
		$defaults = array(
			'title' => '',
			'ad' => get_template_directory_uri()."/images/728x90.png",
			'link' => MTS_THEME_WHITE_LABEL ? '' : 'http://BYMe.com/',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'crypto' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<!-- Ad image url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'ad' ); ?>"><?php _e('Ad image url:', 'crypto' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'ad' ); ?>" name="<?php echo $this->get_field_name( 'ad' ); ?>" value="<?php echo esc_url( $instance['ad'] ); ?>" />
		</p>
		
		<!-- Ad link url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Ad link url:', 'crypto' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo esc_url( $instance['link'] ); ?>" />
		</p>
		
		<?php
		}
	}
}
?>