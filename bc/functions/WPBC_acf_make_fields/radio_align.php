<?php
function WPBC_acf_make_radio_align_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => _x('Units','bootclean'),
		'name' => 'name_radio_align',
		'type' => 'radio',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => 'wpbc-radio-as-btn as-btn-sm no-padding-radio-label',
			'id' => '',
		), 

		'choices' => array (
				'left' => '<i class="mce-ico mce-i-alignleft"></i>',
				'center' => '<i class="mce-ico mce-i-aligncenter"></i>',
				'right' => '<i class="mce-ico mce-i-alignright"></i>',
				'inherit' => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8 0-1.85.63-3.55 1.69-4.9L16.9 18.31C15.55 19.37 13.85 20 12 20zm6.31-3.1L7.1 5.69C8.45 4.63 10.15 4 12 4c4.42 0 8 3.58 8 8 0 1.85-.63 3.55-1.69 4.9z"/></svg>', 
			),

		'default_value' => 'left',
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