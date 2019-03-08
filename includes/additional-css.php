<?php 

	$dir = get_template_directory_uri();   
	global $data; //fetch options stored in $data;
?>

	<?php if(is_page_template('template-archives.php')) : ?>
    	<link rel="stylesheet" href="<?php echo $dir; ?>/css/archives.css" type="text/css" media="screen" />
    <?php endif; ?>

	<?php if(is_page_template('template-contact.php')) : ?>
    	<link rel="stylesheet" href="<?php echo $dir; ?>/css/contact.css" type="text/css" media="screen" />
    <?php endif; ?>
    
	<?php if (is_single() || is_page()): ?>
        <link rel="stylesheet" href="<?php echo $dir; ?>/css/not-home.css" type="text/css" media="screen" />
        
    <?php endif; ?>
	
    <!--[if IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo $dir; ?>/css/ie8.css" />
    <![endif]-->