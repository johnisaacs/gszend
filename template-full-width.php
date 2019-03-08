<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>
			          
			<!--BEGIN #main_container-->
			<div id="main_container" class="container fullwidth">
            
            	<div class="inner_content row">
                
                    <div id="page-top">
                            <h2 id="page-title">
                                <?php 
                                global $post;
                                global $post;
                                if(get_post_meta($post->ID, 'heading_value', true) != ''): 
                                    echo get_post_meta($post->ID, 'heading_value', true); 
                                else: 
                                    the_title();
                                endif; 
                                ?>
                            </h2>
                     </div> <!--#page_top-->
                  		
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        
                        <!--BEGIN .hentry -->
                        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">	
        
            
                                <!--BEGIN .entry-content -->
                                <div class="entry-content clearfix">
                                
                                    <?php the_content(); ?>
                                    
                                
                                </div><!--END .entry-content -->
         
                                <div class="clear"></div>
                         
                        </div> <!--END .hentry-->
        
                        <?php endwhile; ?>
                        
        
                        <?php else : ?>
            
                            <!--BEGIN #post-0-->
                            <div id="post-0" <?php post_class(); ?>>
                            
                                <h2 class="entry-title"><?php _e('Error 404 - Not Found', 'jd_framework') ?></h2>
                            
                                <p class="error_msg"><?php _e("Sorry, but you are looking for something that isn't here. Try another search", "framework") ?></p>
                            
                            <!--END #post-0-->
                            </div>
            
                        <?php endif; ?>

                
				</div> <!--.inner_content-->
                
                
			</div><!--END .container-->


<?php get_footer(); ?>