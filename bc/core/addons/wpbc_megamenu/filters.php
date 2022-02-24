<?php


add_filter('nav_menu_link_attributes', function($atts, $item, $args, $depth){ 

  $nav_link_class = WPBC_get_field('wpbc_field__nav_link_class', $item->ID);
  if ( !empty( $nav_link_class ) ) {
    $atts['class'] = $nav_link_class;
  } 

  $nav_link_anchor = WPBC_get_field('wpbc_field__nav_link_anchor', $item->ID);
  if ( !empty( $nav_link_anchor ) ) {
    $atts['href'] = $atts['href'].'#'.$nav_link_anchor;
  } 

  $link_anchor_scroll = WPBC_get_field('wpbc_field__nav_link_anchor_scroll', $item->ID);
  if ( !empty( $nav_link_anchor ) && !empty( $link_anchor_scroll ) ) {
    $atts['class'] = $atts['class'].' scroll-to-nav-link';
  } 

  return $atts;

}, 99, 4); 

add_filter('nav_menu_item_args', 'WPBC_nav_menu_item_args', 10, 3);
function WPBC_nav_menu_item_args( $args, $item, $depth ) { 

	if( WPBC_if_has_megamenu($item) ) {
		$args->has_children = 1;
		$args->walker->has_children = 1; 
		// print_r($args); 
		foreach( $args as $arg ) { 
			//$item->title .= $megamenu_content;  
		} 
	}  
	return $args; 
}

add_filter('nav_menu_css_class', 'WPBC_nav_menu_css_class', 10, 4);
function WPBC_nav_menu_css_class( $classes, $item, $args, $depth){ 

	$nav_link_anchor = WPBC_get_field('wpbc_field__nav_link_anchor', $item->ID); 

	if( WPBC_if_has_megamenu($item) ) { 
		$type = WPBC_get_megamenu_type($item);
		$classes[] = 'megamenu-type-'.$type;
		$megamenu_class = apply_filters('wpbc/filter/megamenu/class', 'megamenu', $item);
		$classes[] = $megamenu_class;
	}
	return $classes;
}

add_filter('walker_nav_menu_start_el', 'WPBC_walker_nav_menu_start_el', 10, 4);
function WPBC_walker_nav_menu_start_el($item_output, $item, $depth, $args){ 
	
	if( WPBC_if_has_megamenu($item) ) { 

		ob_start(); 
		WPBC_get_template_part('layout/megamenu', array(
			'item' => $item,
			'depth' => $depth,
			'args' => $args,
		));
		$item_output .= ob_get_contents();
		ob_end_clean();

	}
	return $item_output;
} 