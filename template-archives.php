<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>
			
           
            <div id="main_container" class="container">
                            
                <!--BEGIN .post-content-->
                <div class="inner_content row">

            		
					<div class="post-content">
            		
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
                                                                           
                              <!--BEGIN .archive-lists -->
                              <div id="masonry_archive" class="archive-lists">
                              
                              <?php $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");

                              foreach($years as $year) :
                              ?>
                                  
                                  <?php	$months = $wpdb->get_col("SELECT DISTINCT MONTH(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND YEAR(post_date) = '".$year."' ORDER BY post_date DESC");
                                 foreach($months as $month) :
                                  ?>
                                  
                                  <div class="month_archive">
                                  
                                      <div class="title">
                                          <span class="month"><?php echo date( 'F', mktime(0, 0, 0, $month) );?></span>
                                          <span class="year"><?php echo $year; ?></span>
                                      </div>

                                      <ul class="archive_list">
                                      
                                        <?php  $theids = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND MONTH(post_date)= '".$month."' AND YEAR(post_date) = '".$year."' ORDER BY post_date DESC");

                                         foreach ($theids as $theid):	
                                         ?>
                                         
                                         <?php 
										 	$meta_date=get_post($theid->ID, ARRAY_A);
											$month = substr($meta_date['post_date'],5,2);
											$day = substr($meta_date['post_date'],8,2);
											
											if($month != ''){
												$hu_mon = "";
												
												if($month == '01'){
													$hu_mon = 'Jan';
												}
												else if($month== '02'){
													$hu_mon = 'Feb';
												}
												else if($month== '03'){
													$hu_mon = 'Mar';
												}
												else if($month== '04'){
													$hu_mon = 'April';
												}
												else if($month== '05'){
													$hu_mon = 'May';
												}
												else if($month== '06'){
													$hu_mon = 'June';
												}
												else if($month== '07'){
													$hu_mon = 'July';
												}
												else if($month== '08'){
													$hu_mon = 'Aug';
												}
												else if($month== '09'){
													$hu_mon = 'Sept';
												}
												else if($month== '10'){
													$hu_mon = 'Oct';
												}
												else if($month== '11'){
													$hu_mon = 'Nnov';
												}
												else if($month== '12'){
													$hu_mon = 'Dec';
												}
												else{
													$hu_mon = 'Undefined';
												}
											}

										  ?>
   
                                              <li>
                                              	<a class="title" href="<?php echo get_permalink($theid->ID); ?>"><?php echo $theid->post_title; ?></a>
                                                <div class="clear"></div>                                                
                                                <span class="date"><?php echo $hu_mon.' '.$day; ?></span>
												<span><?php _e('in category','jd_framework'); ?></span>                              
                                                <span class="category">                                                
												<?php 
													$post_categories = wp_get_post_categories($theid->ID);
													foreach($post_categories as $c){
														$cat = get_category($c,'ARRAY_A');
														$link = get_category_link($c);
														echo '<a href="'.$link.'" >'.$cat['name'].'</a>, ';
													}																						
												?>
                                                
                                                </span>
                                              </li> 
                                              
                                          <?php endforeach; ?>
                                          
                                      </ul>
                                   
                                   </div> <!--month_archive	-->	  
                                  
                                  <?php endforeach;?>
                                  
                              <?php endforeach; ?>

                        
                              
                              </div> <!--END .archive-lists -->                      
                        
                         <?php endwhile; ?>        


						<?php else : ?>
            
                            <!--BEGIN #post-0-->
                            <div id="post-0" <?php post_class(); ?>>
                            
                                <h2 class="entry-title"><?php _e('Error 404 - Not Found', 'jd_framework') ?></h2>
                            
                                <!--BEGIN .entry-content-->
                                <div class="entry-content">
                                    <p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
                                <!--END .entry-content-->
                                </div>
                            
                            <!--END #post-0-->
                            </div>
            
                        <?php endif; ?>
            
           			</div><!--END .post-content-->
                    
                    <?php get_sidebar(); ?>
            
                    <div class="clear"></div>
            
			
				</div><!--END . inner_content-->
                
            </div><!--END .main_container-->


<?php get_footer(); ?>