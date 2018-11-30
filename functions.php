<?php

/**
 * Bootclean all main functions
 *
 * @package bootclean
 *
 * BC_theme_root() is an important function that takes the main default array of options for the theme.
 * This function is not part of WP theme, is just PHP thing and evrything is under bc/init.php file, take a look, all there.
 *
 */
global $WPBC_VERSION;
$WPBC_VERSION = apply_filters('wpbc/filter/version','9.0.1');
function WPBC_version(){
	global $WPBC_VERSION;
	return $WPBC_VERSION;
}
 
if ( ! defined( 'BC_WP_DIR' ) ) {
	define( 'BC_WP_DIR', get_template_directory() . '/bc/' );
} 
/* All version compare, for wp, plugins, etc, here. */
require BC_WP_DIR . 'version_compare.php';  
/* All define() variables here */
require BC_WP_DIR . 'defines.php'; 
/* This one is shared php functions, arrays, components builders, etc. */
require BC_WP_DIR . 'init.php';  
/* BC Core files */
require BC_WP_DIR . 'core.php'; 

/*
	That´s all here.
*/