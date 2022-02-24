<?php
function WPBC_acf_make_radio_position_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => _x('Position','bootclean'),
		'name' => 'name_radio_position',
		'type' => 'radio',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => 'wpbc-radio-as-btn as-btn-sm no-padding-radio-label wpbc-radio-as-position',
			'id' => '',
		), 

		'choices' => array (
				
				'top-left' => '<i class="radio-icon"></i>',
				'top-center' => '<i class="radio-icon"></i>',
				'top-right' => '<i class="radio-icon"></i>',

				'center-left' => '<i class="radio-icon"></i>',
				'center-center' => '<i class="radio-icon"></i>',
				'center-right' => '<i class="radio-icon"></i>',

				'bottom-left' => '<i class="radio-icon"></i>',
				'bottom-center' => '<i class="radio-icon"></i>',
				'bottom-right' => '<i class="radio-icon"></i>',

			),

		'default_value' => 'center-center',
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