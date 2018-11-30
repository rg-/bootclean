<?php

/*

 USE OR NOT THIS FOR CHILD THEMES??
 
 HAS SCENCE??? WHAT ABOUT bc/theme-settings.php already used as default values???
 Sould i filter into that??
 
 TODOOOOOOO

*/

/*

	When using child themes, each theme could have diferent database prefixes to keep diferent settings saved.
	Above the filter of_options could be used to set new options into child theme that do not exist on parent one.
	 
*/ 

/*

add_filter('BC_theme_options_option_name', function(){
	return 'child-theme-options';
});

*/

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'theme-textdomain'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

/*
add_filter( 'of_options', function( $options ) {
	$options[] = array(
		'name' => 'Input Text Mini 2',
		'desc' => 'A mini text input field 2.',
		'id' => 'example_text_mini_2',
		'std' => 'Default 2',
		'class' => 'mini',
		'type' => 'text'
	); 
	return $options;
});
*/