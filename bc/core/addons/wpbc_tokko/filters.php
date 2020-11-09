<?php

function WPBC_tokko_query_vars( $vars ) {
    //$vars[] = 'something';  
    return $vars;
} 
add_filter( 'query_vars', 'WPBC_tokko_query_vars' );



function WPBC_tokko_nav_menu_css_class( $classes, $item, $args ) {
 
  //_print_code($item);
	if( isset($_REQUEST['data']) ){
		$search_data = json_decode($bodytag = str_replace("\\", "", $_REQUEST['data']), true);
		foreach ($search_data['operation_types'] as $operation) {
			 
			if($operation==1 && in_array('active_if_sale',$item->classes)){
				$classes[] = ' active ';
			}
			if($operation==2 && in_array('active_if_rent',$item->classes)){
				$classes[] = ' active ';
			}
			if($operation==3 && in_array('active_if_temporary_rent',$item->classes)){
				$classes[] = ' active ';
			}
		} 
	} 

  return $classes;
}
add_filter( 'nav_menu_css_class' , 'WPBC_tokko_nav_menu_css_class' , 10, 4 ); 


add_filter('wpbc/body/class', 'WPBC_tokko_body_class',10,1);

function WPBC_tokko_body_class($class){

	if( isset($_REQUEST['data']) ){
		$search_data = json_decode($bodytag = str_replace("\\", "", $_REQUEST['data']), true);
		foreach ($search_data['operation_types'] as $operation) {
			if($operation==1){
				$class .= ' wpbc_tokko__operation_sale';
			}
			if($operation==2){
				$class .= ' wpbc_tokko__operation_rent';
			}
			if($operation==3){
				$class .= ' wpbc_tokko__operation_temporary_rent';
			}
		} 
	}

	return $class;
}