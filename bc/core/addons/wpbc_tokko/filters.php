<?php

function WPBC_tokko_query_vars( $vars ) {
    //$vars[] = 'something';  
    return $vars;
} 
add_filter( 'query_vars', 'WPBC_tokko_query_vars' ); 

function WPBC_tokko_nav_menu_css_class( $classes, $item, $args ) {
  
	if( WPBC_tokko_if_sale() && in_array('active_if_sale',$item->classes) ){
		$class .= ' wpbc_tokko__operation_sale';
	}
	if( WPBC_tokko_if_rent() && !WPBC_tokko_if_temporary_rent() && in_array('active_if_anual_rent',$item->classes) ){
		$class .= ' wpbc_tokko__operation_anual_rent';
	}
	if( WPBC_tokko_if_temporary_rent() && !WPBC_tokko_if_rent() && in_array('active_if_temporary_rent',$item->classes) ){
		$class .= ' wpbc_tokko__operation_temporary_rent';
	} 

	if( WPBC_tokko_if_rent() && WPBC_tokko_if_temporary_rent() && in_array('active_if_rent',$item->classes) ){
		$class .= ' wpbc_tokko__operation_rent';
	}

  return $classes;
}
add_filter( 'nav_menu_css_class' , 'WPBC_tokko_nav_menu_css_class' , 10, 4 ); 


add_filter('wpbc/body/class', 'WPBC_tokko_body_class',10,1);

function WPBC_tokko_body_class($class){

	if( WPBC_tokko_if_sale() ){
		$class .= ' wpbc_tokko__operation_sale';
	}
	if( WPBC_tokko_if_rent() && !WPBC_tokko_if_temporary_rent() ){
		$class .= ' wpbc_tokko__operation_anual_rent';
	}
	if( WPBC_tokko_if_temporary_rent() && !WPBC_tokko_if_rent() ){
		$class .= ' wpbc_tokko__operation_temporary_rent';
	} 

	if( WPBC_tokko_if_rent() && WPBC_tokko_if_temporary_rent() ){
		$class .= ' wpbc_tokko__operation_rent';
	}

	return $class;
}  