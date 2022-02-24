<?php

function WPBC_tokko_is_icons_enabled(){
	$enabled = apply_filters('wpbc/filter/tokko/icons/enable', true);
	return $enabled;
} 

function WPBC_tokko_get_icon_prefix(){
	$prefix = apply_filters('wpbc/filter/tokko/icons/prefix', 'wptk');
	return $prefix;
} 

add_action( 'wp_enqueue_scripts', 'wpbc_tokko_enqueue_scripts', 998 ); 
function wpbc_tokko_enqueue_scripts(){
	/*
	$js_path = get_stylesheet_directory_uri() . '/functions/addon-tokkobroker/js/wpbc-tokko.js';
	
	wp_enqueue_script(
		'wpbc-tokko',
		$js_path,
		array( 'jquery' ),
		'1.0',
		true ); 
	*/ 
	if(WPBC_tokko_is_icons_enabled()){

		$tokko_icon_style = array(
			'wpbc-tokko-icons', 
			THEME_URI . '/bc/core/addons/wpbc_tokko/assets/wpbc_tokko_icons.css', 
			array(), 
			__scripts_version() 
		);
		wp_register_style( $tokko_icon_style[0], $tokko_icon_style[1], $tokko_icon_style[2], $tokko_icon_style[3] ); 
		wp_enqueue_style( $tokko_icon_style[0] ); 

	}
} 


add_action('wp_footer', 'WPBC_tokko_wp_footer', 99);
function WPBC_tokko_wp_footer(){
	if( WPBC_is_tokko_enabled() && WPBC_use_tokko_js() ){
		include('enqueue/footer-script.php');
	}
}

add_action('wp_header', 'WPBC_tokko_wp_header', 99);
function WPBC_tokko_wp_header(){
	if( WPBC_is_tokko_enabled() && WPBC_use_tokko_js() ){
		include('enqueue/header-script.php');
	}
}