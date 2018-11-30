<?php

function WPBC_google_api_key() {
	$key = 'AIzaSyBbE1WKRyspJbOlD3HhGFeJ1pww4sj_PKY';
	return apply_filters('wpbc/filter/google_api_key',$key);
}

function WPBC_acf_init() { 
	$key = WPBC_google_api_key();
	acf_update_setting('google_api_key', $key);
} 
add_action('acf/init', 'WPBC_acf_init');

function WPBC_acf_google_map_api( $api ){ 
	$api['key'] = WPBC_google_api_key();
	return $api; 
}

add_filter('acf/fields/google_map/api', 'WPBC_acf_google_map_api'); 