<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom video widget
	Description: Widget embeds videos from video services like vimeo, youtube etc
	Author: Jdsans
	Version: 1
	Author URI: http://jdsans.net/

-----------------------------------------------------------------------------------*/

// Initiate widget
add_action( 'widgets_init', 'video_widget' );

// Register widget in theme
function video_widget() {
	register_widget( 'Video_widget' );
}

// Widget class
class Video_widget extends WP_Widget 
{

	public function __construct() {
        $widget_ops = array( 
            'classname' => 'Video_widget', 
            'description' => __('Widget embeds videos from video services like vimeo, youtube etc', 'jd_framework') 
        );

        parent::__construct( 'Video_widget', __('Custom Video Widget','jd_framework'), $widget_ops );
	}

	
	// outputs the content of the widget  
    function widget( $args, $instance ) 
    {
        extract( $args );

		// Our variables from the widget settings
		$title = apply_filters('widget_title', $instance['title'] );
		$embed = $instance['embed'];

		echo $before_widget;
	
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
        
		<div class="video-container">
			<?php echo $embed ?>
		</div>
		
		<?php
	
		echo $after_widget;
    }


	// processes widget options to be saved
    function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );
		$instance['embed'] = stripslashes( $new_instance['embed']);
	
		return $instance;     
    }

	// outputs the options form on admin
    function form( $instance ) 
    {       
        
		$defaults = array(
			'title' => 'My Video Reel',
			'embed' => stripslashes( '<iframe src="http://player.vimeo.com/video/33822223?title=0&amp;byline=0&amp;portrait=0&amp;color=ffeb0f" width="218" height="122" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'),
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'jd_framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'embed' ); ?>"><?php _e('Embed Code:', 'jd_framework') ?></label>
			<textarea style="height:200px;" class="widefat" id="<?php echo $this->get_field_id( 'embed' ); ?>" name="<?php echo $this->get_field_name( 'embed' ); ?>"><?php echo stripslashes(htmlspecialchars(( $instance['embed'] ), ENT_QUOTES)); ?></textarea>
		</p>
		
        
    <?php
    }
}

?>