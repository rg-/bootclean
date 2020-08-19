<?php
function WPBC_acf_make_message_field($args){
	if(empty($args['key'])) return;
	$defaults = array (
		'key' => 'field_key',
		'label' => 'Message Field',
		'name' => '',
		'type' => 'message',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'message' => '',
		'new_lines' => 'wpautop',
		'esc_html' => 0,
	);
	$field = array_merge($defaults, $args);  
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}