<?php

/*

	propiedad query_vars

*/
add_filter('query_vars', 'WPBC_tokko_add_state_var', 99, 1);
function WPBC_tokko_add_state_var($vars){
		$vars[] = 'property_id'; 
		$vars[] = 'property_slug';  
    return $vars;
}

/*

	propiedad custom_rewrite_tag

	Change url used for each property, including slug, ref, etc.

	EX: /property-nice-name/TOKKO_PROPERTY_ID

*/

add_action('init', 'WPBC_tokko_custom_rewrite_tag', 90, 0);

function WPBC_tokko_custom_rewrite_tag(){
	
	$property_id = get_query_var('property_id', null);  
	if(empty($property_id)){
		$property_id = $_GET['property_id'];
	}   

	$single_page = WPBC_get_field('field_wpbc_tokko_post_object_single_property','options'); 
	$pagename = get_post_field( 'post_name', $single_page ); 
	
	add_rewrite_rule('^'.$pagename.'/([^/]+)-([0-9]+)/?$','index.php?pagename='.$pagename.'&property_slug=$matches[1]&property_id=$matches[2]','top');
 
} 

/*

	Redirect when searching by ref like /?property_ref=765564

	Will redirect to something like: /property-nice-name/765564

*/

function WPBC_tokko_template_redirect() {
  if ( isset( $_REQUEST['property_ref'] )  ) {
  		$single_page = WPBC_get_field('field_wpbc_tokko_post_object_single_property','options'); $single_page_url = get_permalink($single_page);

  		$property_ref = $_REQUEST['property_ref'];

  		$api_key = tokko_config('api_key');  
			if(empty($api_key)) return;
			$auth = new TokkoAuth($api_key); 
			if(empty($auth)) return;
			$property = new TokkoProperty('reference_code', $property_ref, $auth);
			if(empty($property)) return; 

			$propiedad_url = $single_page_url.WPBC_get_tokko_rewrite_property_url($property);

      exit( wp_redirect( $propiedad_url ) ) ;
  }
}
add_action( 'template_redirect', 'WPBC_tokko_template_redirect' );



/* SEO */

function WPBC_tokko_custom_title($title_parts) {
		$property_id = get_query_var('property_id', null);  
		if(empty($property_id)){
			$property_id = $_GET['property_id'];
		} 
		if(!empty($property_id)){
			$api_key = tokko_config('api_key');  
			if(empty($api_key)) return;
			$auth = new TokkoAuth($api_key); 
			if(empty($auth)) return;
			$property = new TokkoProperty('id', $property_id, $auth);
			if(empty($property)) return; 

			$address = $property->get_field('address');
	    $title_parts['title'] = $address;
    }
    return $title_parts;
}
add_filter( 'document_title_parts', 'WPBC_tokko_custom_title' ); 


add_filter('wpbc/filter/post/share/permalink', function($the_permalink, $id){
	$property_id = get_query_var('property_id', null);  
		if(empty($property_id)){
			$property_id = $_GET['property_id'];
		} 
	if(!empty($property_id)){
		$api_key = tokko_config('api_key');  
		if(empty($api_key)) return;
		$auth = new TokkoAuth($api_key); 
		if(empty($auth)) return;
		$property = new TokkoProperty('id', $property_id, $auth);
		if(empty($property)) return; 

		$single_page = WPBC_get_field('field_wpbc_tokko_post_object_single_property','options'); $single_page_url = get_permalink($single_page);

		$the_permalink = $single_page_url.WPBC_get_tokko_rewrite_property_url($property);
	}
	return $the_permalink;
},10,2);

add_filter('wpbc/filter/post/share/title', function($title, $id){
	$property_id = get_query_var('property_id', null);  
		if(empty($property_id)){
			$property_id = $_GET['property_id'];
		} 
	if(!empty($property_id)){
		$api_key = tokko_config('api_key');  
		if(empty($api_key)) return;
		$auth = new TokkoAuth($api_key); 
		if(empty($auth)) return;
		$property = new TokkoProperty('id', $property_id, $auth);
		if(empty($property)) return; 

		$address = $property->get_field('address');

		$title = $address;
	}
	return $title;
},10,2);