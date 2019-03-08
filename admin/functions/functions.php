<?php

/* These are functions specific to the included option settings and this theme */

global $data; //fetch options stored in $data

/*-----------------------------------------------------------------------------------*/
/* Output Custom CSS from theme options
/*-----------------------------------------------------------------------------------*/

function head_css() {

		global $data;

		$output = '';
		
		$custom_css = $data['custom_css'];
		
		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}
		
		// Output styles
		if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
	
}
add_action('wp_head', 'head_css');

/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function analytics(){
	global $data;
	$output = $data['google_analytics'];
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','analytics');


/*-----------------------------------------------------------------------------------*/
/* Show Slider JS on Portfolio pages if enabled
/*-----------------------------------------------------------------------------------*/

function slider_js() {
	global $data;
	?>
        <script type="text/javascript">
			if(jQuery().flexslider){
				jQuery(window).load(function() {
				  jQuery('.flexslider.slider').flexslider({
					animation: "slide",
					pauseOnHover:true,
					directionNav:false,
					smoothHeight:true,
				  });
				});
			}
        </script>
       
    <?php

}

add_action('wp_head', 'slider_js');



/*-----------------------------------------------------------------------------------*/
/* Add sliding functionality to posts on homepage for section one
/*-----------------------------------------------------------------------------------*/

function section_one_js() {
	?>
        <script type="text/javascript">
			if(jQuery().flexslider){
				jQuery(window).load(function() {
				  jQuery(".two-columns .cat-content.flexslider").flexslider({
					animation: "slide",
					smoothHeight:true,
					controlNav:false,
					touch:false,
					slideshow:false
				  });
				});
			}
        </script>
    <?php
}
add_action('wp_head', 'section_one_js');


/*-----------------------------------------------------------------------------------*/
/* Add sliding functionality to posts on homepage
/*-----------------------------------------------------------------------------------*/

function section_two_js() {
	?>
        <script type="text/javascript">
			if(jQuery().flexslider){
			  jQuery(window).load(function() {
				jQuery(".single-column .cat-content.flexslider").flexslider({
				  animation: "slide",
				  smoothHeight:true,
				  controlNav:false,
				  touch:false,
				  slideshow:false
				});
			  });
			}
        </script>
    <?php
}

add_action('wp_head', 'section_two_js');


/*-----------------------------------------------------------------------------------*/
/* Show selected style 
/*-----------------------------------------------------------------------------------*/

function style() { 
	global $data;
	$image = $data['body_bg'];
	$color = $data['body_color'];
	$custom = $data['custom_bg'];
	$repeat = $data['bg_type'];
	$scroll = $data['bg_scroll'];
	
?> 
	<?php if(empty($custom) == 1):  ?>
    
			<?php if($image != 'bg0' && $image != ''):  ?>

                <style type="text/css">
                <?php if($image == 'bg1' || $image == 'bg2'):  ?>	
                    body{
                        background:url('<?php echo get_template_directory_uri().'/images/'.$image.'.jpg' ?>') no-repeat fixed center;
                        background-size:cover;
                    }
                <?php else: ?>
                    body{
                        background:url('<?php echo get_template_directory_uri().'/images/'.$image.'.jpg' ?>') repeat fixed center;
                    }
                    .inner_wrap {
                      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3) !important;
                    }
                <?php endif; ?>
                
                </style>
            
            <?php else: ?>
            
                <style type="text/css">
                <?php if($color != ''):  ?>	
                    body{
                        background:<?php echo $color ?>;
                    }
                    .inner_wrap {
                      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3) !important;
                    }
                <?php endif; ?>
                </style>
                
            <?php endif; ?>

    <?php else: ?>
			
			<style type="text/css">
			
            <?php if($custom != ''):  ?>	
                body{
                    background-image:url('<?php echo $custom ?>');
					background-position:center;
                    <?php if($repeat == 'one'): ?>
						background-size:cover;
					<?php else: ?>
						<?php if($repeat == 'two'): ?>
							background-repeat:repeat;
						<?php elseif($repeat == 'three'): ?>
							background-repeat:repeat-x;
						<?php elseif($repeat == 'four'): ?>
							background-repeat:repeat-y;
						<?php endif; ?>
					<?php endif; ?>
					<?php if($scroll == 'one'): ?>
						background-attachment:fixed;
					<?php else: ?>
						background-attachment:scroll;
					<?php endif; ?>
					
                }
            <?php else: ?>
                body{
                    background:url('<?php echo get_template_directory_uri().'/images/'.$image.'.jpg' ?>') repeat fixed center;
                }
                .inner_wrap {
                  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3) !important;
                }
            <?php endif; ?>
            
            </style>

    <?php endif; ?>

	<?php if(!is_front_page()): ?>
        <style type="text/css">
			#post-content.bigger_section {
			  background: url("<?php echo get_template_directory_uri() ?>/images/ver_dash.png") repeat-y right 0 !important;
			}
			#sidebar.bigger_section {
			  background: url("<?php echo get_template_directory_uri() ?>/images/ver_dash.png") repeat-y left 0 !important;
			}
			.smaller_section{
				background:none !important;
			}
        </style>
    <?php endif; ?>

<?php 
}

add_action('wp_head', 'style'); 
?>