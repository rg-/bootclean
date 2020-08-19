<?php
function WPBC_acf_make_accordion_field($args){
	if(empty($args['key'])) return;
	$defaults = array(
		'key' => 'field_key',
		'label' => 'Tab Label',
		'name' => '',
		'type' => 'accordion',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'open' => 0,
		'multi_expand' => 0,
		'endpoint' => 0,
	);
	// Here is where i can use any param or not
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}