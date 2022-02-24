<?php

function WPBC_acf_make_flexible_social_field($args,$is_registered_option=false){

	if(empty($args['name'])) return; 

	$layouts = array(); 

		$social = array(
			array('Facebook','facebook'),
			array('Instagram','instagram'),
			array('Twitter','twitter'),
			array('Linkedin','linkedin'),
			array('Google Maps','google-maps'),
			array('Youtube','youtube'),
			array('Whatsapp','whatsapp'),
		);
		
		$social = apply_filters('wpbc/filter/settings/social_networks', $social);

		foreach( $social as $key=>$value ){
			$social_name = $value[0];
			$social_slug = $value[1]; 
			
			$sub_fields = array();

			$sub_fields[] = WPBC_acf_make_url_field(array(
				'name' => $args['name'].'_'.$social_slug.'_url',
				'label' => 'URL',
				'width' => '70',
				'class' => 'wpbc-acf-flex-field',
			));

			$sub_fields[] = WPBC_acf_make_text_field(array(
				'name' => $args['name'].'_'.$social_slug.'_label',
				'label' => 'Label',
				'width' => '30',
				'placeholder' => 'Label (optional)',
				'class' => 'wpbc-acf-no-label',
			));

		$layouts['layout_'.$args['name'].'_'.$social_slug] = array(
			'key' => 'layout_'.$args['name'].'_'.$social_slug,
			'name' => $args['name'].'_'.$social_slug,
			'label' => $social_name,
			'display' => 'block',
			'sub_fields' => $sub_fields,
			'min' => '',
			'max' => '1',
		);

	}

	// the field itself
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'flexible Field',
		'name' => 'flexible content',
		'type' => 'flexible_content',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),  
		'layouts' => $layouts,
		'button_label' => _x('Add item', 'bootclean'),
		'min' => '',
		'max' => '',
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}