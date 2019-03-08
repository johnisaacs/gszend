<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom Flickr Widget
	Description: This widget will show your flickr photostream
	Author: Jdsans
	Version: 1
	Author URI: http://jdsans.net/

-----------------------------------------------------------------------------------*/
 

// Initiate widget
add_action( 'widgets_init', 'flickr_widget' );

// Register widget in theme
function flickr_widget() {
	register_widget( 'Flickr_widget' );
}

// Widget class
class Flickr_widget extends WP_Widget 
{

	// Register widget with WordPress.
	public function __construct() {
        $widget_ops = array( 
            'classname' => 'Flickr_widget', 
            'description' => __('Show up your flickr photostream', 'jd_framework') 
        );

        parent::__construct( 'Flickr_widget', __('Flickr Photostream','jd_framework'), $widget_ops );
    }
	
	// outputs the content of the widget  
    function widget( $args, $instance ) 
    {
        extract( $args );

        /* User-selected settings. */
        $title = apply_filters('widget_title', $instance['title'] );
		$flickrID = $instance['flickrID'];
		$postcount = $instance['postcount'];
		$display = $instance['display'];

        echo $before_widget;
		       
        if ($title) echo $before_title . $title . $after_title;
	?>
                              
	<div id="flickr_badge_wrapper" class="clearfix">
	
		<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $postcount ?>&amp;display=<?php echo $display ?>&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickrID ?>"></script>
		<a href="<?php echo 'http://www.flickr.com/photos/'.$flickrID ?>" class="flickr_link">Some more shots</a>
	</div>
    
    <?php			
        echo $after_widget;
    }


	// processes widget options to be saved
    function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;
	
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
		$instance['postcount'] = $new_instance['postcount'];
		$instance['display'] = $new_instance['display'];
	
		return $instance;
    }

	// outputs the options form on admin
    function form( $instance ) 
    {       
        
	$defaults = array(
		'title' => 'My Flickr feed',
		'flickrID' => '40153444@N07',
		'postcount' => '9',
		'display' => 'latest',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'jd_framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'flickrID' ); ?>"><?php _e('Your Flickr ID:', 'jd_framework') ?> (<a href="http://idgettr.com/">idGettr</a>)</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $instance['flickrID']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of Photos(Max 10):', 'jd_framework') ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('Display images(randomly or latest):', 'jd_framework') ?></label>
		<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" class="widefat">
			<option <?php if ( 'random' == $instance['display'] ) echo 'selected="selected"'; ?>>random</option>
			<option <?php if ( 'latest' == $instance['display'] ) echo 'selected="selected"'; ?>>latest</option>
		</select>
	</p>
    
    <?php
    }
}

?>