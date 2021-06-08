<?php
function WPBC_acf_make_checkbox_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Checkbox field',
		'name' => 'name_checkbox',
		'type' => 'checkbox',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'choices' => array ( ),
		'allow_custom' => 0,
		'save_custom' => 0,
		'default_value' => array ( ),
		'layout' => 'horizontal',
		'toggle' => 0,
		'return_format' => 'value',
		);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}