<?php
function WPBC_acf_make_radio_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Radio field',
		'name' => 'name_radio',
		'type' => 'radio',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'choices' => array (),
		'default_value' => '',
		'allow_null' => 0,
		'other_choice' => 0,
		'save_other_choice' => 0,
		'layout' => 'horizontal',
		'return_format' => 'value',
		);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}