<?php

add_filter('wpbc/filter/theme_settings/fields', 'wpbc_theme_settings__custom_code_tab', 0, 1);  

function wpbc_theme_settings__custom_code_tab($fields){ 
	$fields[] = WPBC_acf_make_tab_field(
		array( 
			'key' => 'field_wpbc_theme_settings__custom_code_tab',
			'label' => '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/><circle cx="12" cy="3.5" fill="none" r=".75"/><circle cx="12" cy="3.5" fill="none" r=".75"/><circle cx="12" cy="3.5" fill="none" r=".75"/><path d="M19,3h-4.18C14.4,1.84,13.3,1,12,1S9.6,1.84,9.18,3H5C4.86,3,4.73,3.01,4.6,3.04C4.21,3.12,3.86,3.32,3.59,3.59 c-0.18,0.18-0.33,0.4-0.43,0.64C3.06,4.46,3,4.72,3,5v14c0,0.27,0.06,0.54,0.16,0.78c0.1,0.24,0.25,0.45,0.43,0.64 c0.27,0.27,0.62,0.47,1.01,0.55C4.73,20.99,4.86,21,5,21h14c1.1,0,2-0.9,2-2V5C21,3.9,20.1,3,19,3z M11,14.17l-1.41,1.42L6,12 l3.59-3.59L11,9.83L8.83,12L11,14.17z M12,4.25c-0.41,0-0.75-0.34-0.75-0.75S11.59,2.75,12,2.75s0.75,0.34,0.75,0.75 S12.41,4.25,12,4.25z M14.41,15.59L13,14.17L15.17,12L13,9.83l1.41-1.42L18,12L14.41,15.59z"/></g></svg> '. _x('Custom code','bootclean'), 
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
			'label' => '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/><circle cx="12" cy="3.5" fill="none" r=".75"/><circle cx="12" cy="3.5" fill="none" r=".75"/><circle cx="12" cy="3.5" fill="none" r=".75"/><path d="M19,3h-4.18C14.4,1.84,13.3,1,12,1S9.6,1.84,9.18,3H5C4.86,3,4.73,3.01,4.6,3.04C4.21,3.12,3.86,3.32,3.59,3.59 c-0.18,0.18-0.33,0.4-0.43,0.64C3.06,4.46,3,4.72,3,5v14c0,0.27,0.06,0.54,0.16,0.78c0.1,0.24,0.25,0.45,0.43,0.64 c0.27,0.27,0.62,0.47,1.01,0.55C4.73,20.99,4.86,21,5,21h14c1.1,0,2-0.9,2-2V5C21,3.9,20.1,3,19,3z M11,14.17l-1.41,1.42L6,12 l3.59-3.59L11,9.83L8.83,12L11,14.17z M12,4.25c-0.41,0-0.75-0.34-0.75-0.75S11.59,2.75,12,2.75s0.75,0.34,0.75,0.75 S12.41,4.25,12,4.25z M14.41,15.59L13,14.17L15.17,12L13,9.83l1.41-1.42L18,12L14.41,15.59z"/></g></svg> '._x('Custom code','bootclean'), 
			'message' => _x('Insert custom code like Facebook pixel, Google Tag Manager and so on. Depending on your needs, you can embed code on header, body or footer on the site.','bootclean'), 
		)
	); 

	// 'wpbc/head/start'
	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'custom_code__head_start',
			'label' => _x('HEAD head/start','bootclean'), 
			'instructions' => _x('Right before &lt;HEAD&gt; open tag.','bootclean'), 
		)
	); 

	// 'wpbc/head/end'
	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'custom_code__head_end',
			'label' => _x('HEAD head/end','bootclean'), 
			'instructions' => _x('Right after &lt;/HEAD&gt; close tag.','bootclean'), 
		)
	); 

	// 'wpbc/layout/body/start'
	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'custom_code__body_start',
			'label' => _x('BODY body/start','bootclean'), 
			'instructions' => _x('Right before &lt;BODY&gt; open tag.','bootclean'), 
		)
	); 

	// 'wpbc/layout/body/end'
	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'custom_code__before_wp_footer',
			'label' => _x('WP_FOOTER/before','bootclean'), 
			'instructions' => _x('Right before wp_footer.','bootclean').' <br><br><b>Tip:</b> '. _x('The code in this place, will render BEFORE any javascript enqueued on the wp_footer action.','bootclean'), 
		)
	); 

	// 'wpbc/layout/wp_footer/after'
	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'custom_code__after_wp_footer',
			'label' => _x('BODY/end','bootclean'), 
			'instructions' => _x('After wp_footer, right before &lt;/BODY&gt; close tag.','bootclean').' <br><br><b>Tip:</b> '. _x('The code in this place, will render AFTER any javascript enqueued on the wp_footer action.','bootclean'), 
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