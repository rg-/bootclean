<?php

function WPBC_acf_make_color_styles_group_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;

	$sub_fields = array();

	$sub_fields[] = WPBC_acf_make_color_picker_field(array(
		'label' => __('Background color'),
		'name' => $args['name'].'__background-color',
		'width' => '40',
		'class' => 'wpbc-ui-mini',
	));

	$sub_fields[] = WPBC_acf_make_color_picker_field(array(
		'label' => __('Text color'),
		'name' => $args['name'].'__text-color',
		'width' => '40',
		'class' => 'wpbc-ui-mini',
	));

	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Group Field',
		'name' => 'group_field',
		'type' => 'group',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => $sub_fields,
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}