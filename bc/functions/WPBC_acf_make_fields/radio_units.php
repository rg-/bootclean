<?php
function WPBC_acf_make_radio_units_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => _x('Units','bootclean'),
		'name' => 'name_radio',
		'type' => 'radio',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => 'wpbc-radio-as-btn wpbc-ui-mini ui-xmini as-btn-danger',
			'id' => '',
		),
		'choices' => array (
				'px' => 'px',
				'%' => '%',
				'vh' => 'vh',
				'wh' => 'wh', 
			),
		'default_value' => 'px',
		'allow_null' => 0,
		'other_choice' => 0,
		'save_other_choice' => 0,
		'layout' => 'horizontal',
		'return_format' => 'value',
		);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}