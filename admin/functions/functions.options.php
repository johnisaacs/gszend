<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:","latest posts","popular posts");    
		
		//Sample Homepage blocks for the layout manager (sorter)
		$social_buttons = array
		( 
			"disabled" => array (
				"twitter" 	=> "Twitter", //REQUIRED!
				"linked"	=> "LinkedIn",
				"google"	=> "Google Plus",
				"pin"	=> "Pin Interest",
			), 
			"enabled" => array (
				"email"	=> "Email",
				"facebook"	=> "Facebook",
				"print"	=> "Print",
			),
		);

		
		$of_options_radio = array("one" => "Fullwidth ( Will make bg to extend upto browser width )","two" => "Repeat ( Will repeat bg horizontally and vertically )","three" => "Repeat-x ( Will repeat bg horizontally )","four" => "Repeat-y ( Will repeat bg vertically )");
		
		$of_options_radio_1 = array("one" => "Static ( Bg won't move while scrolling, instead will be fixed","two" => "Dynamic ( Bg will scroll while scrolling )");

/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( "name" => __('General Settings','framework'),
                    "type" => "heading");

$of_options[] = array( "name" => "Hello there!",
					"desc" => "",
					"id" => "introduction",
					"std" => "<h3 style=\"margin: 0 0 10px;\">Welcome to Zend's Option Panel.</h3>
					Please read the documentation provided along with the theme files before working with these options. For help you can visit <a href=\"http://themeforest.net/item/zend-responsive-blogmagazine-wordpress-theme/3139105\">Our Support Forum</a>",
					"icon" => true,
					"type" => "info");
							
$of_options[] = array( "name" => __('Custom Favicon','framework'),
					"desc" => __('Upload a 16px X 16px Png/Gif image that will represent your website\'s favicon.','framework'),
					"id" => "custom_favicon",
					"std" => "",
					"type" => "upload");
					
$of_options[] = array( "name" => __('Contact Form Email Address','framework'),
					"desc" => __('Enter the email address where you\'d like to receive emails from the contact form, or leave blank to use admin email.','framework'),
					"id" => "email",
					"std" => "",
					"type" => "text");
					
$of_options[] = array( "name" => __('FeedBurner URL','framework'),
					"desc" => __('Enter your full FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress Feed e.g. http://feeds.feedburner.com/yoururlhere','framework'),
					"id" =>"feedburner",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => __('Tracking Code','framework'),
					"desc" => __('Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.','framework'),
					"id" => "google_analytics",
					"std" => "",
					"type" => "textarea");  

$of_options[] = array( "name" => __('Footer copyright text','framework'),
					"desc" => __('Enter the name to whom the footer copyright text should address','framework'),
					"id" =>"copyright",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => __('Enable comments on pages','framework'),
					"desc" => __('Check this box to enable comments on pages','framework'),
					"id" =>"comment_pages",
					"std" => 0,
					"type" => "checkbox");
					
$of_options[] = array( "name" => __('Opt out responsiveness','framework'),
					"desc" => __('Check this to optout of responsiveness. You\'re site will no longer adapt to different devices','framework'),
					"id" => "response",
					"std" => 0,
					"type" => "checkbox");	
									       
$of_options[] = array( "name" => __('Enable Plain Text Logo','framework'),
					"desc" => __('Check this to enable a plain text logo rather than an image.','framework'),
					"id" => "plain_logo",
					"std" => 0,
					"type" => "checkbox");

$of_options[] = array( "name" => __('Custom Logo','framework'),
					"desc" => __('Upload a logo for your theme, or specify the image address of your online logo. (http://example.com/logo.png)','framework'),
					"id" => "logo",
					"std" => get_template_directory_uri().'/images/logo.png',
					"type" => "upload");	



$of_options[] = array( "name" => "Header Options",
                    "type" => "heading");

$of_options[] = array( "name" => __('Enable Twitter icon','framework'),
					"desc" => __('Check this box to enable twitter icon in the header','framework'),
					"id" => "twitter",
					"std" => 0,
					"folds" => 1,
					"type" => "checkbox");
					
$of_options[] = array( "name" => __('Fill your twitter username','framework'),
					"desc" => __('Only fill you twitter username not the entire url','framework'),
					"id" => "u_twitter",
					"std" => "",
					"fold" => "twitter",
					"type" => "text");					
					
$of_options[] = array( "name" => __('Enable Pinterest icon','framework'),
					"desc" => __('Check this box to enable pinterest icon in the header','framework'),
					"id" => "pin",
					"std" => 0,
					"folds" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => __('Your Pinterest username','framework'),
					"desc" => __('Only fill you pinterest username not the entire url','framework'),
					"id" => "u_pin",
					"std" => "",
					"fold" => "pin",
					"type" => "text");	
					
$of_options[] = array( "name" => __('Enable Facebook icon','framework'),
					"desc" => __('Check this box to enable facebook icon in the header','framework'),
					"id" => "facebook",
					"std" => 0,
					"folds" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => __('Fill your facebook url','framework'),
					"desc" => __('Fill your facebook profile or fanpage url here','framework'),
					"id" => "u_facebook",
					"std" => "",
					"fold" => "facebook",
					"type" => "text");	

$of_options[] = array( "name" => __('Enable LinkedIn icon','framework'),
					"desc" => __('Check this box to enable LinkedIn icon in the header','framework'),
					"id" => "linked",
					"std" => 0,
					"folds" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => __('Fill your LinkedIn url','framework'),
					"desc" => __('Fill your linked profile url here','framework'),
					"id" => "u_linked",
					"std" => "",
					"fold" => "linked",
					"type" => "text");	

$of_options[] = array( "name" => __('Enable RSS icon','framework'),
					"desc" => __('Check this box to enable RSS icon in the header','framework'),
					"id" => "rss",
					"std" => 0,
					"folds" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => __('Your RSS url','framework'),
					"desc" => __('Fill your RSS feed url here','framework'),
					"id" => "u_rss",
					"std" => "",
					"fold" => "rss",
					"type" => "text");	

                       
    
$of_options[] = array( "name" => "Homepage settings",
					"type" => "heading");
				
$of_options[] = array( "name" =>  "Enable slider",
					"desc" => "Enable slider on homepage to show your posts. Add 'slider-home' tag to your post to display any post inside",
					"id" => "slider",
					"std" => 0,
					"folds" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" =>  "Enter slider tag",
					"desc" => "Enter the tag which when attached to any post will show post in the main slider on homepage. Default is 'slider-home')",
					"id" => "slider_tag",
					"std" => 'slider-home',
					"fold" => 'slider',
					"type" => "text");

$of_options[] = array( "name" => "Section 1!",
					"desc" => "",
					"id" => "section_one",
					"std" => "<h3 style=\"margin: 0 0 10px;\">Options for Post section One</h3>
					These are the options for post section one i.e section right below slider",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( "name" => __('Enable Section one','framework'),
					"desc" => __('This is the posts section below slider. Check the box to enable it','framework'),
					"id" => "section_1",
					"std" => 0,
					"folds" => 1,
					"type" => "checkbox");
					
$of_options[] = array( "name" => __('Enable slider in section one','framework'),
					"desc" => __('Check this box to enable slider option in section one else posts will be shown traditionally','framework'),
					"id" => "s_section_1",
					"std" => 0,
					"folds" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => __('Number of posts','framework'),
					"desc" => __('Enter number of posts to show for this section.Should be greater than 4','framework'),
					"id" => "s1_post_no",
					"std" => 9,
					"fold" => "section_1",
					"type" => "text");	

$of_options[] = array( "name" => __('Section Category','framework'),
					"desc" => __('Select the catergory of section for which you want the posts to be shown','framework'),
					"id" => "s1_cat",
					"std" => "",
					"fold" => "section_1",
					"type" => "select",
					"options" => $of_categories);	


$of_options[] = array( "name" => "Section 2!",
					"desc" => "",
					"id" => "section_two",
					"std" => "<h3 style=\"margin: 0 0 10px;\">Options for Post section Two</h3>
					These are the options for post section two i.e section right below section one",
					"icon" => true,
					"type" => "info");

$of_options[] = array( "name" => __('Enable Section two','framework'),
					"desc" => __('This is the posts section below section one or the last section on homepage. Check the box to enable it','framework'),
					"id" => "section_2",
					"std" => 0,
					"folds" => 1,
					"type" => "checkbox");
					
$of_options[] = array( "name" => __('Enable slider in section two','framework'),
					"desc" => __('Check this box to enable slider option in section two else posts will be shown traditionally','framework'),
					"id" => "s_section_2",
					"std" => 0,
					"folds" => 1,
					"type" => "checkbox");
					
$of_options[] = array( "name" => __('Number of posts','framework'),
					"desc" => __('Enter number of posts to show for this section.Should be greater than 4','framework'),
					"id" => "s2_post_no",
					"std" => 8,
					"fold" => "section_2",
					"type" => "text");	

$of_options[] = array( "name" => __('Section Category','framework'),
					"desc" => __('Select the catergory of section for which you want the posts to be shown','framework'),
					"id" => "s2_cat",
					"std" => "",
					"fold" => "section_2",
					"type" => "select",
					"options" => $of_categories);	


$of_options[] = array( "name" => "Post Settings",
					"type" => "heading"); 	

$of_options[] = array( "name" => __('Enable Related posts','framework'),
					"desc" => __('Enable Related posts to be shown under the post on post page','framework'),
					"id" => "related_posts",
					"std" => 0,
					"folds" => 1,
					"type" => "checkbox");


$of_options[] = array( "name" => "Social buttons",
					"desc" => "Using the block below enable social buttons shown on post single pages",
					"id" => "social_links",
					"std" => $social_buttons,
					"type" => "sorter");

$of_options[] = array(	"name" => __("No. of Related Posts", 'framework'),
					"desc" => __("Enter the number of related posts you wish to display", 'framework'),
					"id" => "related_posts_number",
					"std" => "4",
					"fold" => "related_posts",
					"type" => "text");
					
$of_options[] =	array(	"name" => __("Related Post Type", 'framework'),
					"desc" => __("Would you like to relate posts by tag or category?", 'framework'),
					"id" => "related_posts_type",
					"std" => "tags",
					"fold" => "related_posts",
					"options" => array('tags', 'categories'),
					"type" => "select");
					

$of_options[] = array( "name" => __('Enable Author\'s Bio','framework'),
					"desc" => __('Enable author\'s bio to be shown under the post on post page','framework'),
					"id" => "author_bio",
					"std" => 0,
					"type" => "checkbox");


$of_options[] = array( "name" => "Style Options",
					"type" => "heading"); 	

$of_options[] = array( "name" =>  __('Primary Theme Color','framework'),
					"desc" => "Please slect primary color for your theme. For example in theme's demo it was maroon or #C14545.",
					"id" => "primary_color",
					"std" => "#C14545",
					"type" => "color"); 
					
$of_options[] = array( "name" => "Body Color",
					"desc" => " Will only work if custom bacckground option is empty and default bachground options is selected 'NONE'",
					"id" => "body_color",
					"std" => "#6E8091",
					"type" => "color");

$url = get_template_directory_uri() . '/images/bg/';
$of_options[] = array( "name" =>  __('Select Theme Background','framework'),
					"desc" => "These are some default background options that come along with this theme.Will only work if custom bacckground option is empty",
					"id" => "body_bg",
					"std" => "bg1",
					"type" => "images",
					"options" => array(
						'bg0' => $url . 'bg0.png',
						'bg1' => $url . 'bg1.jpg',
						'bg2' => $url . 'bg2.jpg',
						'bg3' => $url . 'bg3.jpg',
						'bg4' => $url . 'bg4.jpg',
						'bg5' => $url . 'bg5.jpg',
						'bg6' => $url . 'bg6.jpg'));

$of_options[] = array( "name" => __('Custom Background','framework'),
					"desc" => __('Upload your own custom background','framework'),
					"id" => "custom_bg",
					"std" => "",
					"type" => "upload");
					
$of_options[] = array( "name" => "Background Image properties",
					"desc" => "Select how you want the background to show up on your website",
					"id" => "bg_type",
					"std" => "",
					"type" => "radio",
					"options" => $of_options_radio);

$of_options[] = array( "name" => "Background Scrolling",
					"desc" => "Select how you want the background to show up on your website",
					"id" => "bg_scroll",
					"std" => "two",
					"type" => "radio",
					"options" => $of_options_radio_1);					
  
$of_options[] = array( "name" =>  __('Custom CSS','framework'),
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => "custom_css",
                    "std" => "",
                    "type" => "textarea");					



$of_options[] = array( "name" => "Contact Page Settings",
					"type" => "heading");


$of_options[] = array( "name" => "Google Map embed code",
                    "desc" => "Insert the map code here to show it above the contact form on contact page. Remember to make width of map 670px exact or less.",
                    "id" => "embed_map",
                    "std" => "",
                    "type" => "textarea");	
									
$of_options[] = array( "name" => "Company Name",
                    "desc" => "Insert your company name that will appear on the contact page",
                    "id" => "company_name",
                    "std" => "",
                    "type" => "text");
					
$of_options[] = array( "name" => "Address",
                    "desc" => "Insert your address information. This will be shown on your contact page. Use enter for newlines",
                    "id" => "contact_address",
                    "std" => "",
                    "type" => "textarea");

$of_options[] = array( "name" => "Contact info",
                    "desc" => "Insert your Contact information. This will be shown on your contact page. Use enter for newlines",
                    "id" => "contact_email",
                    "std" => "",
                    "type" => "textarea");

$of_options[] = array( "name" => "Contact form title",
                    "desc" => "Insert the title that will appear above your contact form",
                    "id" => "form_title",
                    "std" => "",
                    "type" => "text");
					
// Backup Options
$of_options[] = array( "name" => "Backup Options",
					"type" => "heading");
					
$of_options[] = array( "name" => "Backup and Restore Options",
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
					);
					
$of_options[] = array( "name" => "Transfer Theme Options Data",
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
					);
					
	}
}
?>
