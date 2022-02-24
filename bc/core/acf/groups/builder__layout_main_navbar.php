<?php

add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__main_navbar', 10, 1);  

function WPBC_group_builder__layout__main_navbar($fields){

	$fields[] = array (
		'key' => 'field_layout_main_navbar_template__tab',
		'label' => '<svg class="wpbc-acf-tab-svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg> Main Navbar',
		'name' => '',
		'type' => 'tab',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'placement' => 'top',
		'endpoint' => 0,
	); 

	global $WPBC_VERSION;
	if ( version_compare( $WPBC_VERSION, '12.0.0', '<' ) ) {
		// OBSOLETE
		$fields[] = array (
			'key' => 'field_layout_main_navbar_template',
			'label' => __('Custom Template', 'bootclean'),
			'name' => 'layout_main_navbar_template',
			'type' => 'select',
			'instructions' => '', 
			'wrapper' => array (
				'width' => '20%', 
			),
			'choices' => array (),
			'default_value' => array (),
			'allow_null' => 1, 
			'ui' => 1, 
			'return_format' => 'value', 
		); 
	}
	if ( version_compare( $WPBC_VERSION, '11.9.9', '>' ) ) {
		
		if(!empty(WPBC_THEME_SETTINGS_ACTIVE)){
			$header_main_navbar__use = WPBC_get_theme_settings('header_main_navbar__use');
		}else{
			$header_main_navbar__use = 1;
		}
		$fields[] = WPBC_acf_make_true_false_field(
			array( 
				'name' => 'layout_main_navbar__use',
				'label' => _x('Visble','bootclean'),  
				'width' => '15',
				'default_value' => isset($header_main_navbar__use) ? $header_main_navbar__use : 1,
			)
		); 
		$fields[] = WPBC_acf_make_true_false_field(
			array( 
				'name' => 'layout_main_navbar__customize',
				'label' => _x('Customize','bootclean'), 
				'default_value' => 0,
				'width' => '15'
			)
		);   

		$fields[] = WPBC_acf_make_radio_field(
			array( 
				'name' => 'layout_main_navbar__type',
				'label' => _x('Header Type','bootclean'), 
				'default_value' => 'default',
				'choices' => array (
					
					'default' => 'Default',
					'template' => 'Template',
					'template-part' => 'Template Part (php)',
					'custom' => 'Custom HTML', 

				),
				'class' => 'wpbc-radio-as-btn as-btn-danger',
				'width' => '70',
				'conditional_logic' => array (
						array (
							array (
								'field' => 'field_layout_main_navbar__customize',
								'operator' => '==',
								'value' => '1',
							),
						), 
					),
			)
		);

		
		if(!empty(WPBC_THEME_SETTINGS_ACTIVE)){
			$defaults = WPBC_get_theme_settings('header_main_navbar_default');
		}else{
			$defaults = array();
		}

		$defaults = WPBC_clean_array_prefix( $defaults, 'header_main_navbar_default__' );
		if( !empty($defaults['nav_menu']) ){
			$default_location = false;
			$default__nav_menu = $defaults['nav_menu'];
		}else{
			$default_location = true;
			$default__nav_menu = '';
		} 

		$fields[] = WPBC_acf_make_select_nav_menu_field(array(
			'name' => 'layout_main_navbar__nav_menu',
			'label' => __('Menu', 'bootclean'),
			'default_location' => $default_location,
			'width' => '25%',  
			'default_value' => $default__nav_menu,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_layout_main_navbar__type',
						'operator' => '==',
						'value' => 'default',
					),
					array (
						'field' => 'field_layout_main_navbar__customize',
						'operator' => '==',
						'value' => '1',
					),
				),  
			),
		));

		$fields[] =  WPBC_acf_make_post_object_wpbc_template(
			array( 
				'name' => 'layout_main_navbar__template',
				'label' => _x('Navbar template','bootclean'),
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_layout_main_navbar__type',
							'operator' => '==',
							'value' => 'template',
						),
						array (
							'field' => 'field_layout_main_navbar__customize',
							'operator' => '==',
							'value' => '1',
						),
					), 
				),
			)
		); 

		$fields[] =  WPBC_acf_make_select_template_part_field(
			array( 
				'name' => 'layout_main_navbar__template_part',
				'label' => _x('Navbar template part','bootclean'),
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_layout_main_navbar__type',
							'operator' => '==',
							'value' => 'template-part',
						),
						array (
							'field' => 'field_layout_main_navbar__customize',
							'operator' => '==',
							'value' => '1',
						),
					), 
				),
			)
		); 

		$fields[] =  WPBC_acf_make_codemirror_field(
			array( 
				'name' => 'layout_main_navbar__custom_html',
				'label' => _x('Navbar Custom Html','bootclean'),
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_layout_main_navbar__type',
							'operator' => '==',
							'value' => 'custom',
						),
						array (
							'field' => 'field_layout_main_navbar__customize',
							'operator' => '==',
							'value' => '1',
						),
					), 
				),
			)
		); 
 
	}

	$fields = apply_filters('wpbc/filter/layout__main_navbar', $fields);

	return $fields;
}