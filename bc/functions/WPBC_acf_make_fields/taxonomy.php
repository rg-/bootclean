<?php
function WPBC_acf_make_taxonomy_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array(
		'key' => 'field_'.$args['name'],
		'label' => '',
		'name' => 'taxonomy_field',
		'type' => 'taxonomy',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'taxonomy' => '',
		'field_type' => 'select',
		'allow_null' => 0,
		'add_term' => 0,
		'save_terms' => 0,
		'load_terms' => 0,
		'return_format' => 'id',
		'multiple' => 0,
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}  