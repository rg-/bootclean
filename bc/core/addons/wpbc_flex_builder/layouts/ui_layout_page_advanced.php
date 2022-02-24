<?php

/*

	ui_layout_page_advanced

	Use this layout to "clone" for other post types using:

		WPBC_acf_make_layout_posts_advanced() as below

*/

add_filter('wpbc/filter/acf/builder/flexible_content/layouts', 'WPBC_build__ui_layout_page_advanced',0,1);  
	
function WPBC_build__ui_layout_page_advanced($layouts){ 

	$layout_name = 'ui_layout_page_advanced';

	$layout_label = '<i class="icon-badge">
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#fff"><path d="M0 0h24v24H0z" fill="none"/><path class="path" d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/></svg></i> Advanced PAGES'; 
	
	$content_sub_fields = WPBC_acf_make_layout_posts_advanced($layout_name, false, array('page'));

	$layouts = WPBC_acf_make_flex_builder_layout(array(
		'layout_name' => $layout_name,
		'layout_label' => $layout_label,
		'content_sub_fields' => $content_sub_fields,
		//'show_section_title' => false, 
		'show_section_settings' => true,
		'show_section_styles' => true,
		'section_settings_defaults' => array(  
			'classes' => false, 
		),
	), $layouts); 

	return $layouts;  
} 