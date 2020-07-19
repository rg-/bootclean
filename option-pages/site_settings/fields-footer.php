<?php

add_filter('wpbc/filter/theme_settings/fields', 'wpbc_theme_settings__footer_tab', 0, 1);  

function wpbc_theme_settings__footer_tab($fields){ 
	$fields[] = WPBC_acf_make_tab_field(
		array( 
			'key' => 'field_wpbc_theme_settings__footer_tab',
			'label' => '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
<path fill="none" d="M0,0h24v24H0V0z"/>
<g>
	<path d="M8,11v3H4v-3H8 M9,10H3v5h6V10L9,10z"/>
</g>
<g>
	<path d="M21,11v3H11v-3H21 M22,10H10v5h12V10L22,10z"/>
</g>
<g>
	<path d="M21,6v2H4V6H21 M22,5H3v4h19V5L22,5z"/>
</g>
<rect x="3" y="16" width="19" height="3"/>
</svg> '._x('Footer','bootclean'), 
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
			'label' => '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
<path fill="none" d="M0,0h24v24H0V0z"/>
<g>
	<path d="M8,11v3H4v-3H8 M9,10H3v5h6V10L9,10z"/>
</g>
<g>
	<path d="M21,11v3H11v-3H21 M22,10H10v5h12V10L22,10z"/>
</g>
<g>
	<path d="M21,6v2H4V6H21 M22,5H3v4h19V5L22,5z"/>
</g>
<rect x="3" y="16" width="19" height="3"/>
</svg> '. _x('Footer Options','bootclean'),  
		)
	); 
	return $fields;
}


add_filter('wpbc/filter/theme_settings/fields/footer', 'wpbc_theme_settings__footer_copyright', 10, 1);
function wpbc_theme_settings__footer_copyright($fields){
	$fields[] =  WPBC_acf_make_textarea_field(
		array( 
			'name' => 'footer_copyright',
			'label' => _x('Copyright text','bootclean'),  
		)
	); 
	return $fields;
}




/*
	
	Front end filters/actions for this settings

*/

add_filter('wpbc/filter/component/wp-footer/args', function($args){
	if(!empty($args['is_main'])){
		$footer_copyright = WPBC_get_theme_settings('footer_copyright');
		if(!empty($footer_copyright)){
			$args['default_content'] = $footer_copyright;
		}
	}
	return $args;
});