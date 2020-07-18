<?php
 
function WPBC_get_settings(){

	$WPBC_settings['main-navbar'] = array();
	$WPBC_settings['main-pageheader'] = array();
	$WPBC_settings['main-content'] = array();
	$WPBC_settings['main-footer'] = array();

	$WPBC_settings = apply_filters('wpbc/filter/settings',array());
	return $WPBC_settings;
}


add_action('wpbc/layout/start', function(){ 
	//_print_code(WPBC_get_settings()); 
}, 40 );