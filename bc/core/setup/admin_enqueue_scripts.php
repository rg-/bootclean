<?php

add_action( 'admin_enqueue_scripts', 'WPBC_enqueue_admin_styles' ); 

if( !function_exists('WPBC_enqueue_admin_styles') ){
	function WPBC_enqueue_admin_styles(){ 
		wp_enqueue_style( 'bootclean-root', MAIN_THEME_URI . '/css/root.css', array(),  '1'); 
		wp_enqueue_style( 'bootclean-admin', get_template_directory_uri() . '/bc/core/assets/css/wp-admin.css', array(),  '1'); 
	}
}
