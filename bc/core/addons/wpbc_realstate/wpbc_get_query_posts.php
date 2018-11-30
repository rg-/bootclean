<?php

/*

	Just for Properties 

	[WPBC_get_query_properties query_string=''  /]

*/
add_shortcode('WPBC_get_query_properties', 'WPBC_get_query_properties_FX'); 
function WPBC_get_query_properties_FX( $atts, $content = null ){ 
	//print_r($atts);
	$atts['query_string'] = !empty($atts['query_string']) ? $atts['query_string'] : '';
	$query = html_entity_decode( $atts['query_string'] );
	$shortcode_args = wp_parse_args( $query, array() );  
	$shortcode_args['post_type'] = 'property';
	$query_string = http_build_query($shortcode_args, '', '&'); 
	$shortcode_atts .= 'query_string="'.$query_string.'" ';

	$atts_rest = $atts;
	if(!empty($atts_rest)){
		unset($atts_rest['query_string']);
		$atts_rest_args = '';
		foreach ($atts_rest as $key=>$value) { 
			$atts_rest_args .= " $key='$value' ";
		} 
		$shortcode_atts .= $atts_rest_args; 
	} 
	$out = do_shortcode('[WPBC_get_query_posts '.$shortcode_atts.'/]'); 
	return $out;
}

/*

	Add args into shortcode get_query_posts query for "property" post_type

*/
add_filter('wpbc/filter/get_query_posts/template_args/template_part',function($template_part, $query){ 
	if( $query['post_type'] == 'property' ){
		$template_part = 'wpbc_realstate/post_property';
		if( !empty($query['as_marker']) == '1' ){
			$template_part = 'wpbc_realstate/post_property_map_marker';
		}
	}
	return $template_part; 
},10,2);
add_filter('wpbc/filter/get_query_posts/template_args/template_part_single',function($template_part, $query){ 
	if( $query['post_type'] == 'property' ){
		$template_part = 'wpbc_realstate/post_property_single';
	}
	return $template_part; 
},10,2);