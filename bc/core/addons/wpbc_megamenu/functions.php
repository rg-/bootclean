<?php 

function WPBC_get_megamenu_type($item){
	$megamenu_type = WPBC_get_field('wpbc_field__megamenu_type', $item->ID);
	return $megamenu_type;
}
function WPBC_get_megamenu_menu($item){
	$megamenu_menu = WPBC_get_field('wpbc_field__megamenu_menu', $item->ID);
	return $megamenu_menu;
}
function WPBC_get_megamenu_template($item){
	$megamenu_template = WPBC_get_field('wpbc_field__megamenu_template', $item->ID);
	return $megamenu_template;
}
function WPBC_get_megamenu_template_part($item){
	$megamenu_template_part = WPBC_get_field('wpbc_field__megamenu_template_part', $item->ID);
	return $megamenu_template_part;
}
function WPBC_get_megamenu_html($item){
	$megamenu_html = WPBC_get_field('wpbc_field__megamenu_html', $item->ID);
	return $megamenu_html;
}
function WPBC_if_has_megamenu($item){
	$use = WPBC_get_field('wpbc_field__megamenu', $item->ID);
	$menu = WPBC_get_field('wpbc_field__megamenu_template', $item->ID);
	$template = WPBC_get_field('wpbc_field__megamenu_template', $item->ID);
	$template_part = WPBC_get_field('wpbc_field__megamenu_template_part', $item->ID);
	$megamenu_html = WPBC_get_field('wpbc_field__megamenu_html', $item->ID);
	if(!empty($use) && ( !empty($menu) || !empty($template) || !empty($template_part)  || !empty($megamenu_html) ) ){
		return true;
	}
}


/*

	shortcodes and templates

*/

add_shortcode('WPBC_get_megamenu_menu','WPBC_get_megamenu_menu_fx');

function WPBC_get_megamenu_menu_fx( $atts, $content = null ) {  
  $defs = array(); 
  $args = array_merge($defs, $atts);
  ob_start(); 
  WPBC_get_template_part('layout/megamenu/megamenu_menu', $args); 
  return ob_get_clean();  
}  