<?php
function WPBC_acf_make_post_object_wpbc_template($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array(
		'key' => 'field_'.$args['name'],
		'label' => _x('Select the Template to use','bootclean'),
		'name' => '',
		'type' => 'post_object',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'post_type' => array( 'wpbc_template' ),
		'taxonomy' => array( ),
		'allow_null' => 0,
		'multiple' => 0,
		'return_format' => 'id',
		'ui' => 1,
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}  