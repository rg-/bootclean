<?php 
/*

	
	USAGE like:

		[name] 

	$use_settings_[name] = apply_filters('wpbc/filter/theme-settings/enable/[name]','__return_true');
	
	if($use_settings_[name]){
		add_filter('wpbc/filter/theme-settings/fields', 'wpbc_theme_settings__[name]_fields', 10, 1); 
	} 

	function wpbc_theme_settings__[name]_fields($fields){
		
		$fields[] = array(.... YOUR FIELD ....);
		return $fields;
	
	}
	

*/

include('fields/general.php');
include('fields/brand.php');
include('fields/layout.php');  