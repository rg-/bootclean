<?php

add_action( 'wp_enqueue_scripts', 'wpbc_realstate__enqueue_scripts', 998 ); 
function wpbc_realstate__enqueue_scripts(){  
	 wp_enqueue_script(
		'wpbc-realstate',
		WPBC_PROPERTY_URI . '/wpbc_realstate.js',
		array( 'jquery' ),
		'1.0',
		true );

	$key = WPBC_google_api_key();
	if( !WPBC_ACF_FORM() ){
		
	}
	wp_enqueue_script(
		'wpbc-google-map',
		'https://maps.googleapis.com/maps/api/js?key='.$key.'',
		array( 'jquery' ),
		'1.0',
		true );

	wp_enqueue_script(
		'wpbc-realstate-maps',
		WPBC_PROPERTY_URI . '/wpbc_realstate_maps.js',
		array( 'jquery' ),
		'1.0',
		true );   
}  

function WPBC_realstate_add_inline_style(){ 
	$css = '<style>';
	$css .= '.form_fields .form-control{padding:5px!important;font-size:10px!important;height:20px!important;}'; 
	$css .= '</style>';
	echo $css;
} 
add_action( 'wp_head', 'WPBC_realstate_add_inline_style', 998 );  