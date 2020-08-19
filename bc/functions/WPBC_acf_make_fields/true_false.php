<?php
function WPBC_acf_make_true_false_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'True False',
		'name' => 'true_false_field',
		'type' => 'true_false',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => 'wpbc-true_false-ui',
			'id' => '',
		),
		'message' => '',
		'default_value' => 1,
		'ui' => 1,
		'ui_on_text' => '',
		'ui_off_text' => '',
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}