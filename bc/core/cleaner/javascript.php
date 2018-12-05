<?php

/*
 
	Filters used:

	wpbc/filter/cleaner/javascript/deregister_jquery
	
	wpbc/filter/cleaner/javascript/remove_oembed

	wpbc/filter/cleaner/javascript/remove_query_string

	wpbc/filter/cleaner/javascript/add_defer_tag

	wpbc/filter/cleaner/javascript/remove_type_tag
	
*/

$remove_type_tag = apply_filters('wpbc/filter/cleaner/javascript/remove_type_tag', 0);
if( !empty($remove_type_tag) ){
	add_filter('script_loader_tag', 'bc_script_tag_type',10,2);
	function bc_script_tag_type($tag, $handle) {
		if (is_admin()){
			return $tag;
		}else{
			return str_replace(" type='text/javascript'","", $tag);
		}

	}
}

$add_defer_tag = apply_filters('wpbc/filter/cleaner/javascript/add_defer_tag', 0);
if( !empty($add_defer_tag) ){ 
	add_filter( 'body_class','parent_bc_enqueue_scripts_body_class' ); 
	function parent_bc_enqueue_scripts_body_class($classes){
		$classes[] = 'scripts-defer';
		return $classes;
	}
	
	add_filter('script_loader_tag', 'bc_script_tag_defer',10,2);
	function bc_script_tag_defer($tag, $handle) {
		if (is_admin()){
			return $tag;
		}
		if (strpos($tag, '/wp-includes/js/jquery/jquery')) {
			return $tag;
		}
		if (strpos($tag, '/plugins/lazysizes')) {
			//return $tag;
			return str_replace(' src',' async src', $tag);
		}
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.') !==false) {
			return $tag;
		}
		else {
			return str_replace(' src',' defer src', $tag);
		}
	}
}

/*

	Remove "?ver" or "&ver" from scripts and styles enqueued

*/
$remove_query_string = apply_filters('wpbc/filter/cleaner/javascript/remove_query_string', 0);
if( !empty($remove_query_string) ){ 

	function WPBC_remove_query_string__ver( $src ){   
		$parts = explode( '?ver', $src ); 
		return $parts[0];
	}

	function WPBC_remove_query_string__ver_2( $src ){   
		$parts = explode( '&ver', $src ); 
		return $parts[0];
	}

	if ( !is_admin() ) {
		add_filter( 'script_loader_src', 'WPBC_remove_query_string__ver', 15, 1 );
		add_filter( 'style_loader_src', 'WPBC_remove_query_string__ver', 15, 1 );
		
		add_filter( 'script_loader_src', 'WPBC_remove_query_string__ver_2', 20, 1 );
		add_filter( 'style_loader_src', 'WPBC_remove_query_string__ver_2', 20, 1 );
	}
}

/**
* De-registers WordPress default javascript
* @link https://codex.wordpress.org/Function_Reference/wp_deregister_script
*/

$deregister_jquery = apply_filters('wpbc/filter/cleaner/javascript/deregister_jquery', 1);
if( !empty($deregister_jquery) ){ 
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
$remove_oembed = apply_filters('wpbc/filter/cleaner/javascript/remove_oembed', 1);
if( !empty($remove_oembed) ){
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}
