<?php global $data; ?>
<!DOCTYPE html>

<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<!-- BEGIN head -->
<head>

	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- Title -->
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?><?php echo ' | '; ?><?php bloginfo('description'); ?></title>

    <!--Favicon code-->
     <?php 	
		if ($data['custom_favicon'] != '') {
			echo '<link rel="shortcut icon" href="'. $data['custom_favicon'] .'"/>'."\n";
		}
		else { 
	?>
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/admin/images/favicon.ico" />
	<?php } ?>   

    <!-- 1140px Grid styles for IE -->
	<!--[if lte IE 9]><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" type="text/css" media="screen" /><![endif]-->

	<!--add css for different pages-->
	<?php include 'includes/additional-css.php'; // include the slider ?>

	<!--Color CSS-->
	<?php $primary_color = $data['primary_color'];?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/color.php?color=<?php echo substr($primary_color,1) ?>" type="text/css" media="screen" />

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style_load.php" type="text/css" media="screen" />
    
    <?php 
		$data['response'] = 0;
		if($data['response'] != '1'): 
	?>
    	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/response.css" type="text/css" media="screen" />
    <?php else: ?>
    	<style type="text/css">
			.inner_wrap, .footer_inner {
			  width: 1034px !important;
			}
		</style>
    <?php endif; ?>
  
	    
    <!-- Theme Hook -->
	<?php wp_head(); ?>
	

</head><!-- END head -->

<!-- BEGIN body -->
<body <?php body_class(); ?>>
	
    
    <div class="wrap container">
    
    	<div class="inner_wrap row">
        
        <div id="header" class="clearfix">
                         	
                  <div class="header-top main clearfix">
                  	
                      <div id="header-nav">
                          <?php if ( has_nav_menu( 'header-top-menu' ) ) { /* if menu location 'primary-menu' exists then use custom menu */ ?>
                          <?php wp_nav_menu( array( 'menu_id'=>'top_main','theme_location' => 'header-top-menu','walker' => new description_walker()) ); ?>
                          <?php } else { /* else use wp_list_categories */
                          ?>
                          <ul>
                              <?php wp_list_pages(array( 'title_li' => '')); ?>
                          </ul>
                          <?php } ?>
                              
                      </div>
                      
                      <!--BEGIN #searchform-->
                      <form method="get" class="searchform alignright" action="<?php echo home_url(); ?>/">
                          <input type="text" name="s" class="s" value="" placeholder="<?php _e('Type Keyword and hit enter', 'jd_framework') ?>" />
                          <input type="submit" class="searchsubmit" value="<?php _e('go', 'jd_framework') ?>">
                      </form><!--END #searchform-->
                  
                  </div> <!--header-top-->


                  <div class="header-top mobile clearfix">
                  	
                      <div class="mobile_cont clearfix">
                      
                          <div id="header-nav-mobile">
                              <?php if ( has_nav_menu( 'header-top-menu' ) ) { /* if menu location 'primary-menu' exists then use custom menu */ ?>
                              <?php wp_nav_menu( array('menu_id'=>'top_mobile','theme_location' => 'header-top-menu','walker' => new description_walker()) ); ?>
                              <?php } else { /* else use wp_list_categories */
                              ?>
                              <ul>
                                  <?php wp_list_pages(array( 'title_li' => '')); ?>
                              </ul>
                              <?php } ?>
                                  
                          </div>
                          
                          <!--BEGIN #searchform-->
                          <form method="get" class="searchform alignright" action="<?php echo home_url(); ?>/">
                              <input type="text" name="s" class="s" value="" placeholder="<?php _e('Type Keyword and hit enter', 'jd_framework') ?>" />
                              <input type="submit" class="searchsubmit" value="<?php _e('go', 'jd_framework') ?>">
                          </form><!--END #searchform-->
                      
                      </div>
                  
                  </div> <!--header-top-->


                  <div class="header-middle clearfix">
                  
                      <div id="logo">
                          <?php /*
                          If "plain text logo" is set in theme options then use text
                          if a logo url has been set in theme options then use that
                          if none of the above then use the default logo.png */
                          
                          $plain_logo = $data['plain_logo'];
                          $logo = $data['logo'];
                          
                          if ($plain_logo == '1') { ?>
                          <a class="title" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
                          <span class="description"><?php bloginfo( 'description' ); ?></span>
                          <?php } else { ?>
                          <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
                          <?php } ?>
      
                      </div> <!--logo-->                     
                      
                      <?php 
					  		$twitter = $data['twitter'];
							$facebook = $data['facebook'];
							$pin = $data['pin'];
							$rss = $data['rss'];
							$linked = $data['linked'];
							
							$twitter_u = $data['u_twitter'];
							$facebook_u = $data['u_facebook'];
							$linked_u = $data['u_linked'];
							$pin_u = $data['u_pin'];
							$rss_u = $data['u_rss'];						
					  ?>
					  
					  <?php if($twitter != '0' || $facebook != '0' || $pin != '0' || $rss != '0'): ?>
                      <div id="social_sharing" class=" alignright">
                      	<ul>
                        	<?php 							
							if($twitter != '0'): ?>
                            	<li><a class="twitter" href="http://www.twitter.com/<?php echo $twitter_u ?>" title="<?php _e('Follow us on Twitter','jd_framework');?>">&times;</a></li>
                            <?php endif; ?>
                            
                            <?php if($facebook != '0' ): ?>
                        	<li><a class="facebook" href="<?php echo $facebook_u ?>" title="<?php _e('Our Facebook page','jd_framework'); ?>">&times;</a></li>
                            <?php endif; ?>

                            <?php if($pin != '0'): ?>
                            <li><a class="pininterest" href="http://www.pinterest.com/<?php echo $pin_u ?>" title="<?php _e('We are on Pinterest too','jd_framework'); ?>">&times;</a></li>
                            <?php endif; ?>
                            
                            <?php if($linked != '0' ): ?>
                        	<li><a class="linked" href="<?php echo $linked_u ?>" title="<?php _e('LinkedIn profile','jd_framework'); ?>">&times;</a></li>
                            <?php endif; ?>
                                                        
                            <?php if($rss != '0'): ?>
                            <li><a class="rss" href="<?php echo $rss_u ?>" title="<?php _e('View our RSS feed','jd_framework'); ?>">&times;</a></li>
                            <?php endif; ?>
                        </ul>                      
                      </div>  <!--#social_sharing-->
                      <?php endif; ?>
                  
                  </div> <!--.header-middle-->
                  
                  <div class="header-bottom clearfix">
                  
                      <div id="primary-nav">
                          <?php if ( has_nav_menu( 'primary-menu' ) ) { /* if menu location 'primary-menu' exists then use custom menu */ ?>
                          <?php wp_nav_menu( array( 'menu_id'=>'primary_main','theme_location' => 'primary-menu','walker' => new description_walker())); ?>
                          <?php } else { /* else use wp_list_categories */
                          ?>
                          <ul>
                              <?php wp_list_pages(array( 'title_li' => '')); ?>
                          </ul>
                          <?php } ?>
                              
                      </div><!-- primary-nav-->
                      
                      <div id="mobile-nav">
                          <?php if ( has_nav_menu( 'primary-menu' ) ) { /* if menu location 'primary-menu' exists then use custom menu */ ?>
                          <?php wp_nav_menu( array( 'menu'=>'primary_mobile','theme_location' => 'primary-menu' ,'walker' => new description_walker())); ?>
                          <?php } else { /* else use wp_list_categories */
                           ?>
                          <ul>
                              <?php wp_list_pages(array( 'title_li' => '')); ?>
                          </ul>
                          <?php } ?>  
                      </div>
                                       
                  
                  </div> <!-- header-bottom -->
             
        
       </div> <!--#header-->