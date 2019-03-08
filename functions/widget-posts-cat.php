<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom post widget with category selection
	Description: A posts widget to multiple category posts with thumbnails from selected categories
	Author: Jdsans
	Version: 1
	Author URI: http://jdsans.net/

-----------------------------------------------------------------------------------*/

// Initiate widget
add_action( 'widgets_init', 'thumb_posts_cat' );

// Register widget in theme
function thumb_posts_cat() {
	register_widget( 'cat_posts_Thumb' );
}

// Widget class
class cat_posts_Thumb extends WP_Widget 
{

	// Register widget with WordPress.
	public function __construct() {
        $widget_ops = array( 
            'classname' => 'cat_posts_Thumb', 
            'description' => __('Custom posts widget to show multiple category posts with thumbnails', 'jd_framework') 
        );

        parent::__construct( 'cat_posts_Thumb', __('Multiple Category posts Widget','jd_framework'), $widget_ops );
    }
	
	// outputs the content of the widget  
    function widget( $args, $instance ) 
    {
        extract( $args );

        /* User-selected settings. */
        $title = apply_filters('widget_title', $instance['title'] );
		$category = $instance['category'];
		
		$category = strtolower($category); // Changes all characters to lowercase
		$category = preg_replace('/\s+/', '', $category); // Remove whitespaces
		$category = rtrim($category, ",");
		$category = explode(",",$category); //changes comma seprated categories into array
		
		$category_id = array();
		$i=0;
		
		foreach($category as $cat){
			$category_id[$i] = get_cat_ID($cat);
			$i++;
		}
		
        $items = $instance['items'];
        $show_thumb = $instance['show_thumb'];
		$show_meta = $instance['show_meta'];
		
        echo $before_widget;
		       
        if ($title) echo $before_title . $title . $after_title;

		$query = new WP_Query(array ('posts_per_page' => $items,'category__in' => $category_id));

		if ($query->have_posts()) :
	?>

    <ul class="post-thumb widget_posts clearfix">
		<?php while ($query->have_posts()) : $query->the_post();  ?>
					
            <li class="item">
                
                <?php if($show_thumb == 'yes'): ?>
                    <div class="thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail() ?></a></div>
                <?php endif; ?>
                
                <div class="details <?php if($show_thumb == 'no') echo 'no_thumb' ?>">
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    
                    <?php if($show_meta == 'yes'): ?>
                    <div class="post-meta">
                        <span class="date"><?php the_time( get_option('date_format') ); ?> </span>
                        <span><?php _e('by','jd_framework'); ?></span>
                        <span class="author"><?php the_author_posts_link(); ?> </span>
                                                             
                    </div><!--post-meta-->
                    <?php endif; ?>
                
                </div>
                
                <div class="clear"></div>
                
            </li>
		 
		<?php endwhile; ?>
	</ul>
    
    <?php
		endif; 
		wp_reset_query(); 
        echo $after_widget;
    }

	// processes widget options to be saved
    function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title']);
		$instance['category'] = $new_instance['category'];
        $instance['show_thumb'] = $new_instance['show_thumb'];
		$instance['show_meta'] = $new_instance['show_meta'];                 
        $instance['items'] = $new_instance['items']; 
        return $instance;
    }

	// outputs the options form on admin
    function form( $instance ) 
    {       
        
        $defaults = array( 
            'title' => 'Latest Posts', 
            'items' => '5',     
            'show_thumb' => 'yes',
			'show_meta' => 'yes',
			'category'=> 1,      
        );
		
		wp_enqueue_script('jquery-ui-autocomplete');

		$categories = array();  
		$categories_obj = get_categories('hide_empty=0');
		foreach ($categories_obj as $cat) {
			$categories[$cat->cat_ID] = $cat->cat_name;}

        $instance = wp_parse_args( (array) $instance, $defaults );; ?>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'jd_framework'  ) ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"/>
        </p>

        <p>
			<span class="ui-widget">
            	<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e( 'Enter category names seperated by comma', 'jd_framework' ) ?>:</label>
            	<input id="<?php echo $this->get_field_id('category'); ?>" type="text" class="widefat" name="<?php echo $this->get_field_name( 'category' ); ?>" value="<?php echo $instance['category']; ?>" />
            </span>

			<script type="text/javascript">
                jQuery(document).ready(function($) {
                    $(function() {
                    var availableTags = [<?php foreach($categories as $category){ echo '"'.$category.'",'; } ?>];
                    function split( val ) {
                        return val.split( /,\s*/ );
                    }
                    function extractLast( term ) {
                        return split( term ).pop();
                    }
                    $( "#<?php echo $this->get_field_id('category'); ?>" ).bind( "keydown", function( event ) {
                        if ( event.keyCode === $.ui.keyCode.TAB &&
                            $( this ).data( "ui-autocomplete" ).menu.active ) {
                                event.preventDefault();
                            }
                        }).autocomplete({
                            minLength: 0,
                            source: function( request, response ) {
                                response( $.ui.autocomplete.filter(
                                availableTags, extractLast( request.term ) ) );
                            },
                            focus: function() {
                                return false;
                            },
                            select: function( event, ui ) {
                                var terms = split( this.value );
                                terms.pop();
                                terms.push( ui.item.value );
                                terms.push( "" );
                                this.value = terms.join( "," );
                                return false;
                            }
                        });
                    });
                }); //End of jquery ready
            </script>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('items'); ?>"><?php _e( 'Posts to display:', 'jd_framework' ) ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" value="<?php echo $instance['items']; ?>" size="4" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e( 'Show thumbnail', 'jd_framework' ) ?>:</label>
           <select id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>">
              <option value="yes" <?php selected( $instance['show_thumb'], 'yes') ?>><?php _e( 'Yes', 'jd_framework' ) ?></option>
              <option value="no" <?php selected( $instance['show_thumb'], 'no' ) ?>><?php _e( 'No', 'jd_framework'  ) ?></option>
           </select>
        </p>
    
        <p>
            <label for="<?php echo $this->get_field_id( 'show_meta' ); ?>"><?php _e( 'Show date and author', 'jd_framework' ) ?>:</label>
           <select id="<?php echo $this->get_field_id( 'show_meta' ); ?>" name="<?php echo $this->get_field_name( 'show_meta' ); ?>">
              <option value="yes" <?php selected( $instance['show_meta'], 'yes') ?>><?php _e( 'Yes', 'jd_framework' ) ?></option>
              <option value="no" <?php selected( $instance['show_meta'], 'no' ) ?>><?php _e( 'No', 'jd_framework'  ) ?></option>
           </select>
        </p> 

    <?php
    }
}

?>