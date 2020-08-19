<?php

add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__code', 99, 1); 

function WPBC_group_builder__layout__code($fields){
	$fields[] = array (
		'key' => 'field_layout_code__tab',
		'label' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/></svg> '._x('Custom Code','bootclean'),
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
		'label' => 'Body Class',
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