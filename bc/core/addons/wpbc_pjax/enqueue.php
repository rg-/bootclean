<?php

/*
	
	Enqueue css

*/
add_filter('wp_enqueue_scripts', 'WPBC_pjax_enqueue_css'); 
function WPBC_pjax_enqueue_css(){ 
	if(WPBC_is_pjax_enabled()){  
		wp_register_style( 'wpbc-pjax', THEME_URI . '/bc/core/addons/wpbc_pjax/assets/wpbc_pjax.css', array(), __scripts_version() ); 
		wp_enqueue_style( 'wpbc-pjax' ); 
	} 
} 

/*
	
	Enqueue js

*/
add_action( 'wp_enqueue_scripts', 'WPBC_pjax_enqueue_scripts', 20 );
function WPBC_pjax_enqueue_scripts(){
	if(WPBC_is_pjax_enabled()){
		wp_register_script( 'wpbc-pjax', THEME_URI .'/bc/core/addons/wpbc_pjax/assets/pjax.js', array('jquery'), null, true);
		wp_enqueue_script( 'wpbc-pjax' );
	}
}


add_action('wp_footer', 'WPBC_pjax_wp_footer', 99);
function WPBC_pjax_wp_footer(){
	if( WPBC_is_pjax_enabled() ){
		include('enqueue-footer-script.php');
	}
}