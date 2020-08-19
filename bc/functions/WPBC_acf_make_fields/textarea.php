<?php
function WPBC_acf_make_textarea_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Textarea Field',
		'name' => 'textarea_field',
		'type' => 'textarea',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
		'width' => '',
		'class' => '',
		'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'maxlength' => '',
		'rows' => '3',
		'new_lines' => '',
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}