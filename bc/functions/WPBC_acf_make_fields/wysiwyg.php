<?php
function WPBC_acf_make_wysiwyg_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Wysiwyg Editor Field',
		'name' => 'wysiwyg_editor_field',
		'type' => 'wysiwyg',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
		'tabs' => 'all', // 'all',
		'toolbar' => 'basic', // 'full',
		'media_upload' => 0,
		'delay' => 1,
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}