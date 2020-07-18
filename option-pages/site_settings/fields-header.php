<?php

add_filter('wpbc/filter/theme_settings/fields', 'wpbc_theme_settings__header_tab', 0, 1);  

function wpbc_theme_settings__header_tab($fields){ 
	$fields[] = WPBC_acf_make_tab_field(
		array( 
			'key' => 'field_wpbc_theme_settings__header_tab',
			'label' => _x('Header','bootclean'), 
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
			'label' => _x('Header settings','bootclean'), 
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