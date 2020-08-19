<?php
function WPBC_acf_make_subtitle_field($args){
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
			'class' => 'wpbc-subtitle',
			'id' => '',
		),
		'message' => '',
		'new_lines' => 'wpautop',
		'esc_html' => 0,
	);
	$field = array_merge($defaults, $args); 
	$field['label'] = '<h4>'.$field['label'].'</h4>';
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}