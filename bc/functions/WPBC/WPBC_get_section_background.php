<?php

if( !function_exists('WPBC_get_section_background') ){

	function WPBC_get_section_background($args=array()){

		/*
	
		$args

			html
			images
			layout-id

			return
		*/

		WPBC_get_template_part('builder/parts/ui_layout_commons/section-background',$args);
	
	}

} 

function _WPBC_get_section_background_FX($atts, $content = null) {
	extract(shortcode_atts(array(
		"html" => '',
		"images" => array(),
		"layout-id" => '',
	), $atts));
	$out = '';
	$args['images'] = explode(",",$images);
	ob_start(); 
	WPBC_get_template_part('builder/parts/ui_layout_commons/section-background',$args);
	$out = ob_get_contents();
	ob_end_clean();
	return $out; 
} 
add_shortcode('WPBC_get_section_background','_WPBC_get_section_background_FX');