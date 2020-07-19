<?php

add_filter('wpbc/filter/theme_settings/fields', 'wpbc_theme_settings__footer_tab', 0, 1);  

function wpbc_theme_settings__footer_tab($fields){ 
	$fields[] = WPBC_acf_make_tab_field(
		array( 
			'key' => 'field_wpbc_theme_settings__footer_tab',
			'label' => _x('Footer','bootclean'), 
		)
	); 
	$fields = apply_filters('wpbc/filter/theme_settings/fields/footer',$fields);
	return $fields;
}  

add_filter('wpbc/filter/theme_settings/fields/footer', 'wpbc_theme_settings__footer__subtitle', 0, 1);
function wpbc_theme_settings__footer__subtitle($fields){
	$fields[] =  WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_theme_settings__footer_subtitle',
			'label' => _x('Footer Options','bootclean'),  
		)
	); 
	return $fields;
}