<?php
function WPBC_acf_make_group_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
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
		'sub_fields' => array (
		),
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}
function WPBC_acf_make_group($args,$is_registered_option=false){
	if(empty($args['name'])) return; 
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Group field',
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
		'sub_fields' => array (),
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field; 
}