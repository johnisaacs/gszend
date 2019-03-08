<?php
/*
	Template Name: Home
*/
	global $data; //fetch options stored in $data
	get_header();
?>           			
           
            <div id="main_container" class="container">
            
            	<div class="inner_content row">
					
                    <div class="post-content column">
                            
                         <?php 
						 $tag = $data['slider_tag'];
						 
						 if($tag == ''){
							$tag = 'slider-home'; 
						 }
						 
						 if($data['slider'] != '0'): ?>
                         
                         <div class="flexslider slider">
                        	
                            <ul class="slides">
                            
                              <?php $i=0; ?>
                              
                              <?php $array_id = array(); ?>  
                                                        
                              <?php 
                              $query = new WP_Query();
                              $query->query('tag='.$tag.'&posts_per_page=6');
                              if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                              
                              <?php $array_id[$i] = get_the_ID(); ?>
                          
                              <li class="item">
                                  
                                  <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
                              
                                  <div class="image">
                          
                                      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-large'); ?></a>
                                  
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
                                      
                                          <?php zd_excerpt('regular'); ?>
                                      
                                      </div><!--excerpt-->
                                  
                                  </div><!--details-->
                                  
                                  <div class="clear"></div>
                              
                              </li><!--item-->
                              
                              <?php $i++; ?>
                              
                              <?php endwhile; endif; ?>
                          
                              <?php wp_reset_query(); ?>
                          	
                            </ul> <!--slides_container-->
                            
                          </div><!--slider-->
                          
                          <?php endif; ?>
                          
                          <div class="clear"></div>
                          
                          <?php 
						  		$s1_enable = $data['section_1'];
								$s2_enable = $data['section_2'];
						  ?>
                          
                          <?php if($s1_enable != '0'): ?>
                          
                          <div class="cat-container two-columns">

                                <?php 
								
								$post_no = $data['s1_post_no'];
								$slider_enable = $data['s_section_1'];
								$category_id = get_cat_ID($data['s1_cat']);
														
								//Set the starter count
                                $start = 4;
                                //Set the finish count
                                $finish = 1;
								
								if($data['s1_cat'] == 'latest posts' || $data['s1_cat'] == 'popular posts'){
									if($data['s1_cat'] == 'latest posts'){
										$query = new WP_Query(array ( 'orderby' => 'date', 'posts_per_page' => $post_no,'post__not_in' => $array_id ));
									}
									elseif($data['s1_cat'] == 'popular posts'){
										$query = new WP_Query(array ( 'orderby' => 'comment_count', 'posts_per_page' => $post_no ,'post__not_in' => $array_id ));
									}
								}
								else{
									if($category_id != '0'){
										$query = new WP_Query(array ( 'posts_per_page' => $post_no ,'cat' => $category_id ,'post__not_in' => $array_id ));
									}
								}	
                                
                                //Get the total amount of posts
                                $post_count = $query->post_count;
 								?>                                
                                
                                <div class="cat-title">
                                    <h2>
                                        <?php echo $data['s1_cat']; ?>
                                    </h2>                                                                
                                </div>
                          	
                                <div class="cat-content <?php if($slider_enable == 1) echo 'flexslider' ?>">
                                    
                                    <ul class="slides clearfix">
                                    
										<?php 
           
                                        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

                                        	<?php if(is_multiple($start, 4)) : /* if the start count is a multiple of 4 */ ?>
	                                            <li class="slide">
                                            <?php endif; ?>   
                                            
                                                <div class="item clearfix"> 
                                                    
                                                    <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ 
                                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),  array(315,169) );
                                                    ?>
                                                
                                                    <div class="image">
                                            
                                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb[0]; ?>" alt="" height="<?php echo $thumb[2]; ?>" width="<?php echo $thumb[1]; ?>"/></a>
                                                    
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
                                                                                               
                                                      </div><!--post-meta-->
                                                      
                                                      <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                      
                                                      <div class="excerpt">
                                                      
                                                          <?php zd_excerpt('30'); ?>
                                                      
                                                      </div><!--excerpt-->
                                                      
                                                      <div class="more_link">
                                                        <a href="<?php the_permalink(); ?>">Read More</a>
                                                      </div>
                                                  
                                                    </div><!--details-->                                      
                                                
                                                </div> <!--END .item -->
											
											<?php if(is_multiple($finish, 4) || $post_count == $finish) : /* if the finish count is a multiple of 4 or equals the total posts */  ?>
                                           	</li> <!--END .slide -->
                                            
                                            <?php endif; ?>  
                                            
                                            <?php
                                              $start++;
                                              $finish++;
                                             ?>
                                        
                                        <?php endwhile; endif; ?>
                                    
                                        <?php wp_reset_query(); ?>
                                	
                                    </ul> <!--slides-->
                                    
                                </div> <!--.cat-content-->

                          </div> <!--.cat-container-->
                          
                          <?php endif; ?>  
                          
                          <div class="clear"></div>
                          
                          <?php if($s2_enable != '0'): ?>
                          
                          <div class="cat-container single-column">
                          	
                                <?php 
								
								$post_no = $data['s2_post_no'];
								$slider_enable = $data['s_section_2'];
								$category_id = get_cat_ID($data['s2_cat']);
								
								//Set the starter count
                                $start = 3;
                                //Set the finish count
                                $finish = 1;
                                
								$query = new WP_Query();
								if($data['s2_cat'] == 'latest posts' || $data['s2_cat'] == 'popular posts'){
									if($data['s2_cat'] == 'latest posts'){
										$query = new WP_Query(array ( 'orderby' => 'date', 'posts_per_page' => $post_no,'post__not_in' => $array_id ));
									}
									elseif($data['s2_cat'] == 'popular posts'){
										$query = new WP_Query(array ( 'orderby' => 'comment_count', 'posts_per_page' => $post_no ,'post__not_in' => $array_id ));
									}
								}
								else{
									if($category_id != '0'){
										$query = new WP_Query(array ( 'posts_per_page' => $post_no ,'cat' => $category_id ,'post__not_in' => $array_id ));

									}
								}	
                                
                                //Get the total amount of posts
                                $post_count = $query->post_count;
 								?>                                
                                
                                <div class="cat-title">
                                    <h2>
                                        <?php echo $data['s2_cat']; ?>
                                    </h2>                                                                
                                </div>
                          	
                                <div class="cat-content <?php if($slider_enable == 1) echo 'flexslider' ?>">
                                                                   
                                    <ul class="slides">
                                    
										<?php 
           
                                        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                                    
                                        	<?php if(is_multiple($start, 3)) : /* if the start count is a multiple of 3 */ ?>
	                                            <li class="slide">
                                            <?php endif; ?>   
                                
                                            <div class="item clearfix">

												<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ 
                                                    $thumb_small = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(140,140));
                                                ?>
                                            
                                                <div class="image">
                                        
                                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_small[0]; ?>" alt="" height="<?php echo $thumb_small[2]; ?>" width="<?php echo $thumb_small[1]; ?>"/></a>
                                                
                                                </div><!--image-->

                                                  <?php else: ?>
                                                  
                                                  <div class="image">
                                          
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
                                            
											<?php if(is_multiple($finish, 3) || $post_count == $finish) : /* if the finish count is a multiple of 3 or equals the total posts */  ?>
                                           	</li> <!--END .slide -->
                                            
                                            <?php endif; ?>  
                                            
                                            <?php
                                              $start++;
                                              $finish++;
                                             ?>
                                    
                                    <?php endwhile; endif; ?>
                                
                                    <?php wp_reset_query(); ?>
                                
                               		</ul> <!--slides_container-->
                                
                                </div> <!--.cat-content-->

                          </div> <!--.cat-container-->
                          
                          <?php endif; ?>  
 
                	</div>  <!--post-content-->   
                    
                    <?php get_sidebar(); ?>              
                
                </div><!-- .inner_content-->

            </div> <!--#main_container-->

<?php get_footer(); ?>