<?php

add_filter('wpbc/filter/layout/struture/defaults', function($args){ 
	$path = WPBC_get_layout_structure_path();
	$child_path = WPBC_get_layout_structure_path(true); 
	$files = array_slice(scandir($path), 2); 
	foreach ($files as $key => $value) {
		// Test first for child overide 
		$pathinfo = pathinfo($value);
		if( 'php' == $pathinfo['extension'] ){
			if( file_exists($child_path.$value) ){  
				include($child_path.$value); 
			}else{
				include($path.$value); 
			} 
		}
	}  
	return $args;  
},10,1);