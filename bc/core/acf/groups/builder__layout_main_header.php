<?php

add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__main_header', 20, 1);

function WPBC_group_builder__layout__main_header($fields){
	$fields[] = array (
		'key' => 'field_layout_header__tab',
		'label' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 11h-8v6h8v-6zm4 8V4.98C23 3.88 22.1 3 21 3H3c-1.1 0-2 .88-2 1.98V19c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2zm-2 .02H3V4.97h18v14.05z"/></svg> Page Header',
		'name' => '',
		'type' => 'tab',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'placement' => 'top',
		'endpoint' => 0,
	);

	$fields[] = array (
		'key' => 'field_layout_header_template_type',
		'label' => __('Choose Type','bootclean'),
		'name' => 'layout_header_template_type',
		'type' => 'select',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '20%',
			'class' => '',
			'id' => '',
		),
		'choices' => array ( 
			'none' => __('None','bootclean'),
			'title' => __('Use Page Title','bootclean'),
			'template' => __('Template','bootclean'),
			'html' => __('HTML','bootclean'),
		),
		'default_value' => array (
			'none' => 'None',
		),
		'allow_null' => 0,
		'multiple' => 0,
		'ui' => 0,
		'ajax' => 0,
		'return_format' => 'value',
		'placeholder' => '',
	); 

	$fields[] = array (
		'key' => 'field_layout_header_template',
		'label' => 'Page Header Template',
		'name' => 'layout_header_template',
		'type' => 'select',
		'instructions' => '', 
		'wrapper' => array (
			'width' => '20%', 
		),
		'choices' => array (),
		'default_value' => array (),
		'allow_null' => 1, 
		'ui' => 1, 
		'return_format' => 'value', 
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_layout_header_template_type',
					'operator' => '==',
					'value' => 'template',
				),
			), 
		),
	);   
	return $fields;
}  

/*
	Page Header Class
*/
add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__main_header_class', 20.5, 1);  
function WPBC_group_builder__layout__main_header_class($fields){ 
	$fields[] = WPBC_acf_make_text_field(array(
		'name' => 'layout_header_template_class', 
		'label' => __('Page Header Class','bootclean'),
		'class' => '',
		'width' => '30%',
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_layout_header_template_type',
					'operator' => '!=',
					'value' => 'none',
				),
			), 
		),
	));

	return $fields;
} 
/*

*/
add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__main_header_page_title', 20.6, 1);
function WPBC_group_builder__layout__main_header_page_title($fields){
	
	$fields[] = WPBC_acf_make_true_false_field(array(
		'name' => 'layout_header_template_page_title_custom',
		'label' => __('Custom Title?', 'bootclean'),
		'width' => '25%',
		'default_value' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_layout_header_template_type',
					'operator' => '==',
					'value' => 'title',
				),
			), 
		),
	));

	$fields[] = WPBC_acf_make_true_false_field(array(
		'name' => 'layout_header_template_page_title_type',
		'label' => __('Inclulde subtitle/lead?', 'bootclean'),
		'width' => '25%',
		'default_value' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_layout_header_template_type',
					'operator' => '==',
					'value' => 'title',
				),
			), 
		),
	));
	$fields[] = WPBC_acf_make_textarea_field(array(
		'name' => 'layout_header_template_page_title_custom_title', 
		'label' => __('Custom Title','bootclean'),
		'class' => 'acf-input-title',
		'width' => '100%',
		'conditional_logic' => array ( 
			array (
				array (
					'field' => 'field_layout_header_template_type',
					'operator' => '==',
					'value' => 'title',
				),
				array (
					'field' => 'field_layout_header_template_page_title_custom',
					'operator' => '==',
					'value' => 1,
				),
			), 
		),
	));
	$fields[] = WPBC_acf_make_textarea_field(array(
		'name' => 'layout_header_template_page_title_subtitle', 
		'label' => __('Subtitle / Lead','bootclean'),
		'class' => '',
		'width' => '100%',
		'conditional_logic' => array ( 
			array (
				array (
					'field' => 'field_layout_header_template_type',
					'operator' => '==',
					'value' => 'title',
				),
				array (
					'field' => 'field_layout_header_template_page_title_type',
					'operator' => '==',
					'value' => 1,
				),
			), 
		),
	));
	return $fields;
}

/*
	
*/

add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__main_header_template_html', 21, 1); 

function WPBC_group_builder__layout__main_header_template_html($fields){
	$fields[] = array (
		'key' => 'field_layout_header_template_html',
		'label' => 'Page Header Custom HTML',
		'name' => 'layout_header_template_html',
		'type' => 'textarea',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_layout_header_template_type',
					'operator' => '==',
					'value' => 'html',
				),
			), 
		),
		'wrapper' => array (
			'width' => '100%',
			'class' => 'codemirror-custom-field md',
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