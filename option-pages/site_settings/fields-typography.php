<?php

add_filter('wpbc/filter/theme_settings/fields', 'wpbc_theme_settings__typography_tab', 0, 1);  

function wpbc_theme_settings__typography_tab($fields){ 
	$fields[] = WPBC_acf_make_tab_field(
		array( 
			'key' => 'field_wpbc_theme_settings__typography_tab',
			'label' => '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/></g><g><g><g><path d="M2.5,4v3h5v12h3V7h5V4H2.5z M21.5,9h-9v3h3v7h3v-7h3V9z"/></g></g></g></svg> '._x('Typography','bootclean'), 
		)
	); 
	$fields = apply_filters('wpbc/filter/theme_settings/fields/typography',$fields);
	return $fields;
}  

add_filter('wpbc/filter/theme_settings/fields/typography', 'wpbc_theme_settings__typography__subtitle', 0, 1);
function wpbc_theme_settings__typography__subtitle($fields){
	$fields[] =  WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_theme_settings__typography_subtitle',
			'label' => '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/></g><g><g><g><path d="M2.5,4v3h5v12h3V7h5V4H2.5z M21.5,9h-9v3h3v7h3v-7h3V9z"/></g></g></g></svg> '._x('Typography Options','bootclean'),  
		)
	); 
	return $fields;
}