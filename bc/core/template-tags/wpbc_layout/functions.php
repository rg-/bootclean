<?php

/**
 * WPBC_layout -> WPBC_layout_functions
 *
 * @package WPBC_layout_functions
 * @subpackage functions
 * @since Bootclean 9.0
 */


/*
	HELPERS FOR LAYOUTS
*/
	
// FOR NAVBAR 
function WPBC_get_navbar_affix_attrs($params=array()){
	$_p = $params;
	$attrs = '';
	if( !empty($_p['affix']) ){
		$attrs .= ' data-toggle="nav-affix" ';
		if(isset($_p['affix_defaults'])){
			$data = $_p['affix_defaults']; 
		}
		//_print_code($data);
		$attrs .= ' data-affix-position="'. $data['position'] .'" '; 
		$attrs .= ' data-affix-simulate="'. ( $data['simulate'] ? 'true' : 'false' ) .'" '; 
		$attrs .= ' data-affix-simulate-target="'. ( $data['simulate_target'] ? $data['simulate_target'] : '' ) .'" '; 
		if($data['simulate_resize']){
			$attrs .= ' data-affix-simulate-resize='.$data['simulate_resize'].' ';
		}

		$attrs .= ' data-affix-scrollify="'. ( $data['scrollify'] ? 'true' : 'false' ) .'" '; 
		$attrs .= ' data-affix-breakpoint="'. $data['breakpoint'] .'" '; 
		
		$attrs .= ' data-affix-target="'. ( !empty($data['target']) ? $data['target'] : '' ) .'" '; 

		$attrs .= ' data-affix-offset="'. ( !empty($data['offset']) ? $data['offset'] : '' ) .'" '; 



		return $attrs;
	}
}


function WPBC_layout__get_id(){
	
	$default = array(
		'blog' 
	);
	$template = WPBC_get_template();
	
	$post_id = '';


	if( in_array($template, $default) ){
		// page_on_front
		$post_id = get_option( 'page_for_posts' );

	}else{
		global $post;
		if(!empty($post)){
			$post_id = $post->ID;
		}
	} 
	return $post_id;
}