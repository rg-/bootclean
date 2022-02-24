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
					'location' => 'Location',
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


function WPBC_acf_make_social_group_field($args,$is_registered_option=false){
	if(empty($args['name'])) return; 

	$social_choices = array (
		'facebook' => 'Facebook', 
		'instagram' => 'Instagram', 
		'twitter' => 'Twitter', 
		'linkedin' => 'Linkedin', 
		'whatsapp' => 'Whatsapp',
		'google-maps' => 'Google Maps',
		'youtube' => 'Youtube'
	);
	
	$social_choices = apply_filters('wpbc/filter/settings/social_choices', $social_choices);

	$sub_fields = array();

	if(!empty($social_choices)){
		foreach ($social_choices as $key => $value) {
			$sub_fields[] = WPBC_acf_make_url_field( array( 
				'name' => $args['name'].'__url_'.$key,
				'label'=> '<span style="width:80px; padding-right:6px; display:inline-block; ">'.$value.'</span>',  
				'class' => 'wpbc-acf-flex-field',
				'width' => '70%',
			) );
			$sub_fields[] = WPBC_acf_make_text_field( array( 
				'name' => $args['name'].'__label_'.$key,
				'label'=> __('Label','bootclean'),  
				'class' => 'wpbc-acf-no-label',
				'placeholder' =>  __('Label (optional)','bootclean'),
				'width' => '30%',
			) );
		} 
	}

	// the field itself
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Group Field',
		'name' => 'group',
		'type' => 'group',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		), 
		'layout' => 'block', 
		'sub_fields' => $sub_fields,
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}