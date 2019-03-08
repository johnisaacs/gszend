<?php 

global $data; 

?>
<?php get_header(); ?>
           
            <div id="main_container" class="container">
            
                <!--BEGIN .post-content-->
                <div class="inner_content row">

                    <!--BEGIN .post-content-->
                    <div class="post-content clearfix column">
            		
                        <div id="page-top">
                                <h2 id="page-title"><?php the_title(); ?></h2>
                         </div> <!--#page_top-->
                    
                                		
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        
                        <!--BEGIN .hentry -->
                        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">	
            
                            <!--BEGIN .entry-content -->
                            <div class="entry-content">
                            
                                <?php the_content(); ?>
                                
                            <!--END .entry-content -->
                            </div>
                                
        
                        <!--END .hentry-->  
                        </div>
                        
                        <div class="clear"></div>
                        
                        <?php if($data['comment_pages']): ?>
							<?php comments_template('', true); ?>
                        <?php endif; ?>
        
                        <?php endwhile; ?>
                           
                        <?php else : ?>
            
                            <!--BEGIN #post-0-->
                            <div id="post-0" <?php post_class(); ?>>
                            
                                <h2 class="entry-title"><?php _e('Error 404 - Not Found', 'jd_framework') ?></h2>
                            
                                <p class="error_msg"><?php _e("Sorry, but you are looking for something that isn't here. Try another search", "framework") ?></p>
                            
                            <!--END #post-0-->
                            </div>
                            
            
                        <?php endif; ?>
                
                
                </div><!--END .post-content-->
                

				<?php get_sidebar(); ?>
                
                <div class="clear"></div>
					
                </div><!--END .inner-content-->
            
               
            </div><!--END .content-->


<?php get_footer(); ?>