<?php

$default_options = apply_filters('BC_default_options' , array(
	'layout',
	'widgets',
	'post_types',
	'admin-settings',
	'color-scheme',
	'advanced',
	'develope'
	));

$default_options = array_reverse($default_options);

foreach($default_options as $p){ 
	if( file_exists( get_template_directory().'/bc/core/theme-options-defaults/'.$p.'.php' ) ){
		require_once get_template_directory().'/bc/core/theme-options-defaults/'.$p.'.php';
	}
}

add_filter('wpbc/theme-options/interface/reset-button', function($button){ 
	$atts = array(
		'alt' => 'Reset',
		'color' => '#999',
		'width' => '14',
		'height' => '14',  
	); 
	$icon = WPBC_get_svg_img('md-refresh', $atts); 
	$button = $icon; 
	return $button;
},10,1);
add_filter('wpbc/theme-options/interface/reset-button/class', function($class){ 
	$class = 'of-default-value of-default-value-icon';
	return $class;
},10,1);
