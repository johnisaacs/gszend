<?php 
	header("Content-type: text/css",true); 
	global $data;
?>

<?php 
	if (isset ($_GET['color'])){
		$primary_color = $_GET['color']; 
	}
?>

a:hover,.item .details .post-meta .date,.item .details .post-meta a,#sidebar .item .details .post-meta a, .hentry .post-meta a, .hentry .post-meta .date,.cat-title h2,#related-posts .main-title h2,#sidebar .widget .widget-title,#sidebar a:hover,#sidebar .popular-post-thumb .details h4 a:hover,#sidebar .tweet_widget ul li span a,.single-post .hentry #author h4.heading,#comments h3, #respond h3,.page-template-template-contact-php h3,.contact_details a,.archive-lists .month_archive .title,.archive-lists .month_archive ul li span.date,.archive-lists .month_archive ul li span.category,.archive-lists .month_archive ul li span a,.archive-lists .month_archive ul li a:hover.title{ 
	color:#<?php echo $primary_color ?>;
}
#footer_bottom .top_scroll a:hover,#primary-nav,#mobile-nav,.item .details .more_link a,.tag_list li:hover a,.wp-pagenavi a:hover, .wp-pagenavi span.current,.single-post .hentry #author .details p.meta a:hover,#respond .form-submit input, #contactForm li.buttons button ,.tipsy-inner {
  background-color: #<?php echo $primary_color ?>;
}
.tipsy-arrow{
	border: 5px dashed #<?php echo $primary_color ?>;
}
/* Rules to colour arrows */
.tipsy-arrow-n { border-bottom-color: #<?php echo $primary_color ?>; }
.tipsy-arrow-s { border-top-color: #<?php echo $primary_color ?>; }
.tipsy-arrow-e { border-left-color: #<?php echo $primary_color ?>; }
.tipsy-arrow-w { border-right-color: #<?php echo $primary_color ?>; }
.tag_list li:hover .triangle {
    border-right: 10px solid #<?php echo $primary_color ?>;
}