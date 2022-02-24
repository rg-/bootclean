<?php
function WPBC_acf_make_group_navbar($args,$is_registered_option=false){
	$label = $args['label'];
	$name = $args['name']; 
	$field = array (
		'key' => 'field_'.$name,
		'label' => $label,
		'name' => $name,
		'type' => 'group',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => (!empty($args['conditional_logic'])) ? $args['conditional_logic'] : 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => array (

			array (
				'key' => 'field_'.$name.'_navbar_message',
				'label' => '<h4>Navbar</h4>', 
				'type' => 'message', 
				'wrapper' => array ( 
					'class' => 'wpbc-subtitle', 
				),
			),
			array (
				'key' => 'field_'.$name.'_class',
				'label' => 'Navbar Class',
				'name' => 'class',
				'type' => 'text', 
				'default_value' => '', 
			),

			array (
				'key' => 'field_'.$name.'_nav_attrs',
				'label' => 'Navbar Attrs',
				'name' => 'nav_attrs',
				'type' => 'text', 
				'default_value' => '', 
				'placeholder' => ' ej: data-affix-removeclass="something" data-affix-addclass="something-else" '
			),


		),
	);
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field; 
}

function WPBC_acf_build_navbar_group($fields, $name, $settings_type = 'settings'){ 
	 
	$fields[] = WPBC_acf_make_message_field(
		array( 
			'key' => 'field_'.$name.'_navbrand_message',
			'label' => _x('Default settings','bootclean'),  
			'width' => '100', 
			'class' => 'wpbc-acf-highlighted-field wpbc-field-no-padding-bottom',   
		)
	);

	$fields[] = WPBC_acf_make_select_nav_menu_field(array(
		'name' => $name.'_nav_menu',
		'label' => __('Menu', 'bootclean'),
		'default_location' => true,
		'width' => '25%',   
	));
	$fields[] = WPBC_acf_make_select_field(array(
		'name' => $name.'_navbar_type',
		'label' => __('Type', 'bootclean'), 
		'width' => '25%',

		// default, fixed-top, absolute-top, fixed-scroll-up
		'choices' => array (
			'default' => 'default',
			'fixed-top' => 'fixed-top',
			'absolute-top' => 'absolute-top',
			'fixed-scroll-up' => 'fixed-scroll-up',
		),
		'default_value' => 'default',
	));

	$fields[] = WPBC_acf_make_true_false_field(array(
		'name' => $name.'_affix_simulate',
		'label' => __('Simulate height', 'bootclean'), 
		'width' => '20%',   
		'default_value' => 1,
		'conditional_logic' => array (
				array (
					array (
						'field' => 'field_'.$name.'_navbar_type',
						'operator' => '!=',
						'value' => 'default',
					),
				), 
			),
	));  


	$fields[] = WPBC_acf_make_url_field(
		array( 
			'name' => $name.'_navbrand_url',
			'label' => _x('Logo Image','bootclean'),  
			'width' => '100',
			'class' => 'wpbc-acf-flex-field',
		)
	); 
	$fields[] = WPBC_acf_make_number_field(
		array( 
			'name' => $name.'_navbrand_width',
			'label' => _x('Image width','bootclean'),  
			'width' => '50',
			'append' => 'px',
			'min' => '0',
			'class' => 'wpbc-acf-flex-field',
		)
	); 
	$fields[] = WPBC_acf_make_number_field(
		array( 
			'name' => $name.'_navbrand_height',
			'label' => _x('Image height','bootclean'),  
			'width' => '50',
			'append' => 'px',
			'min' => '0',
			'class' => 'wpbc-acf-flex-field',
		)
	); 
 
	$fields[] = WPBC_acf_make_radio_field( array(
		'name' => $name.'_nav_background',
		'label'=>  _x('Background color','bootclean'),
		'choices' => WPBC_get_acf_root_colors_choices($name.'_nav_background'),
		'default_value' => 'primary', 
		'class' => 'wpbc-radio-as-btn no-padding-radio-label wpbc-acf-flex-field'
	) );
	$fields[] = WPBC_acf_make_radio_field( array(
		'name' => $name.'_nav_color',
		'label'=>  _x('Text color','bootclean'),
		'choices' => WPBC_get_acf_root_colors_choices($name.'_nav_color','none'),
		'default_value' => 'white', 
		'class' => 'wpbc-radio-as-btn no-padding-radio-label wpbc-acf-flex-field'
	) );


	// WHen affix
	$fields[] = WPBC_acf_make_message_field(
		array( 
			'key' => 'field_'.$name.'_navbrand_message_affix',
			'label' => _x('When Affix (optional)','bootclean'),  
			'width' => '100', 
			'class' => 'wpbc-acf-highlighted-field wpbc-field-no-padding-bottom',
			'message' => _x('Only when using fixed-¨ Type. Apply when scrolling the page.','bootclean'),  
		)
	); 
	$fields[] = WPBC_acf_make_url_field(
		array( 
			'name' => $name.'_affix_navbrand_url',
			'label' => _x('Logo Image','bootclean'),  
			'width' => '100',
			'class' => 'wpbc-acf-flex-field',
		)
	); 
	$fields[] = WPBC_acf_make_number_field(
		array( 
			'name' => $name.'_affix_navbrand_width',
			'label' => _x('Image width','bootclean'),  
			'width' => '50',
			'append' => 'px',
			'min' => '0',
			'class' => 'wpbc-acf-flex-field',
		)
	); 
	$fields[] = WPBC_acf_make_number_field(
		array( 
			'name' => $name.'_affix_navbrand_height',
			'label' => _x('Image height','bootclean'),  
			'width' => '50',
			'append' => 'px',
			'min' => '0',
			'class' => 'wpbc-acf-flex-field',
		)
	);  
	$fields[] = WPBC_acf_make_radio_field( array(
		'name' => $name.'_affix_nav_background',
		'label'=>  _x('Background color','bootclean'),
		'choices' => WPBC_get_acf_root_colors_choices($name.'_affix_nav_background'),
		'default_value' => 'primary', 
		'class' => 'wpbc-radio-as-btn no-padding-radio-label wpbc-acf-flex-field'
	) );
	$fields[] = WPBC_acf_make_radio_field( array(
		'name' => $name.'_affix_nav_color',
		'label'=>  _x('Text color','bootclean'),
		'choices' => WPBC_get_acf_root_colors_choices($name.'_affix_nav_color','none'),
		'default_value' => 'white', 
		'class' => 'wpbc-radio-as-btn no-padding-radio-label wpbc-acf-flex-field'
	) );


	// Alt navbar
	$fields[] = WPBC_acf_make_message_field(
		array( 
			'key' => 'field_'.$name.'_navbrand_message_alt',
			'label' => _x('Alternative/Inverted (optional)','bootclean'),  
			'width' => '100', 
			'class' => 'wpbc-acf-highlighted-field wpbc-field-no-padding-bottom',
			'message' => _x('Use filters on functions code to use if needed.','bootclean'),  
		)
	); 
	$fields[] = WPBC_acf_make_url_field(
		array( 
			'name' => $name.'_alt_navbrand_url',
			'label' => _x('Logo Image','bootclean'),  
			'width' => '100',
			'class' => 'wpbc-acf-flex-field',
		)
	); 
	$fields[] = WPBC_acf_make_number_field(
		array( 
			'name' => $name.'_alt_navbrand_width',
			'label' => _x('Image width','bootclean'),  
			'width' => '50',
			'append' => 'px',
			'min' => '0',
			'class' => 'wpbc-acf-flex-field',
		)
	); 
	$fields[] = WPBC_acf_make_number_field(
		array( 
			'name' => $name.'_alt_navbrand_height',
			'label' => _x('Image height','bootclean'),  
			'width' => '50',
			'append' => 'px',
			'min' => '0',
			'class' => 'wpbc-acf-flex-field',
		)
	);  
	$fields[] = WPBC_acf_make_radio_field( array(
		'name' => $name.'_alt_nav_background',
		'label'=>  _x('Background color','bootclean'),
		'choices' => WPBC_get_acf_root_colors_choices($name.'_alt_nav_background'),
		'default_value' => 'primary', 
		'class' => 'wpbc-radio-as-btn no-padding-radio-label wpbc-acf-flex-field'
	) );
	$fields[] = WPBC_acf_make_radio_field( array(
		'name' => $name.'_alt_nav_color',
		'label'=>  _x('Text color','bootclean'),
		'choices' => WPBC_get_acf_root_colors_choices($name.'_alt_nav_color','none'),
		'default_value' => 'white', 
		'class' => 'wpbc-radio-as-btn no-padding-radio-label wpbc-acf-flex-field'
	) );

	return $fields;
} 