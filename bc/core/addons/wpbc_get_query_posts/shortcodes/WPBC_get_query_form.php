<?php

/*

	WPBC_get_query_form

	Like: 

	[WPBC_get_query_form $ARGS /]

	When $ARGS are anything :)

*/

add_shortcode('WPBC_get_query_form', 'WPBC_get_query_form_FX'); 

function WPBC_get_query_form_FX( $atts, $content = null) {

	$shortcode_args = wp_parse_args( $atts, array() ); 

	// If no action passed, default here. This must be not changed, but just in case, use "action" param.
	if(empty($shortcode_args['action'])){
		$shortcode_args['action'] = 'get_query_posts';
	} 

	$default_target_id = WPBC_get_query_posts_default_target_id();
	
	if(empty($shortcode_args['target_id'])){
		$shortcode_args['target_id'] = $default_target_id;
	}  

	// The main query from shortcode args
	$form_query = html_entity_decode( $shortcode_args['query_string'] );
	$form_query = wp_parse_args( $form_query, array() ); 
	
	//$_post_type = !empty($form_query['post_type']) ? $form_query['post_type'] : 'post';
	//$shortcode_args['target_id'] = $shortcode_args['target_id'].'-'.$_post_type;
	//$shortcode_args['target_nav_id'] = $shortcode_args['target_id'].'-nav'.'-'.$_post_type;

	ob_start(); 

	$use_as_search = '';
	if( !empty($shortcode_args['use_as_search']) ){ 
		$use_as_search = do_shortcode('[WPBC_get_query_posts target_post_id="'.$shortcode_args['target_post_id'].'" target_id="'.$shortcode_args['target_id'].'" use_as_search="1" query_string="'. $shortcode_args['query_string'] .'"/]');
		$template_args['use_as_search'] = $shortcode_args['use_as_search'];
	}  

	$template_args = array(
		'target_id' => $shortcode_args['target_id'],
		'action' => $shortcode_args['action'],
		'form_id' => !empty($shortcode_args['form_id']) ? $shortcode_args['form_id'] : '',
	); 

	$template_args['target_nav_id'] = $template_args['target_id'].'-nav';

	global $WPBC_get_query_posts;

	$query = $WPBC_get_query_posts[$template_args['target_id']]['query']; 
	if(!empty($query['action'])=='get_query_form')  {
		$query['action']='get_query_posts';
	}
	//print_r($WPBC_get_query_posts);
	$query_fields = WPBC_get_query_form_default_query_fields( $template_args, $query); 

	if(!empty($shortcode_args['target_post_id'])){
		$query_fields = array();
	}

	$query_fields[] = array( 
		'name'=> 'target_id',
		'value' => $template_args['target_id'],
	); 

	$query_fields[] = array( 
		'name'=> 'use_map',
		'value' => !empty($template_args['use_map']) ? $template_args['use_map'] : '',
	); 
	
	if(!empty( $form_query['debug'] )){
		$query_fields[] = array( 
			'name'=> 'debug',
			'value' => '1',
		);
	} 
	
	$form_elements = WPBC_get_query_form_default_form_elements( $template_args, $query);
	
	$inc = WPBC_include_template_part('wpbc_get_query_posts/get_query_form'); 
		if(!empty($inc)){  
			include ($inc);
		} 

	if( !empty($use_as_search) ){
		echo $use_as_search; 
	}

	$out = ob_get_contents();
	ob_end_clean(); 
	return $out;
}