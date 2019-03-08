<?php 
	header("Content-type: text/css",true); 
?>

<?php		
	ob_start("compress");
	function compress($buffer) {
	  /* remove comments */
	  $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	  /* remove tabs, spaces, newlines, etc. */
	  $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	  return $buffer;
	}
	  
	/* css files */
	include('style.css');
	include('css/1140.css');
	include('css/flexslider.css');
	include('css/tipsy.css');
	
	ob_end_flush();

?>