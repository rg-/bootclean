<?php

/*

	Here getting data from theme options settings if used 
	TODO, container_type added into layout args

*/

function WPBC_get_layout_structure__custom_main_container($new_args=array(), $layout='defaults', $case = 'WPBC_get_option'){
	
	if($case=='WPBC_get_option'){ 

		$all_options = WPBC_get_all_options();
		$only_foo = array();
		$find = 'custom_layout__'.$layout; 
		foreach ($all_options as $key => $value) { 
			if (strpos($key, $find) === 0) {
		        $only_foo[$key] = $value;
		    }
		} 
		$container_id = WPBC_get_option($find.'-container-id'); 
		$container_class = WPBC_get_option($find.'-container-class'); 
		$container_attrs = WPBC_get_option($find.'-container-attrs'); 
  
		$new_args[$layout]['id'] = $container_id;
		$new_args[$layout]['class'] = $container_class;
		$new_args[$layout]['attrs'] = $container_attrs; 

		$row_count = WPBC_get_option($find.'-container-row-count'); 
		for ($i=0; $i < $row_count; $i++) { 
			$findd = $find."-row-".$i;  
			$row_id = WPBC_get_option($findd.'-id'); 
			$row_class = WPBC_get_option($findd.'-class'); 
			$row_attrs = WPBC_get_option($findd.'-attrs'); 

			$new_args[$layout]['content'][$row_id]['id'] = $row_id;
			$new_args[$layout]['content'][$row_id]['class'] = $row_class;
			$new_args[$layout]['content'][$row_id]['attrs'] = $row_attrs;

			$col_count = WPBC_get_option($findd.'-col-count'); 
			for ($e=0; $e < $col_count; $e++) {

				$finddd = $findd."-col-".$e;

				$col_id = WPBC_get_option($finddd.'-id'); 
				$col_class = WPBC_get_option($finddd.'-class'); 
				$col_attrs = WPBC_get_option($finddd.'-attrs'); 

				$new_args[$layout]['content'][$row_id]['content'][$col_id]['id'] = $col_id;
				$new_args[$layout]['content'][$row_id]['content'][$col_id]['class'] = $col_class;
				$new_args[$layout]['content'][$row_id]['content'][$col_id]['attrs'] = $col_attrs;

			}	
		}

	}

	return $new_args;
}