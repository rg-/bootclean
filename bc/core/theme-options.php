<?php

/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
 
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */

 
 /*
 
	TODO:
	
		- use this framework to create x number of pages anywhere in admin area.
		- 
 
 */


 
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/bc/core/theme-options/' );

require_once 'theme-options/options-framework.php'; 
 
add_filter( 'optionsframework_menu', function( $menu ) {
	$menu['page_title'] = 'Bootclean Theme Options';
	$menu['menu_title'] = '<span class="show-top">Bootclean</span> <span class="hide-top">Theme Options</span>'; 
	$menu['menu_slug'] = 'bootclean-theme-options'; 
	$menu['mode'] = 'menu_page'; 
	// $menu['parent_slug'] = 'themes.php';
	// $menu['position'] = '61';
	// $menu['capability']
	$menu['icon_url'] = get_template_directory_uri() .'/bc/core/assets/images/bootclean-iso-color-@2.png';
	return $menu;
}); 