<?php
// Ex: /wp-admin/admin-ajax.php?action=get_property&id=21&part=post_property_single
function WPBC_ajax_get_property(){ 
	$id = !empty($_GET['id']) ? $_GET['id'] : false;
	$part = !empty($_GET['part']) ? $_GET['part'] : 'post_property'; 
	$taxonomy = !empty($_GET['taxonomy']) ? $_GET['taxonomy'] : '';
	$meta = !empty($_GET['meta']) ? $_GET['meta'] : '';
	if($id) echo do_shortcode('[WPBC_get_property id='.$id.' part='.$part.' taxonomy='.$taxonomy.' meta='.$meta.' /]'); 
	die(); 
}

add_action('wp_ajax_get_property', 'WPBC_ajax_get_property');
add_action('wp_ajax_nopriv_get_property', 'WPBC_ajax_get_property');

/*

	@shortcode WPBC_get_property

	@template-parts/

			$part => post_property (def)

*/
function WPBC_get_property_FX($atts, $content = null){
	
	$out = '';
	extract(shortcode_atts(array(
		'id' => false,
		'part' => 'post_property',
		'taxonomy' => '',
		'meta' => '',
		'args' => '',
	), $atts));  

	$temp = '';  
	$property = get_post($id); 
	if(!empty($property)){
		ob_start(); 
		$inc = WPBC_include_template_part('wpbc_realstate/'.$part); 
		if(!empty($inc)){  
			include ($inc);  
		} 
		$temp = ob_get_contents();
		ob_end_clean();
	}
	$out = $temp;
	return apply_filters('wpbc/filter/WPBC_get_property/out', $out); 
}
add_shortcode('WPBC_get_property', 'WPBC_get_property_FX');

/*

	@shortcode WPBC_get_slider_properties

	@template-parts/

			$part => slick_slider (def)

*/
function WPBC_get_slider_properties_FX($atts, $content = null){
	extract(shortcode_atts(array(
		'query_string' => '',
	), $atts));  
	$temp = ''; 
	ob_start(); 
	$inc = WPBC_include_template_part('wpbc_realstate/slider_properties'); 
	if(!empty($inc)){  
		include ($inc);  
	} 
	$temp = ob_get_contents();
	ob_end_clean();
	$out = $temp;
	return apply_filters('wpbc/filter/WPBC_get_slider_properties/out', $out); 
}
add_shortcode('WPBC_get_slider_properties', 'WPBC_get_slider_properties_FX');

