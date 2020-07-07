<?php

add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__code', 99, 1); 

function WPBC_group_builder__layout__code($fields){
	$fields[] = array (
		'key' => 'field_layout_code__tab',
		'label' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg> Custom Styles',
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
		'key' => 'field_layout_code__body_class',
		'label' => 'Body CLASS',
		'name' => 'layout_code_body_class',
		'type' => 'text',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
	);

	$fields[] = array (
		'key' => 'field_layout_code__clone',
		'label' => 'Item',
		'name' => 'layout_code_styles',
		'type' => 'clone',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'clone' => array(
			0 => 'field_group_code_styles',
		),
		'display' => 'seamless',
		'layout' => 'block',
		'prefix_label' => 0,
		'prefix_name' => 0,
	);

	$fields[] = array (
		'key' => 'field_layout_code__tab_end',
		'label' => '',
		'name' => '',
		'type' => 'tab', 
		'placement' => 'top',
		'endpoint' => 1,
	);

	return $fields;
}  