<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom Twitter widget
	Description: Widget embeds tweets from your twitter timeline on your blog
	Author: Jdsans
	Version: 1
	Author URI: http://jdsans.net/

-----------------------------------------------------------------------------------*/

// Initiate widget
add_action( 'widgets_init', 'twitter_widget' );

// Register widget in theme
function twitter_widget() {
	register_widget( 'Twitter_widget' );
}

// Widget class
class Twitter_widget extends WP_Widget 
{
	public function __construct() {
        $widget_ops = array( 
            'classname' => 'Twitter_widget', 
            'description' => __('Widget embeds tweets from your twitter timeline on your blog', 'jd_framework') 
        );

        parent::__construct( 'Twitter_widget', __('Custom Twitter Widget','jd_framework'), $widget_ops );
	}

	// outputs the content of the widget  
    function widget( $args, $instance ) 
    {
        extract( $args );
		
		echo $before_widget;

        /* User-selected settings. */
        $title = apply_filters('widget_title', $instance['title'] );
		$user = $instance['user'];
		$count = $instance['count'];
		$follow = $instance['follow'];

		if ( $instance['title'] )
			echo $before_title . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $after_title;		
	?>
    
    <?php if($user != ''): ?>
        <div id="tweets_cont" class="clearfix">
            <ul id="tweets" class="clearfix">
            </ul>
            
            <?php if($follow != ''): ?>
            <div class="follow_text clearfix">
                <a href="http://twitter.com/<?php echo $user; ?>" target="_blank" title="<?php echo $follow; ?>"> <?php echo $follow; ?></a>
            </div>
            <?php endif;?>
        </div>
            
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/twitter.js"></script>
        <script type="text/javascript">
          jQuery(document).ready(function($){
              $.getJSON('http://api.twitter.com/1/statuses/user_timeline/<?php echo $user; ?>.json?count=<?php echo $count; ?>&callback=?',  function(data){
                  $.each(data, function(index, item){
                      $('#tweets').append('<li>' + item.text.linkify() + '<span>' + relative_time(item.created_at) + '</span></li>');
                  });
              });
          });
        </script>   
    <?php endif;?>

	<?php
		echo $after_widget;
    }

	// processes widget options to be saved
    function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );
		$instance['user'] = stripslashes( $new_instance['user']);
		$instance['count'] = stripslashes( $new_instance['count']);
		$instance['follow'] = stripslashes( $new_instance['follow']);
		
		return $instance;     
    }

	// outputs the options form on admin
    function form( $instance ) 
    {       
		$defaults = array(
			'title' => __('My latest tweets', 'jd_framework'),
			'user' => 'bloggerzbible',
			'count' => '4', 
			'follow' => 'Follow me'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:',  'jd_framework'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
            <label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('Twitter Username:', 'jd_framework'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('user'); ?>" value="<?php echo esc_attr( $instance['user'] ); ?>" class="widefat" id="<?php echo $this->get_field_id('user'); ?>" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Tweets to show:', 'jd_framework'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo esc_attr( $instance['count'] ); ?>" class="widefat" id="<?php echo $this->get_field_id('count'); ?>" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id('follow'); ?>"><?php _e('Follow me text:', 'jd_framework'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('follow'); ?>" value="<?php echo esc_attr( $instance['follow'] ); ?>" class="widefat" id="<?php echo $this->get_field_id('follow'); ?>" />
        </p>
		
    <?php
    }
}

?>