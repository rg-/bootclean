<?php

// Ex: /wp-admin/admin-ajax.php?action=get_query_post&id=21&part=content-single

function WPBC_ajax_get_query_post(){ 

	$query_string = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
	$parsed_query_string = wp_parse_args( $query_string, array() );
	$action = !empty($parsed_query_string['action']) ? $parsed_query_string['action'] : 'get_query_post';
		unset($parsed_query_string['action']); 
	$atts = '';
	foreach($parsed_query_string as $k=>$v){
		$atts .= " ".$k."='".$v."' ";
	} 
	
	if(!empty($parsed_query_string['id'])) {
		echo do_shortcode('[WPBC_get_query_post '.$atts.' /]'); 
	}
	
	die(); 
}

add_action('wp_ajax_get_query_post', 'WPBC_ajax_get_query_post');
add_action('wp_ajax_nopriv_get_query_post', 'WPBC_ajax_get_query_post');

function WPBC_get_query_post_FX($atts, $content = null){
	
	$out = '';
	$atts = wp_parse_args($atts, array(
		'id' => false,
		'part' => 'content-single',
		'tax' => '',
		'meta' => '',
	));
	extract($atts);   
	
	$query = array(
		'p' => $id,
	);

	$query_post = new WP_Query( $query ); 

	ob_start(); 
	if( $query_post->have_posts() ){ 
		$query_post->the_post();
		$inc = WPBC_include_template_part($part); 
		if(!empty($inc)){  
			include ($inc);  
		} 
	}
	$out = ob_get_contents();
	ob_end_clean();
	
	return apply_filters('wpbc/filter/WPBC_get_post/out', $out); 
}
add_shortcode('WPBC_get_query_post', 'WPBC_get_query_post_FX');