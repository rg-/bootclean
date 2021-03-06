<?php
function WPBC_acf_make_flexible_content($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Flexible field',
		'name' => 'flexible_field',
		'type' => 'flexible_content',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layouts' => array(),
		'button_label' => _x('Add row','bootclean'),
		'min' => 1,
		'max' => 6,
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}