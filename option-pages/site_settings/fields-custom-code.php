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


add_filter('wpbc/filter/theme_settings/fields/custom_code', 'wpbc_theme_settings__custom_code__fields', 10, 1); 

function wpbc_theme_settings__custom_code__fields($fields){
	
	$fields[] =  WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_theme_settings__custom_code_subtitle',
			'label' => _x('Custom code','bootclean'), 
			'message' => _x('Insert custom code like Facebook pixel, Google Tag Manager and so on. Depending on your needs, you can embed code on header, body or footer on the site.','bootclean'), 
		)
	); 

	// 'wpbc/head/start'
	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'custom_code__head_start',
			'label' => _x('HEAD head/start','bootclean'), 
			'instructions' => _x('Right before HEAD tag.','bootclean'), 
		)
	); 

	// 'wpbc/head/end'
	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'custom_code__head_end',
			'label' => _x('HEAD head/end','bootclean'), 
			'instructions' => _x('Right after close HEAD tag.','bootclean'), 
		)
	); 

	// 'wpbc/layout/body/start'
	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'custom_code__body_start',
			'label' => _x('BODY body/start','bootclean'), 
			'instructions' => _x('Right before BODY tag.','bootclean'), 
		)
	); 

	// 'wpbc/layout/body/end'
	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'custom_code__before_wp_footer',
			'label' => _x('WP_FOOTER before/wp_footer','bootclean'), 
			'instructions' => _x('Right before wp_footer.','bootclean'), 
		)
	); 

	// 'wpbc/layout/wp_footer/after'
	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'custom_code__after_wp_footer',
			'label' => _x('WP_FOOTER after/wp_footer','bootclean'), 
			'instructions' => _x('After wp_footer.','bootclean'), 
		)
	); 

	return $fields; 

};



/*

	Front end filters/actions for these settings

*/


// header.php

add_action('wpbc/head/start', 'WPBC_theme_settings_head_start',0);
function WPBC_theme_settings_head_start(){ 
	$custom_code__head_start = WPBC_get_theme_settings('custom_code__head_start');
	if(!empty($custom_code__head_start)){
		echo $custom_code__head_start;
	}
}
add_action('wpbc/head/end', 'WPBC_theme_settings_head_end',0);
function WPBC_theme_settings_head_end(){ 
	$custom_code__head_end = WPBC_get_theme_settings('custom_code__head_end');
	if(!empty($custom_code__head_end)){
		echo $custom_code__head_end;
	}
}
add_action('wpbc/layout/body/start', 'WPBC_theme_settings_body_start',0);
function WPBC_theme_settings_body_start(){ 
	$custom_code__body_start = WPBC_get_theme_settings('custom_code__body_start');
	if(!empty($custom_code__body_start)){
		echo $custom_code__body_start;
	}
}

// footer.php
add_action('wpbc/layout/body/end', 'WPBC_theme_settings_before_wp_footer',999);
function WPBC_theme_settings_before_wp_footer(){ 
	$custom_code__before_wp_footer = WPBC_get_theme_settings('custom_code__before_wp_footer');
	if(!empty($custom_code__before_wp_footer)){
		echo $custom_code__before_wp_footer;
	}
}
add_action('wpbc/layout/wp_footer/after', 'WPBC_theme_settings_after_wp_footer',999);
function WPBC_theme_settings_after_wp_footer(){ 
	$custom_code__after_wp_footer = WPBC_get_theme_settings('custom_code__after_wp_footer');
	if(!empty($custom_code__after_wp_footer)){
		echo $custom_code__after_wp_footer;
	}
} 