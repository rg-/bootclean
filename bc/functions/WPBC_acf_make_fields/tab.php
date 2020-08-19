<?php
function WPBC_acf_make_tab_field($args){
	if(empty($args['key'])) return;
	$defaults = array(
		'key' => 'field_key',
		'label' => 'Tab Label',
		'name' => '',
		'type' => 'tab',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'placement' => 'left',
		'endpoint' => 0,
	);
	// Here is where i can use any param or not
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}