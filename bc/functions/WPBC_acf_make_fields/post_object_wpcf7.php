<?php
function WPBC_acf_make_post_object_wpcf7_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array(
		'key' => 'field_'.$args['name'],
		'label' => '',
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
		'post_type' => array(
			0 => 'wpcf7_contact_form',
		),
		'taxonomy' => array(
		),
		'allow_null' => 0,
		'multiple' => 0,
		'return_format' => 'id',
		'ui' => 1,
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}  