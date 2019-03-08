<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom 125x125 ad widget
	Description: This widget creates four 125x125 sponsor ad
	Author: Jdsans
	Version: 1
	Author URI: http://jdsans.net/

-----------------------------------------------------------------------------------*/

// Initiate widget
add_action( 'widgets_init', 'square_ad' );

// Register widget in theme
function square_ad() {
	register_widget( 'square_ad_widget' );
}

// Widget class
class square_ad_widget extends WP_Widget 
{

	public function __construct() {
        $widget_ops = array( 
            'classname' => 'square_ad_widget', 
            'description' => __('This widget allows to display and configur four 125x125 ads blocks in your sidebar', 'jd_framework') 
        );

        parent::__construct( 'square_ad_widget', __('Custom 125x125 Ads','jd_framework'), $widget_ops );
	}

	
	// outputs the content of the widget  
    function widget( $args, $instance ) 
    {
        extract( $args );

        /* User-selected settings. */
        $title = apply_filters('widget_title', $instance['title'] );
		$ad1 = $instance['ad1'];
		$ad2 = $instance['ad2'];
		$ad3 = $instance['ad3'];
		$ad4 = $instance['ad4'];

		$link1 = $instance['link1'];
		$link2 = $instance['link2'];
		$link3 = $instance['link3'];
		$link4 = $instance['link4'];

        echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Array to store links and images       
		$ads = array();
                              
		//Start of widget container
		echo '<ul class="ad_spots clearfix">';

		// Spot one
		if ($link1 != '')
			$ads[] = '<li><a target="_blank" href="' . $link1 . '"><img src="' . $ad1 . '" width="125" height="125" alt="" /></a></li>';
			
		elseif ($ad1 != '')
		 	$ads[] = '<li><img src="' . $ad1 . '" width="125" height="125" alt="" /></li>';
		
		// Spot two
		if ($link2  != '')
			$ads[] = '<li><a target="_blank" href="' . $link2 . '"><img src="' . $ad2 . '" width="125" height="125" alt="" /></a></li>';
			
		elseif ($ad2  != '')
		 	$ads[] = '<li><img src="' . $ad2 . '" width="125" height="125" alt="" /></li>';
			
		// Spot three
		if ($link3  != '')
			$ads[] = '<li><a target="_blank" href="' . $link3 . '"><img src="' . $ad3 . '" width="125" height="125" alt="" /></a></li>';
			
		elseif ($ad3 != '')
		 	echo '<li><img src="' . $ad3 . '" width="125" height="125" alt="" /></li>';
			
		// Spot four
		if ($link4 != '')
			$ads[] = '<li><a target="_blank" href="' . $link4 . '"><img src="' . $ad4 . '" width="125" height="125" alt="" /></a></li>';
			
		elseif ($ad4  != '')
		 	$ads[] = '<li><img src="' . $ad4 . '" width="125" height="125" alt="" /></li>';
					
		//Loop throught the array to create ad blocks
		foreach($ads as $ad){
			echo $ad;
		}
		
		//End of widget container
		echo '</ul>';
		echo '<div class="clear"></div>';
    
				
        echo $after_widget;
    }


	// processes widget options to be saved
    function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;

		/* No need to strip tags */
        $instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ad1'] = $new_instance['ad1'];
		$instance['ad2'] = $new_instance['ad2'];
		$instance['ad3'] = $new_instance['ad3'];
		$instance['ad4'] = $new_instance['ad4'];

		$instance['link1'] = $new_instance['link1'];
		$instance['link2'] = $new_instance['link2'];
		$instance['link3'] = $new_instance['link3'];
		$instance['link4'] = $new_instance['link4'];         

        return $instance;
    }

	// outputs the options form on admin
    function form( $instance ) 
    {       
        
		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Our Sponsors',
		'ad1' => get_template_directory_uri()."/images/banner_125x125.gif",
		'link1' => 'http://themeforest.net/user/jdsans/portfolio?ref=jdsans',
		'ad2' => get_template_directory_uri()."/images/gr_125x125.gif",
		'link2' => 'http://themeforest.net/user/jdsans/portfolio?ref=jdsans',
		'ad3' => get_template_directory_uri()."/images/th_125x125.gif",
		'link3' => 'http://themeforest.net/user/jdsans/portfolio?ref=jdsans',
		'ad4' => get_template_directory_uri()."/images/tu_125x125.gif",
		'link4' => 'http://themeforest.net/user/jdsans/portfolio?ref=jdsans',
		);
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'jd_framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Spot 1 image url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'ad1' ); ?>"><?php _e('Ad 1 image url:', 'jd_framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad1' ); ?>" name="<?php echo $this->get_field_name( 'ad1' ); ?>" value="<?php echo $instance['ad1']; ?>" />
		</p>
		
		<!-- Spot 1 link url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e('Ad 1 link url:', 'jd_framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link1' ); ?>" name="<?php echo $this->get_field_name( 'link1' ); ?>" value="<?php echo $instance['link1']; ?>" />
		</p>
		
		<!-- Spot 2 image url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'ad2' ); ?>"><?php _e('Ad 2 image url:', 'jd_framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad2' ); ?>" name="<?php echo $this->get_field_name( 'ad2' ); ?>" value="<?php echo $instance['ad2']; ?>" />
		</p>
		
		<!-- Spot 2 link url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link2' ); ?>"><?php _e('Ad 2 link url:', 'jd_framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link2' ); ?>" name="<?php echo $this->get_field_name( 'link2' ); ?>" value="<?php echo $instance['link2']; ?>" />
		</p>
		
		<!--Spot 3 image url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'ad3' ); ?>"><?php _e('Ad 3 image url:', 'jd_framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad3' ); ?>" name="<?php echo $this->get_field_name( 'ad3' ); ?>" value="<?php echo $instance['ad3']; ?>" />
		</p>
		
		<!-- Spot 3 link url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link3' ); ?>"><?php _e('Ad 3 link url:', 'jd_framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link3' ); ?>" name="<?php echo $this->get_field_name( 'link3' ); ?>" value="<?php echo $instance['link3']; ?>" />
		</p>
		
		<!-- Spot 4 image url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'ad4' ); ?>"><?php _e('Ad 4 image url:', 'jd_framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad4' ); ?>" name="<?php echo $this->get_field_name( 'ad4' ); ?>" value="<?php echo $instance['ad4']; ?>" />
		</p>
		
		<!-- Spot 4 link url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link4' ); ?>"><?php _e('Ad 4 link url:', 'jd_framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link4' ); ?>" name="<?php echo $this->get_field_name( 'link4' ); ?>" value="<?php echo $instance['link4']; ?>" />
		</p>
		
        
    <?php
    }
}

?>