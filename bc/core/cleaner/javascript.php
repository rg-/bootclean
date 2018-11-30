<?php

/*
 
	Filters used:

	BC_cleaner__javascript__deregister_jquery 
	BC_cleaner__javascript__remove_oembed
	
*/

/**
* De-registers WordPress default javascript
* @link https://codex.wordpress.org/Function_Reference/wp_deregister_script
*/

if( apply_filters('BC_cleaner__javascript__deregister_jquery', '__return_true') ){ 
	$bc_enqueue_hook = null; 
	if ( is_admin() ) { 
	// $hook = 'admin_enqueue_scripts'; 
	} elseif ( 'wp-login.php' === $GLOBALS['pagenow'] ) {
		$bc_enqueue_hook = 'login_enqueue_scripts';
	} else {
		$bc_enqueue_hook = 'wp_enqueue_scripts';
	}
	add_action( $bc_enqueue_hook, function() {   
		wp_deregister_script( 'jquery' ); 
	} ); 
}


/**
 * Remove oEmbed-specific JavaScript from the front-end and back-end.
 */
if( apply_filters('BC_cleaner__javascript__remove_oembed', '__return_true') ){
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}
