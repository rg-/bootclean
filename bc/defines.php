<?php


/**
 * THEME_URI
 * default theme base directory
 * use only one
 */
/**
 * uri to PARENT
 */
 
define('THEME_URI', get_template_directory_uri() ); 

/**
 * uri to CHILD
 */ 
// define('THEME_URI', get_stylesheet_directory_uri() ); 

define('THEME_URI_PARENT', get_template_directory_uri() ); // uri to PARENT
define('CHILD_THEME_URI', get_stylesheet_directory_uri() ); // uri to CHILD template

define('PARENT_PATH', get_template_directory() );
define('CHILD_PATH', get_stylesheet_directory() );

if(!is_child_theme()){ 
	define('USING_CHILD', false ); 
	define('MAIN_THEME_URI', THEME_URI_PARENT );   
	define('MAIN_THEME_PATH', PARENT_PATH );   
}else{ 
	define('USING_CHILD', true );
	define('MAIN_THEME_URI', CHILD_THEME_URI );  
	define('MAIN_THEME_PATH', CHILD_PATH );   
} 

define('BLOG_URI', esc_url( home_url() ) ); 
define('IMG_URI', THEME_URI.'/images' ); // ??


