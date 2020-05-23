<?php

/*
	
	Enqueue js

	https://unpkg.com/swup@2.0.9/dist/swup.min.js

*/
add_action( 'wp_enqueue_scripts', 'WPBC_swup_enqueue_scripts', 20 );
function WPBC_swup_enqueue_scripts(){
	if(WPBC_is_swup_enabled()){
		
		wp_register_script( 'wpbc-SwupFadeTheme', THEME_URI .'/bc/core/addons/wpbc_swup/assets/SwupFadeTheme.min.js', array(), null, true);
		wp_enqueue_script( 'wpbc-SwupFadeTheme' );
		
		wp_register_script( 'wpbc-SwupSlideTheme', THEME_URI .'/bc/core/addons/wpbc_swup/assets/SwupSlideTheme.min.js', array(), null, true);
		wp_enqueue_script( 'wpbc-SwupSlideTheme' );

		wp_register_script( 'wpbc-SwupOverlayTheme', THEME_URI .'/bc/core/addons/wpbc_swup/assets/SwupOverlayTheme.min.js', array(), null, true);
		wp_enqueue_script( 'wpbc-SwupOverlayTheme' );

		wp_register_script( 'wpbc-SwupGaPlugin', THEME_URI .'/bc/core/addons/wpbc_swup/assets/SwupGaPlugin.min.js', array(), null, true);
		wp_enqueue_script( 'wpbc-SwupGaPlugin' );

		wp_register_script( 'wpbc-swup', THEME_URI .'/bc/core/addons/wpbc_swup/assets/swup.min.js', array(), null, true);
		wp_enqueue_script( 'wpbc-swup' );
	}
}

add_action('wp_head', 'WPBC_swup_wp_head', 99);
function WPBC_swup_wp_head(){
	if( WPBC_is_swup_enabled() && WPBC_use_swup_css() ){
		include('enqueue-head-script.php');
	}
}

add_action('wp_footer', 'WPBC_swup_wp_footer', 99);
function WPBC_swup_wp_footer(){
	if( WPBC_is_swup_enabled() && WPBC_use_swup_js() ){
		include('enqueue-footer-script.php');
	}
}