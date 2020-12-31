<?php
function WPBC_acf_make_social_items_group_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;

	$sub_fields_prefix = 'social_items';

	$sub_fields = array();

		$sub_fields[] = WPBC_acf_make_select_field( array(
				'name' => $sub_fields_prefix.'_type',
				'label'=> _x('Type','bootclean'), 
				'choices' => array (
					'facebook' => 'Facebook', 
					'instagram' => 'Instagram', 
					'twitter' => 'Twitter', 
					'linkedin' => 'Linkedin', 
					'whatsapp' => 'Whatsapp',
				),
				'default_value' => !empty($args['default_type']) ? $args['default_type'] : 'facebook',
				'width' => '20%',
				'class' => ''
			) );
		$sub_fields[] = WPBC_acf_make_url_field( array(
				'name' => $sub_fields_prefix.'_url',
				'label' => _x('Url','bootclean'),
				'placeholder' => '',
				'width' => '80%',
			) );

	// the field itself
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Repeater Field',
		'name' => 'repeater_field',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => 0,
		'max' => 0,
		'layout' => 'block',
		'button_label' => _x('Add Item','bootclean'),
		'sub_fields' => $sub_fields,
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}