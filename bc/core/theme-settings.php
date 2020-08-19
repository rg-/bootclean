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



/* 

	Enable custom-collapse component for mainnavbar

	See:

		-> bc/components/collapse-custom.php
		-> template-parts/components/collapse-custom/collapse.php

		-> SASS _source/bootclean/core/_collapse.scss
		-> JS js/global.js > [data-toggle="collapse-custom"]

*/



function __get_custom_collapse(){
	$use_custom_collapse = apply_filters('wpbc/filter/layout/main-navbar/custom_collapse',array());
	return $use_custom_collapse;
}

if(!empty( __get_custom_collapse() )){

	add_filter('wpbc/filter/layout/main-navbar/defaults', function($args){ 
		
		$args['wp_nav_menu'] = false; // use this to replace wp_nav_menu with "collapse-custom" one 
		
		$custom_collapse = __get_custom_collapse(); 

		$collapse_id = !empty($custom_collapse['collapse']['id']) ? $custom_collapse['collapse']['id'] : 'collapse-custom';

		$args['navbar_toggler']['data_toggle'] = 'data-toggle="'.$collapse_id.'"';
		$args['navbar_toggler']['target'] = $collapse_id;

		// you can use this...
		if(!empty($custom_collapse['collapse']['inside_nav'])){
			// $args['wp_nav_menu_custom'] = '[WPBC_get_template name="parts/wp_nav_menu_custom"]';
			$collapse_args = !empty($custom_collapse['collapse']) ? $custom_collapse['collapse'] : array(); 
			  
			ob_start(); 
			WPBC_get_template_part('components/collapse-custom/collapse', array( 
				'params' => $collapse_args, 
			));
			$content = ob_get_contents();
			ob_end_clean();

			$args['wp_nav_menu_custom'] = $content; 
		}
		return $args;

	},10,1); 

	

	// Or this, to output the menu itself
	add_action('wpbc/layout/start', function(){ 

		$custom_collapse = __get_custom_collapse(); 
		// If arguments passed, use them on the component
		$collapse_args = !empty($custom_collapse['collapse']) ? $custom_collapse['collapse'] : array();
		if(empty($custom_collapse['collapse']['inside_nav'])){
			WPBC_get_component('collapse-custom', $collapse_args); 
		} 

	}, 11 );

}