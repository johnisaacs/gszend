<?php

/*-----------------------------------------------------------------------------------

	This file is restricted for editing by any professional only.
	Please don't mess with any of its code, as it might become troublesome for you and you visitors

-----------------------------------------------------------------------------------*/

add_action('after_setup_theme', 'theme_setup');
function theme_setup(){
    load_theme_textdomain('jd_framework', get_template_directory().'/lang');
}

/*-----------------------------------------------------------------------------------*/
/*	Register WP3.0+ Menus
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'menus' );

function register_menu() {
	register_nav_menus( array(
	'header-top-menu' => 'Header Top Menu',
	'primary-menu' => 'Primary Menu',
	'footer-menu' => 'Footer Menu'
) );
}
add_action('init', 'register_menu');

class description_walker extends Walker_Nav_Menu
{
      //function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) 
	  function start_el( &$output, $item, $depth = 0, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="'.$args->menu_id.'-menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '<strong><span>/</span>';
           $append = '</strong>';


            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id);
            }
}

add_theme_support( 'automatic-feed-links' );

if ( ! isset( $content_width ) ) $content_width = 650;


/*-----------------------------------------------------------------------------------*/
/*	Configure WP2.9+ Thumbnails
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 70, 70, true ); // Normal post thumbnails
	add_image_size( 'medium', 315, '', true ); // Medium thumbnails
	add_image_size( 'small', 140, 140, true ); // Small thumbnails
	add_image_size( 'post-large', 650, 350, true ); // Post thumbnails
	add_image_size( 'fullsize', '', '', true ); // Fullsize
}

/*-----------------------------------------------------------------------------------*/
/*	Seperate newlines in the welcome message
/*-----------------------------------------------------------------------------------*/
function tz_seperate_message($text){
	$wordChunks = explode("\n", $text);
	for($i = 0; $i < count($wordChunks); $i++){
		echo "<p> $wordChunks[$i] </p>";
	}
	return;
}

/*-----------------------------------------------------------------------------------*/
/*	Add additional fields to user profile in admin panel
/*-----------------------------------------------------------------------------------*/

function my_user_contactmethods($user_contactmethods){

  unset($user_contactmethods['yim']);
  unset($user_contactmethods['aim']);
  unset($user_contactmethods['jabber']);

  $user_contactmethods['twitter'] = 'Twitter Username';
  $user_contactmethods['facebook'] = 'Facebook Username';

  return $user_contactmethods;
}
add_filter('user_contactmethods', 'my_user_contactmethods');  

/*-----------------------------------------------------------------------------------*/
/*	Register Sidebars
/*-----------------------------------------------------------------------------------*/

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Main Sidebar',
		//'id'=>'main_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Footer One',
		//'id'=>'footer_one',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Footer Two',
		//'id'=>'footer_two',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Footer Three',
		//'id'=>'footer_three',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Footer Four',
		'id'=>'footer_four',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
}


/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

function theme_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = '<div';
			$add_below = 'comment';
		} else {
			$tag = '<li';
			$add_below = 'div-comment';
		}
?>
		<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
        
        <div class="line"></div>
        
        <div class="comment-vcard">
			<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
            
            <?php $comment_author = get_comment_author_email() ?>
            <span class="author-tag"><?php if(get_the_author_meta('user_email') == $comment_author) echo 'Author'; ?></span>
		</div>
        
        <div class="comment_detail">
			
            <div class="comment-header">
            
				<?php printf(__('<span class="author">%s</span>'), get_comment_author_link()) ?> 
                                  
                <span class="date">
                    <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?> 
                </span>
    
                <span class="reply">
                    <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </span>
                
                <?php if ($comment->comment_approved == '0') : ?>
                        <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
                <?php endif; ?>
            
            </div><!--comment-header-->
    
            <?php comment_text() ?>
                               
        </div><!--.comment_detail-->
        
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
        
<?php }


/*-----------------------------------------------------------------------------------*/
/*	Register and load common JS
/*-----------------------------------------------------------------------------------*/

function register_js() {
	
	global $data;
	
	if (!is_admin()) {
		
		wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js');
		wp_register_script('flexi', get_template_directory_uri() . '/js/jquery.flexslider-min.js');	
		wp_register_script('custom', get_template_directory_uri() . '/js/custom.js',array('jquery'),'1.0', TRUE);	
		wp_register_script('tipsy', get_template_directory_uri() . '/admin/assets/js/jquery.tipsy.js');
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('superfish');
		wp_enqueue_script('custom');
		wp_enqueue_script('flexi');
		wp_enqueue_script('tipsy');	
	}
}
add_action('init', 'register_js');

/*-----------------------------------------------------------------------------------*/
/*	Load contact template javascript
/*-----------------------------------------------------------------------------------*/

function contact_js() {
	if (is_page_template('template-contact.php') || is_single()) 
		wp_register_script('validation', get_template_directory_uri() . '/js/jquery.validate.min.js');
		wp_enqueue_script('validation');
}
add_action('wp_print_scripts', 'contact_js');



/*-----------------------------------------------------------------------------------*/
/* Load scripts for single pages
/*-----------------------------------------------------------------------------------*/

function single_scripts() {
	if(is_single()) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_print_scripts', 'single_scripts');


/*-----------------------------------------------------------------------------------*/
/* Shortcode scripts handler
/*-----------------------------------------------------------------------------------*/
add_action('init', 'register_shortcode');
add_action('wp_footer', 'print_shortcode');
 
function register_shortcode() {
	wp_register_script('shortcodes', get_template_directory_uri() . '/js/jquery.shortcodes.js', array('jquery-ui-tabs','jquery-ui-accordion'));	
    wp_register_style( 'shortcode-style', get_template_directory_uri() . '/css/shortcodes.css' );  
}
 
function print_shortcode() {
	global $add_script;
 
	if (!$add_script)
		return;

	wp_print_scripts('shortcodes');
	wp_print_styles('shortcode-style');
}

/*-----------------------------------------------------------------------------------*/
/*	Load Widgets & Shortcodes
/*-----------------------------------------------------------------------------------*/
// Add the Latest Tweets Tags Widget
include("functions/widget-tags.php");

// Add the Flickr Photos Custom Widget
include("functions/widget-flickr.php");

// Add the Custom Video Widget
include("functions/widget-video.php");

// Add the Custom 125X125 ad Widget
include("functions/widget-ad125.php");

//Add custom posts widget
include("functions/widget-posts.php");

//Add custom posts widget
include("functions/widget-posts-cat.php");

// Add the Custom twitter widget
include("functions/widget-twitter.php");

/*-----------------------------------------------------------------------------------*/
/*	Filters that allow shortcodes in Text Widgets
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Helpful function to see if a number is a multiple of another number
/*-----------------------------------------------------------------------------------*/

function is_multiple($number, $multiple) 
{ 
    return ($number % $multiple) == 0; 
} 


/*-----------------------------------------------------------------------------------*/
/*	Multiple Excerpt Lengths
/*-----------------------------------------------------------------------------------*/
class Excerpt {

  // Default length (by WordPress)
  public static $length = 55;

  // So you can call: my_excerpt('short');
  public static $types = array(
      'short' => 25,
      'regular' => 55,
      'long' => 100
    );

  public static function length($new_length = 55) {
    Excerpt::$length = $new_length;

    add_filter('excerpt_length', 'Excerpt::new_length');

    Excerpt::output();
  }

  // Tells WP the new length
  public static function new_length() {
    if( isset(Excerpt::$types[Excerpt::$length]) )
      return Excerpt::$types[Excerpt::$length];
    else
      return Excerpt::$length;
  }

  // Echoes out the excerpt
  public static function output() {
    the_excerpt();
  }

}

// An alias to the class
function zd_excerpt($length = 55) {
  Excerpt::length($length);
}

/*-----------------------------------------------------------------------------------*/
/*	Configure Excerpt String
/*-----------------------------------------------------------------------------------*/

function excerpt_more($excerpt) {
return str_replace('[...]', '...', $excerpt); }
add_filter('wp_trim_excerpt', 'excerpt_more');


/*-----------------------------------------------------------------------------------*/
/*	Add Browser Detection Body Class
/*-----------------------------------------------------------------------------------*/

add_filter('body_class','browser_body_class');
function browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	return $classes;
}

/*-----------------------------------------------------------------------------------*/
/*	Get category link for section title
/*-----------------------------------------------------------------------------------*/
function cat_link($cat_name){
	
	$cat_id = get_cat_ID($cat_name);

	return get_category_link($cat_id);	
	
}

/*-----------------------------------------------------------------------------------*/
/*	Load Theme Options
/*-----------------------------------------------------------------------------------*/
require_once ('admin/index.php');

/*-----------------------------------------------------------------------------------*/
/*	Registor plugins in wordpress
/*-----------------------------------------------------------------------------------*/
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'zend_required_plugins' );

function zend_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'ZillaShortcodes',
			'slug'     				=> 'zilla-shortcodes', 
			'source'   				=> get_stylesheet_directory() . '/plugins/zilla-shortcodes.zip', 
			'required' 				=> false,
			'force_deactivation' 	=> true,
		),
		array(
			'name'     				=> 'WP-PageNavi',
			'slug'     				=> 'wp-pagenavi',
			'required' 				=> false,
			'force_deactivation' 	=> true,
		),
	);

	$theme_text_domain = 'tgmpa';

	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}


//Function to remove pages from being searched
function SearchFilter($query) {
	if ($query->is_search && !is_admin()) {
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts','SearchFilter');


?>