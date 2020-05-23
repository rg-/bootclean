<?php

add_filter('wpbc/filter/layout/start/defaults', function($args){
	/*
	$args = array( 
		
			// body main structure defaults
			'main_content' => array(
				'id' => 'main-content',
				'class' => 'content-wrap',
				'wrap' => array(
					'id' => 'main-content-wrap',
					'class' => ''
				)
			), 

		);
	*/ 
	return $args;
},10,1); 

add_filter('wpbc/filter/layout/attrs/?id=main-container-areas', function($attrs, $structure_id, $key){
	//$attrs .= ' data-swup="enable" ';
	return $attrs;
},10,3);

add_filter('wpbc/filter/layout/class/?id=main-container-areas', function($class, $structure_id, $key){
	//$class .= ' transition-fade ';
	return $class;
},10,3);

add_filter('wpbc/filter/layout/a2-ml/main_container/args', function($value){
	if( $value['id'] == 'main-container-areas' ){	
		// $value['class'] = ' gpy-2 gpy-md-3 ';
	}
	if( $value['id'] == 'main-content-area' ){
		// $value['class'] = ' col-lg-8 gpr-lg-4 ';  
	} 
	if( $value['id'] == 'area-1' ){
		// $value['class'] = ' col-lg-4 ';  
	} 
	return $value;
},10,1); 