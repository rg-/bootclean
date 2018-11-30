<?php
/**
 * Bootclean setup theme
 *
 * @package bootclean
 * @subpackage setup
 */

add_action( 'after_setup_theme', 'bootclean_setup' );

include('setup/widgets_init.php');

if ( ! function_exists ( 'bootclean_setup' ) ) {
	
	function bootclean_setup() {
		
		global $pagenow; 
		
		include('setup/load_theme_textdomain.php');
		include('setup/register_nav_menus.php'); 
		include('setup/admin_enqueue_scripts.php'); 
		
		
		$WPBC_image_sizes = array(

			"large_size_h" => 1024,
			"large_size_w" => 1024,

			"medium_size_w" => 300,
			"medium_size_h" => 300,

			"medium_large_size_w" => 768,
			"medium_large_size_h" => 0,

			"thumbnail_crop" => 1,
			"thumbnail_size_h" => 150,
			"thumbnail_size_w" => 150,

		);
		
	}
	
}





