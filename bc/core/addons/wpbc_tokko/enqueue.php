<?php


add_action( 'wp_enqueue_scripts', 'wpbc_tokko_enqueue_scripts', 998 ); 
function wpbc_tokko_enqueue_scripts(){

	$js_path = get_stylesheet_directory_uri() . '/functions/addon-tokkobroker/js/wpbc-tokko.js';
	/*
	wp_enqueue_script(
		'wpbc-tokko',
		$js_path,
		array( 'jquery' ),
		'1.0',
		true ); 
	*/ 
} 


add_action('wp_footer', 'WPBC_tokko_wp_footer', 99);
function WPBC_tokko_wp_footer(){
	if( WPBC_is_tokko_enabled() && WPBC_use_tokko_js() ){
		include('enqueue/footer-script.php');
	}
}