<?php

/*

	ui_layout_taxonomy_advanced 

*/

add_filter('wpbc/filter/acf/builder/flexible_content/layouts', 'WPBC_build__ui_layout_taxonomy_advanced',1,1);  
	
function WPBC_build__ui_layout_taxonomy_advanced($layouts){ 

	$layout_name = 'ui_layout_taxonomy_advanced';

	$layout_label = '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#fff" class="svg"><path d="M0 0h24v24H0z" fill="none"/><path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/></svg></i> Advanced Taxonomy'; 
	

	$tax = array('category','post_tag');
	$taxonomy_choices = array();
	foreach ($tax as $t) { 
		$taxonomy_choices[$t] = $t;
	}

	$content_sub_fields = WPBC_acf_make_layout_posts_advanced($layout_name, false, array('post'), $taxonomy_choices);

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