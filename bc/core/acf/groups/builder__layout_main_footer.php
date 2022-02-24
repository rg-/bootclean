<?php

add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__main_footer', 30, 1); 

function WPBC_group_builder__layout__main_footer($fields){
	$fields[] = array (
		'key' => 'field_layout_footer__tab',
		'label' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M21 3H3c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H3V5h18v14zM5 15h14v3H5z"/></svg> Main Footer',
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
	if ( version_compare( $WPBC_VERSION, '11.9.9', '>' ) ) {	
		
		$fields[] = WPBC_acf_make_true_false_field(
			array( 
				'name' => 'layout_footer__use',
				'label' => _x('Visble','bootclean'), 
				'default_value' => 1,
				'width' => '15'
			)
		);  

		$fields[] = WPBC_acf_make_radio_field(
			array( 
				'name' => 'layout_footer_template_type',
				'label' => _x('Footer Type','bootclean'), 
				'default_value' => 'default',
				'choices' => array (
					
					'default' => 'Default',
					'template' => 'Template',
					'template-part' => 'Template Part (php)',
					'custom' => 'Custom HTML', 

				),
				'class' => 'wpbc-radio-as-btn as-btn-danger', 
				'width' => '85'
			)
		);  

		$fields[] =  WPBC_acf_make_post_object_wpbc_template(
			array( 
				'name' => 'layout_footer_template',
				'label' => _x('Footer template','bootclean'),
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_layout_footer_template_type',
							'operator' => '==',
							'value' => 'template',
						),
					), 
				),
			)
		); 

		$fields[] =  WPBC_acf_make_select_template_part_field(
		array( 
			'name' => 'layout_footer_template_part',
			'label' => _x('Footer template part','bootclean'),
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_layout_footer_template_type',
						'operator' => '==',
						'value' => 'template-part',
					),
				), 
			),
		)
	); 

	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'layout_footer_custom_html',
			'label' => _x('Footer Custom Html','bootclean'),
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_layout_footer_template_type',
						'operator' => '==',
						'value' => 'custom',
					),
				), 
			),
		)
	); 

	}else{
		$fields[] = array (
		'key' => 'field_layout_footer_template',
		'label' => 'Main Footer Template',
		'name' => 'layout_footer_template',
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
	return $fields;
}