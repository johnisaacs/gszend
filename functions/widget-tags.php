<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom category and tag widget
	Description: This widget creates stylish custom tags or category links
	Author: Jdsans
	Version: 1
	Author URI: http://jdsans.net/

-----------------------------------------------------------------------------------*/

// Initiate widget
add_action( 'widgets_init', 'cat_widget' );

// Register widget in theme
function cat_widget() {
	register_widget( 'Cat_widget' );
}

// Widget class
class Cat_widget extends WP_Widget 
{

	public function __construct() {
        $widget_ops = array( 
            'classname' => 'Cat_widget', 
            'description' => __('This widget creates stylish custom tags or category links', 'jd_framework') 
        );

        parent::__construct( 'Cat_widget', __('Custom Category Widget','jd_framework'), $widget_ops );
	}

	
	// outputs the content of the widget  
    function widget( $args, $instance ) 
    {
        extract( $args );

		// Our variables from the widget settings
		$title = apply_filters('widget_title', $instance['title'] );
		$taxonomy = $instance['taxonomy'];
		$ID = $instance['slider_id'];
		if($taxonomy == 'Categories'){ 
			$tax = 'category';
		}
		else if($taxonomy == 'Tags'){ 
			$tax = 'post_tag';
		}
		else if($taxonomy == 'Skill Types'){ 
			$tax = 'skill-type';
		}

		// Before widget (defined by theme functions file)
		echo $before_widget;
	
		// Display the widget title if one was input
		if ( $title )
			echo $before_title . $title . $after_title;
	
		// Display tags widget
		?>
		
		<ul class="tag_list">
			<?php
				$arr = wp_tag_cloud(array(
					'number'	=> 20,                 
					'format'	=> 'array', 
					'separator'	=> '',        
					'orderby'	=> 'name',
					'order'	=> 'ASC',
					'exclude' => $ID,
					'link'	=> 'view',
					'taxonomy'	=> $tax,
					'echo'	=> true 
				));
	
				foreach ($arr as $value) {
					echo '<li>' . $value . '</li> ';
				}
			?>   
		</ul>
		<div class="clear"></div>
		
		<?php
	
		// After widget (defined by theme functions file)
		echo $after_widget;
    }


	// processes widget options to be saved
    function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;

		// Strip tags to remove HTML (important for text inputs)
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['taxonomy'] = $new_instance['taxonomy'];
		$instance['slider_id'] = $new_instance['slider_id'];
	
		return $instance;     
    }

	// outputs the options form on admin
    function form( $instance ) 
    {       
        
		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Categories',
		'taxonomy' => 'Tags',
		'slider_id' => ''
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'jd_framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	
		<!-- Embed Code: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>"><?php _e('Taxonomy:', 'jd_framework') ?></label>
			<select id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy' ); ?>" class="widefat">        
				
				<?php 
					$taxonomies=get_taxonomies(); 
			
					foreach ($taxonomies as $taxonomy ) {
						
						if($taxonomy == 'category'){ 
							$name = 'Categories';
							$show = 'true';
							if($name == $instance['taxonomy']){					
								$selected = 'true';
							}
							else{
								$selected = 'false';	
							}
						}
						else if($taxonomy == 'post_tag'){
							$name = 'Tags';
							$show = 'true';
							if($name == $instance['taxonomy']){					
								$selected = 'true';
							}
							else{
								$selected = 'false';	
							}
						}
						else if($taxonomy == 'skill-type'){
							$name = 'Skill Types';
							$show = 'true';
							if($name == $instance['taxonomy']){					
								$selected = 'true';
							}
							else{
								$selected = 'false';	
							}
						}
						else if($taxonomy == 'nav_menu'){
							$show = 'false';
						}
						else if($taxonomy == 'link_category'){
							$show = 'false';
						}
						else if($taxonomy == 'post_format'){
							$show = 'false';
						}
						
						$a = ' selected="selected" >';
						$b = '>';
							
						if($show == 'true'){
							echo '<option'.(($selected == 'true') ? $a : $b).$name.'</option>';
						}
					}
	
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'slider_id' ); ?>"><?php _e('Exclude tags from cloud', 'jd_framework')?> (<a href="http://bacsoftwareconsulting.com/blog/index.php/wordpress-cat/how-to-find-tag-page-post-link-category-id-in-wordpress/">Find ID</a>)</label>
			<input placeholder="Enter comma seperated Id's of tags" class="widefat" id="<?php echo $this->get_field_id( 'slider_id' ); ?>" name="<?php echo $this->get_field_name( 'slider_id' ); ?>" value="<?php echo $instance['slider_id']; ?>" />
		</p>
		
        
    <?php
    }
}

?>