<?php
	global $data; //fetch options stored in $data
?>

    <!-- BEGIN #footer-container -->
    <div id="footer" class="container">

            <div class="footer_inner row clearfix">
            
            <!-- BEGIN .widget-section -->
                <?php if ( is_active_sidebar( 'Footer One' ) ) : ?>
                <div class="grid_four neutral">
                	
                    <?php /* Footer Widget one */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer One' ) ) ?>

                </div><!-- END .grid_four --> 
                <?php endif; ?>
                  
                
                <!-- BEGIN .widget-section -->
                <?php if ( is_active_sidebar( 'Footer Two' ) ) : ?>
                <div class="grid_four">
                
                	<?php /* Footer Widget two */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer Two' ) ) ?>

                </div><!-- END .grid_four --> 
                <?php endif; ?>

                <!-- BEGIN .widget-section -->
                <?php if ( is_active_sidebar( 'Footer Three' ) ) : ?>
                <div class="grid_four">
                
                	<?php /* Footer Widget three */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer Three' ) ) ?>

                </div><!-- END .grid_four --> 
                <?php endif; ?>  
                
                <!-- BEGIN .widget-section -->
                <?php if ( is_active_sidebar( 'Footer Four' ) ) : ?>
                <div class="grid_four">

                	<?php /* Footer Widget four */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer Four' ) ) ?>

                </div><!-- END .grid_four -->  
                <?php endif; ?> 
            
                <div class="clear"></div>
                               
            </div><!--Footer-inner-->
        </div><!-- end .footer -->
	
		
        <div id="footer_bottom" class="container">
                
                <div class="footer_inner attribution clearfix row">
                
                    <p class="copyright">&copy; Copyright <?php echo date( 'Y' ); ?><span><?php echo $data['copyright'] ?></span></p>
                	                   
                      <div id="footer-nav">
                          <?php if ( has_nav_menu( 'footer-menu' ) ) { /* if menu location 'primary-menu' exists then use custom menu */ ?>
                          <?php wp_nav_menu( array( 'theme_location' => 'footer-menu') ); ?>
                          <?php } ?>
                              
                      </div>
 
                </div> <!--attribution--> 
                
                <div class="top_scroll"><a href="#top"><?php _e('&uarr;', 'jd_framework'); ?></a></div>
                
          </div> <!--Footer_bottom-->   
    
    	</div> <!--.inner_warp-->
    
    </div> <!--.wrap .container	-->

<?php 
	$haystack = $data['social_links']['enabled'];
	if(in_array('Facebook', $haystack)):
?> 
    <span id="fb-root"></span>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<?php endif; ?>

<?php if(in_array('Google Plus',$haystack)): ?>
	<script type="text/javascript">
	  (function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>
<?php endif; ?>

<?php if(in_array('Pin Interest',$haystack)): ?>
    <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<?php endif; ?>
    
        
	<!-- Theme Hook -->
	<?php wp_footer(); ?>

</body><!--END body-->

</html><!--END html-->