<?php
function WPBC_acf_make_text_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Text Field',
		'name' => 'text_field',
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
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}