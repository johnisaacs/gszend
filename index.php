<?php
	global $data; //fetch options stored in $data
?>

<?php get_header(); ?>           			
           
            <div id="main_container" class="container">
            
            	<div class="inner_content row">
					
                    <div class="post-content column">
                            
                            <?php  if (have_posts()) : ?>
                          
                           <div class="cat-container clearfix">   
                                                 	
                            <?php 
								$i=1;
								while (have_posts()) : the_post();							
								if($i <= 2):                                   
                            ?>
                                
                                <div class="item clearfix alignleft two_columns">
                                
								<?php 
																		
                                if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) : /* if post has post thumbnail */ 
	              				    $thumb_large = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),  array(315,169) );
								
								 ?>                                  
                                    <div class="image">
                            
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_large[0]; ?>" alt="" height="<?php echo $thumb_large[2]; ?>" width="<?php echo $thumb_large[1]; ?>"/></a>
                                    
                                    </div><!--image-->


									<?php else: ?>
                                    
                                    <div class="image">
                            
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri().'/images/default_image_315.jpg'; ?>" /></a>
                                    
                                    </div><!--slider_image-->

                                  <?php endif; ?>

                                    
                                    <div class="details">
                                  
                                      <div class="post-meta">
                                          <span class="date"><?php the_time( get_option('date_format') ); ?> </span>
                                          <span><?php _e('by','jd_framework'); ?></span>
                                          <span class="author"><?php the_author_posts_link(); ?> </span>
                                                                               
                                      </div><!--cats-->
                                      
                                      <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                      
                                      <div class="excerpt">
                                      
                                          <?php zd_excerpt('20'); ?>
                                      
                                      </div><!--excerpt-->
                                      
                                      <div class="more_link">
                                        <a href="<?php the_permalink(); ?>"><?php _e('Read More','jd_framework'); ?></a>
                                      </div>
                                  
                                    </div><!--details-->
                                    
                                    <div class="clear"></div>
                                
                                </div><!--item-->

                                <?php elseif($i > 2): ?>
                                                  
                            	<?php if($i==3): ?><div class="clear"></div> <?php endif; ?>        	

                                <div class="item clearfix single_column">
                                
								<?php 
                                    if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) : /* if post has post thumbnail */ 
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'small');
                                        
                                ?>                                
                                    <div class="image">
                            
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('small'); ?></a>
                                    
                                    </div><!--slider_image-->
                                

                                    <?php else: ?>
                                    
                                    <div class="image alignleft">
                            
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri().'/images/default_image.png'; ?>" /></a>
                                    
                                    </div><!--slider_image-->

                                  <?php endif; ?>

                                    
                                    <div class="details">
                                  
                                      <div class="post-meta">
                                          <span class="date"><?php the_time( get_option('date_format') ); ?> </span>
                                          <span><?php _e('by','jd_framework'); ?></span>
                                          <span class="author"><?php the_author_posts_link(); ?> </span>
                                                                               
                                      </div><!--cats-->
                                      
                                      <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                      
                                      <div class="excerpt">
                                      
                                          <?php zd_excerpt('20'); ?>
                                      
                                      </div><!--excerpt-->
                                      
                                      <div class="more_link">
                                        <a href="<?php the_permalink(); ?>"><?php _e('Read More','jd_framework'); ?></a>
                                      </div>
                                  
                                    </div><!--details-->
                                    
                                    <div class="clear"></div>
                                
                                </div><!--item-->

                                
                                <?php endif; ?>  
                                                            
                                
                                <?php $i++; ?>     
                                  
                            <?php endwhile; ?>
                             
                             
                            </div><!--single_column-->                              
                            
                            <?php else: ?>
                                              			
                            <div class="grid_8 alpha omega">
                            
                                <div class="archive_title"><h1><?php _e('Error 404 - Not Found', 'jd_framework') ?></h1><div class="clear"></div></div>
                        
                                <div class="no">
                                    
                                    <p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
                                    <?php get_search_form(); ?>
                                    
                                    <div class="clear"></div>
                                
                                </div>
                        	</div>
                            <?php endif; ?>
                            
                            <?php wp_reset_query(); ?>

                            <div class="page_navi">
                            
                            	<div class="pagination">
                                	
                                    <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                                        <div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'jd_framework')) ?></div>
                                        <div class="nav-prev"><?php previous_posts_link(__('Newer Entries &rarr;', 'jd_framework')) ?></div>
                                    <?php } ?>             
                                    
                                    <div class="clear"></div>
                                
                                </div>
                            
                            </div><!--page_navi-->
                    
                        </div><!--.post-content-->

                        
						<?php get_sidebar(); ?>
                        
                        <div class="clear"></div>     
                </div><!-- .inner_content-->

            </div> <!--#main_container-->

<?php get_footer(); ?>