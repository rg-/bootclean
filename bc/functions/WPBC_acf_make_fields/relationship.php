<?php
function WPBC_acf_make_relationship_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array(
		'key' => 'field_'.$args['name'],
		'label' => '',
		'name' => 'relation_field',
		'type' => 'relationship',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'post_type' => array( ),
		'taxonomy' => '',
		'filters' => array( ),
		'elements' => '',
		'min' => '',
		'max' => '',
		'return_format' => 'object'
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}  