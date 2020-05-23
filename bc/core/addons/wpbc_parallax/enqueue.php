<?php 
/*
	
	Enqueue js 

*/
add_action( 'wp_enqueue_scripts', 'WPBC_parallax_enqueue_scripts', 20 );
function WPBC_parallax_enqueue_scripts(){
	if(WPBC_is_parallax_enabled()){  
		wp_register_script( 'wpbc-parallax', THEME_URI .'/bc/core/addons/wpbc_parallax/assets/parallax.min.js', array(), null, true);
		wp_enqueue_script( 'wpbc-parallax' );
	}
}

add_action('wp_head', 'WPBC_parallax_wp_head', 99);
function WPBC_parallax_wp_head(){
	if( WPBC_is_parallax_enabled() ){
		include('enqueue-head-script.php');
	}
}

add_action('wp_footer', 'WPBC_parallax_wp_footer', 99);
function WPBC_parallax_wp_footer(){
	if( WPBC_is_parallax_enabled() ){
		include('enqueue-footer-script.php');
	}
}