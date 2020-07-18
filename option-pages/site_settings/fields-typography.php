<?php

add_filter('wpbc/filter/theme_settings/fields', 'wpbc_theme_settings__typography_tab', 0, 1);  

function wpbc_theme_settings__typography_tab($fields){ 
	$fields[] = WPBC_acf_make_tab_field(
		array( 
			'key' => 'field_wpbc_theme_settings__typography_tab',
			'label' => _x('Typography','bootclean'), 
		)
	); 
	$fields = apply_filters('wpbc/filter/theme_settings/fields/typography',$fields);
	return $fields;
}  