<?php

add_filter('wpbc/filter/theme_settings/fields', 'wpbc_theme_settings__custom_code_tab', 0, 1);  

function wpbc_theme_settings__custom_code_tab($fields){ 
	$fields[] = WPBC_acf_make_tab_field(
		array( 
			'key' => 'field_wpbc_theme_settings__custom_code_tab',
			'label' => _x('Custom code','bootclean'), 
		)
	); 
	$fields = apply_filters('wpbc/filter/theme_settings/fields/custom_code',$fields);
	return $fields;
}  