<?php

if ( version_compare( $WPBC_VERSION, '9.0.1', '<' ) ) { 

	add_filter('WPBC_group_builder__layout', function($fields){

		$fields[] = array (
			'key' => 'field_layout_main_content__tab',
			'label' => 'Main Content',
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

		/*
		$layout_main_content_choices = WPBC_get_layout_main_content_choices(true, true);

		$fields[] = array (
			'key' => 'field_layout_main_content_template',
			'label' => 'Main Content Template',
			'name' => 'main_content_template',
			'type' => 'radio',
			'value' => NULL,
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => 'radio-as-thumb',
				'id' => '',
			),
			'choices' => $layout_main_content_choices,
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => $layout_main_content_choices[0],
			'layout' => 'horizontal',
			'return_format' => 'value',
		);
		*/

	 	$fields[] = array (
			'key' => 'field_layout_main_content_custom',
			'label' => 'Enable for custom settings.',
			'name' => 'main_content_custom',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		); 

		/*
		
		Using default classes to populate initialy the fields
		This should be defaults for "reusables" $type, later i will swapp builder defaults with js only
		*/

		$default_or_options_classes = WPBC_get_layout_main_content_default_or_options_classes('defaults');

		$fields[] = array (
			'key' => 'field_layout_main_content_container_class',
			'label' => __( 'Container class', 'bootclean' ),
			'name' => 'main_content_container_class',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_layout_main_content_custom',
						'operator' => '==',
						'value' => '1',
					),
				), 
			),
			'wrapper' => array (
				'width' => '20%',
				'class' => '',
				'id' => '',
			),
			'default_value' => $default_or_options_classes['container']['class'],
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		);

		$fields[] = array (
			'key' => 'field_layout_main_content_container_row_class',
			'label' => __( 'Container > Row class', 'bootclean' ),
			'name' => 'main_content_container_row_class',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_layout_main_content_custom',
						'operator' => '==',
						'value' => '1',
					),
				), 
			),
			'wrapper' => array (
				'width' => '25%',
				'class' => '',
				'id' => '',
			),
			'default_value' => $default_or_options_classes['container']['row'],
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		);

		$fields[] = array (
			'key' => 'field_layout_main_content_container_col_content_class',
			'label' => __( 'Main content column class', 'bootclean' ),
			'name' => 'main_content_container_col_content_class',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_layout_main_content_custom',
						'operator' => '==',
						'value' => '1',
					),
				), 
			),
			'wrapper' => array (
				'width' => '25%',
				'class' => '',
				'id' => '',
			),
			'default_value' => $default_or_options_classes['container']['col_content'],
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		);

		$fields[] = array (
			'key' => 'field_layout_main_content_container_col_sidebar_class',
			'label' => __( 'Secondary content column class', 'bootclean' ),
			'name' => 'main_content_container_col_sidebar_class',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_layout_main_content_custom',
						'operator' => '==',
						'value' => '1',
					),
				), 
			),
			'wrapper' => array (
				'width' => '20%',
				'class' => '',
				'id' => '',
			),
			'default_value' => $default_or_options_classes['container']['col_sidebar'],
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		);

		return $fields;

	}, 25, 1); 

} 