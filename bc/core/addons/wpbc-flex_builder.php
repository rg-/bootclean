<?php

/*

	Using this addon, OLD flexibe layouts will not be used.
	Instead, new ones, new way, are added.


	IMPORTANT, other Bootclean functions and filters in use.

*/


$use_wpbc_flex_builder = apply_filters('wpbc/filter/flex_builder/installed', 0);

include('wpbc_flex_builder/functions/general.php'); 
include('wpbc_flex_builder/functions/defaults.php'); 

include('wpbc_flex_builder/functions/actions.php');



if($use_wpbc_flex_builder){

	include('wpbc_flex_builder/functions/typography.php');
	
	include('wpbc_flex_builder/functions/fields.php'); 
	
	/* 
		Do not include OLD layouts (php files) first off all 
	*/

	add_filter('acf/fields/flexible_layouts', function($wpbc_acf_layouts){ 
		$wpbc_acf_layouts = array(); 
		return $wpbc_acf_layouts; 
	},10,1);

	/* 
		Remove layout_flexible_row here since it´s placed last and in other place (long to explain)
	*/

	add_filter('wpbc/filter/acf/builder/flexible_content/layouts', function($wpbc_acf_layouts){ 
		//$wpbc_acf_layouts = array(); 
		unset($wpbc_acf_layouts['layout_flexible_row']); 
		return $wpbc_acf_layouts; 
	},10,1);
 
	/*
	
		Change template-parts folder part 'wpbc/template/builder/folder-parts'

	*/

	add_filter('wpbc/template/builder/folder-parts', function($folder, $layout){ 
		// default 'builder'
		// $folder = 'flex_builder'; 
		return $folder; 
	},10,2);

	

	/*
	
	The Layouts fields and code.

	IMPORTANT, a template-parts/builder/[LAYOUT_NAME].php file is needed also.
	
	IMPORTANT 2, files under "core/addons/wpbc_flex_builder/layouts" folder
	will be included automaticly, see code behind

	*/

	function WPBC_flex_builder_layouts(){

		$layouts = array();
		$WPBC_builder_layouts_php = BC_ABSPATH.'/core/addons/wpbc_flex_builder/layouts/*.php';
		foreach (glob($WPBC_builder_layouts_php) as $file) {
			$basename = str_replace('.php', '', basename($file));
			if($basename!='ui_layout_flexible') {
				$layouts[] = $basename; 
			}
		}
		$layouts = apply_filters('acf/wpbc_flex_builder/layouts', $layouts);  
		// Allways last and not filtered
		$layouts[] = 'ui_layout_flexible';

		return $layouts;
	
	}
  
	$wpbc_flex_builder_layouts = WPBC_flex_builder_layouts();
	foreach ($wpbc_flex_builder_layouts as $layout) {
		if(file_exists(BC_ABSPATH.'/core/addons/wpbc_flex_builder/layouts/'.$layout.'.php')){
			include('wpbc_flex_builder/layouts/'.$layout.'.php'); 
		} 
	}   

}

/* 
	
	Debug thigs using this:

*/
add_action('wpbc/layout/start', function($out){
	/*
	$builder_layouts = WPBC_get_layout_fields(); 
	foreach ($builder_layouts as $key => $value) {
		_print_code($value['key']);
	}  
	*/ 
	
},10,1);