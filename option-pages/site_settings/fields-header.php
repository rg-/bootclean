<?php

add_filter('wpbc/filter/theme_settings/fields', 'wpbc_theme_settings__header_tab', 0, 1);  

function wpbc_theme_settings__header_tab($fields){ 
	$fields[] = WPBC_acf_make_tab_field(
		array( 
			'key' => 'field_wpbc_theme_settings__header_tab',
			'label' => '<svg x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve"><path fill="none" d="M0,0h24v24H0V0z"/><g><path d="M8,11v3H4v-3H8 M9,10H3v5h6V10L9,10z"/></g><g><path d="M21,11v3H11v-3H21 M22,10H10v5h12V10L22,10z"/></g><g><rect x="3.5" y="5.5" width="18" height="3" fill="var(--primary)" /><path d="M21,6v2H4V6H21 M22,5H3v4h19V5L22,5z" fill="var(--primary)"/></g><g><path d="M21,17v1H4v-1H21 M22,16H3v3h19V16L22,16z"/></g></svg>  '._x('Header','bootclean'), 
		)
	); 
	$fields = apply_filters('wpbc/filter/theme_settings/fields/header',$fields);
	return $fields;
}  


add_filter('wpbc/filter/theme_settings/fields/header', 'wpbc_theme_settings__header__message', 1, 1); 

function wpbc_theme_settings__header__message($fields){
 

	$fields[] = WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_theme_settings__header_main_navbar_message',
			'label' => '<svg x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve"><path fill="none" d="M0,0h24v24H0V0z"/><g><path d="M8,11v3H4v-3H8 M9,10H3v5h6V10L9,10z"/></g><g><path d="M21,11v3H11v-3H21 M22,10H10v5h12V10L22,10z"/></g><g><rect x="3.5" y="5.5" width="18" height="3" fill="var(--primary)" /><path d="M21,6v2H4V6H21 M22,5H3v4h19V5L22,5z" fill="var(--primary)"/></g><g><path d="M21,17v1H4v-1H21 M22,16H3v3h19V16L22,16z"/></g></svg> '._x('Header settings','bootclean'), 
		)
	); 

	return $fields;

} 


include('fields-header/header__main-navbar.php');