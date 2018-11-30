<?php
/*

	Extension for wpbc_get_query_posts addon
	

	// [WPBC_get_properties_map target_id='property']
*/

function WPBC_get_properties_map_FX($atts, $content = null){
	
	$out = '';
	
	$shortcode_args = wp_parse_args( $atts, array() ); 
	
	ob_start(); 

	$inc = WPBC_include_template_part('wpbc_realstate/properties_map'); 
	if(!empty($inc)){  
		include ($inc);  
	} 
	$out = ob_get_contents();
	ob_end_clean();

	return apply_filters('wpbc/filter/WPBC_get_properties_map/out', $out); 
}
add_shortcode('WPBC_get_properties_map', 'WPBC_get_properties_map_FX');