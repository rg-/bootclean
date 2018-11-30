<?php 
	if ( ! defined( 'BC_ABSPATH' ) ) {
		define( 'BC_ABSPATH', dirname( __FILE__ ) . '/' );
	} 
	
	if ( ! defined( 'BC_URI' ) ) {
		define( 'BC_URI', THEME_URI . '/bc/' );
	} 
	// Load theme-settings.json data if exists, see at the end how data will be merged into theme_root if used.
	 
	global $theme;
	global $theme_root;  
	global $theme_customs;
	
	// nobody can live without functions :) !!
	require "functions.php";
	
	// Default BC framework variables || NOT WP
	require "variables.php"; 
	
	// Process settings for global arguments || NOT WP
	require "settings.php";	
	
?>