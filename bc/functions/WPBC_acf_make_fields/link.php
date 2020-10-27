<?php

function WPBC_acf_make_link_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array(
		'key' => 'field_'.$args['name'],
		'label' => '',
		'name' => 'link_field',
		'type' => 'link',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'return_format' => 'array',
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}  