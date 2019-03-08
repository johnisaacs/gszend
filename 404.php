<?php
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");
?>

<?php get_header(); ?>

        <div id="main_container" class="container">    
                       
            <div class="inner_content row">

            <!--BEGIN .post-content -->
            <div class="post-content clearfix">
            
                  <div id="page-top">
                    <h2 id="page-title">
                        <?php _e('Error 404 - Not Found', 'jd_framework') ?>
                    </h2>
                 </div> <!--#page_top-->
            				
                  <!--BEGIN #post-0-->
                  <div id="post-0" <?php post_class(); ?>>

                          <p class="error_msg"><?php _e("Sorry, but you are looking for something that isn't here. Try another search", "jd_framework") ?></p>
              
                  <!--END #post-0-->
                  </div>
            
            </div><!--END .post-content-->
                

		  <?php get_sidebar(); ?>
          
          <div class="clear"></div>
              
          </div><!--END .inner-content-->
      
         
      </div><!--END .content-->



<?php get_footer(); ?>