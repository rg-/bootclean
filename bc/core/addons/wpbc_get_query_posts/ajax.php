<?php

/*
	
	WPBC_ajax_get_query_posts
	
	@hookeable child theme function

	Ajax call, like: 

	/wp-admin/admin-ajax.php/?action=get_query_posts&posts_per_page=3

	Any query paramenter will be passed into "query_string" shortcode atts.

	Shortcode "WPBC_get_query_posts" will take any parameter.

*/
if( !function_exists('WPBC_ajax_get_query_posts') ){

	function WPBC_ajax_get_query_posts(){ 
		if(empty($_GET['action'])) wp_die();
		$query_string = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
		$parsed_query_string = wp_parse_args( $query_string, array() );
		$action = !empty($parsed_query_string['action']) ? $parsed_query_string['action'] : 'get_query_posts';
		unset($parsed_query_string['action']); 
		$parsed_query_string = http_build_query($parsed_query_string, '', '&');
		echo do_shortcode('[WPBC_get_query_posts action="'.$action.'" query_string="'.$parsed_query_string.'"/]'); 
		wp_die();
	}
	add_action('wp_ajax_get_query_posts', 'WPBC_ajax_get_query_posts');
	add_action('wp_ajax_nopriv_get_query_posts', 'WPBC_ajax_get_query_posts');

}
if( !function_exists('WPBC_ajax_get_query_form') ){

/*

	URL example:

	/wp-admin/admin-ajax.php?posts_per_page=4&paged=1&post_type=property&target_id=property&form_id=property-home-form&use_map=&p_search=casa&property_price_min=0&property_price_max=240000&p_order=DESC&p_orderby=date&property_location=punta-del-este&property_operation=&property_type=&action=get_query_form&use_as_search=1

*/

	function WPBC_ajax_get_query_form(){

		$query_string = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : ''; 
		$parsed_query_string = wp_parse_args( $query_string, array() );

		$action = !empty($parsed_query_string['action']) ? $parsed_query_string['action'] : 'get_query_posts';
		unset($parsed_query_string['action']);

		$use_as_search = !empty($parsed_query_string['use_as_search']) ? $parsed_query_string['use_as_search'] : '0';
		unset($parsed_query_string['use_as_search']);

		$target_id = !empty($parsed_query_string['target_id']) ? $parsed_query_string['target_id'] : '';
		unset($parsed_query_string['target_id']);

		$target_post_id = !empty($parsed_query_string['target_post_id']) ? $parsed_query_string['target_post_id'] : '';
		unset($parsed_query_string['target_post_id']);

		$form_id = !empty($parsed_query_string['form_id']) ? $parsed_query_string['form_id'] : '';
		unset($parsed_query_string['form_id']);

		$parsed_query_string = http_build_query($parsed_query_string, '', '&'); 

		echo do_shortcode('[WPBC_get_query_form target_id="'.$target_id.'" target_post_id="'.$target_post_id.'" use_as_search="'. $use_as_search .'" action="'.$action.'" query_string="'.$parsed_query_string.'" form_id="'.$form_id.'"/]');   
		wp_die();
	}
	add_action('wp_ajax_get_query_form', 'WPBC_ajax_get_query_form');
	add_action('wp_ajax_nopriv_get_query_form', 'WPBC_ajax_get_query_form');

}

if( !function_exists('WPBC_ajax_get_query_form_string') ){

	/*

	get_query_form_string ajax call

	*/

	function WPBC_ajax_get_query_form_string(){
		
		$POST_ID = !empty($_GET['ID']) ? $_GET['ID'] : 0;
		if(!empty($POST_ID)){

			$POST_PERMALINK = get_permalink($POST_ID);

			echo $POST_PERMALINK; 
		}
   
		wp_die();
	}
	//add_action('wp_ajax_get_query_form_string', 'WPBC_ajax_get_query_form_string');
	//add_action('wp_ajax_nopriv_get_query_form_string', 'WPBC_ajax_get_query_form_string');

}