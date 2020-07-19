<?php

add_filter('wpbc/filter/theme_settings/fields', 'wpbc_theme_settings__header_tab', 0, 1);  

function wpbc_theme_settings__header_tab($fields){ 
	$fields[] = WPBC_acf_make_tab_field(
		array( 
			'key' => 'field_wpbc_theme_settings__header_tab',
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
	<rect x="3.5" y="5.5" width="18" height="3"/>
	<path d="M21,6v2H4V6H21 M22,5H3v4h19V5L22,5z"/>
</g>
<g>
	<path d="M21,17v1H4v-1H21 M22,16H3v3h19V16L22,16z"/>
</g>
</svg> '._x('Header','bootclean'), 
		)
	); 
	$fields = apply_filters('wpbc/filter/theme_settings/fields/header',$fields);
	return $fields;
}  


add_filter('wpbc/filter/theme_settings/fields/header', 'wpbc_theme_settings__header__fields', 10, 1); 


function wpbc_theme_settings__header__fields($fields){
 

	$fields[] = WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_theme_settings__header_main_navbar_message',
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
	<rect x="3.5" y="5.5" width="18" height="3"/>
	<path d="M21,6v2H4V6H21 M22,5H3v4h19V5L22,5z"/>
</g>
<g>
	<path d="M21,17v1H4v-1H21 M22,16H3v3h19V16L22,16z"/>
</g>
</svg> '._x('Header settings','bootclean'), 
		)
	); 

	$fields[] = WPBC_acf_make_radio_field(
		array( 
			'name' => 'wpbc_theme_settings__header_main_navbar_type',
			'label' => _x('Header Type','bootclean'), 
			'default_value' => 'default',
			'choices' => array (
				'default' => 'Default',
				'template' => 'Template',
				'custom' => 'Custom HTML',
			),
		),
		true
	);  

	$fields[] = WPBC_acf_make_group_navbar(array(
		'label' => 'Main Navbar Settings',
		'name' => 'wpbc_theme_settings__header_main_navbar',
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_wpbc_theme_settings__header_main_navbar_type',
					'operator' => '==',
					'value' => 'default',
				),
			), 
		),
	));

	$fields[] = array(
		'key' => 'wpbc_theme_settings__header_main_navbar_template',
		'label' => '',
		'name' => '',
		'type' => 'post_object',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_wpbc_theme_settings__header_main_navbar_type',
					'operator' => '==',
					'value' => 'template',
				),
			), 
		),
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'post_type' => array(
			0 => 'wpbc_template',
		),
		'taxonomy' => array(
		),
		'allow_null' => 0,
		'multiple' => 0,
		'return_format' => 'object',
		'ui' => 1,
	);

	$fields[] = array(
		'key' => 'wpbc_theme_settings__header_main_navbar_custom_html',
		'label' => 'Custom Html',
		'name' => 'wpbc_theme_settings__header_main_navbar_custom_html',
		'type' => 'textarea',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_wpbc_theme_settings__header_main_navbar_type',
					'operator' => '==',
					'value' => 'custom',
				),
			), 
		),
		'wrapper' => array(
			'width' => '',
			'class' => ' codemirror-custom-field lg',
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'maxlength' => '',
		'rows' => '',
		'new_lines' => '',
	);

	return $fields;
} 