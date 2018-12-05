<?php

// TO REMOVE
 
// TODO, leave this for WP, use something else DONE!

// TODO, make a filter for wp to handle this things... we have already a function to do that, check it!
	
$theme_customs['html-lang'] = 'es'; // not used in WP
// Do not use title/desc from WP, just by "hand"
	// $theme_customs['html-seo'] = true; 
	// if $theme_customs['html-seo'] then...
	$theme_customs['site-title'] = get_bloginfo('name'); 
	$theme_customs['site-url'] = get_bloginfo('url'); 
	
	// this ones on WP ?? TODO
	$theme_customs['globals']['brand']['logo']['src'] = THEME_URI.'/images/theme/bootclean-logo-color-@2.png';
	$theme_customs['globals']['brand']['logo-alt']['src'] = THEME_URI.'/images/theme/bootclean-logo-color-alt-@2.png';
	$theme_customs['globals']['brand']['logo']['alt'] = 'Bootclean';

$theme_customs['wp']['login']['logo']['src'] = THEME_URI.'/images/theme/bootclean-iso-color-@2.png';
$theme_customs['wp']['login']['logo']['width'] = '136';
$theme_customs['wp']['login']['logo']['height'] = '152';
	
	//$theme_customs['wp']['login']['body-background-color'] = '#000';
	/*
	$theme_customs['wp']['login']['body-text-color'] = 'yellow';
	$theme_customs['wp']['login']['body-text-color-hover'] = 'green'; 
	$theme_customs['wp']['login']['form-background'] = 'blue';
	$theme_customs['wp']['login']['form-color'] = 'orange'; 
	$theme_customs['wp']['login']['button-background'] = 'orange';
	$theme_customs['wp']['login']['button-border-color'] = 'orange';
	$theme_customs['wp']['login']['button-color'] = 'orange'; 
	$theme_customs['wp']['login']['button-background-hover'] = 'orange';
	$theme_customs['wp']['login']['button-border-color-hover'] = 'orange';
	$theme_customs['wp']['login']['button-color-hover'] = 'orange';
	*/ 
	 

?>