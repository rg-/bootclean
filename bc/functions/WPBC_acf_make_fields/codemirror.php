<?php
function WPBC_acf_make_codemirror_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => _x('Insert custom Html','bootclean'),
		'name' => 'codemirror_field',
		'type' => 'textarea',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => ' codemirror-custom-field md',
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'maxlength' => '',
		'rows' => '',
		'new_lines' => '',
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}