<?php

// -------------------------------------------------------------------------- //
if( function_exists('acf_add_local_field_group') ){ 
	
	/*
	
		#Flexible group
	
	*/

	// Main Content Builder

	$WPBC_group_builder__flexible_content_locations = array( 
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => '_template_builder.php',
				)
			),  
			/*

			OBSOLETE, see wpbc_template default/slider

			*/ 
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'wpbc_template',
				),
				array(
					'param' => 'post_taxonomy',
					'operator' => '==',
					'value' => 'wpbc_template_type:default',
				), 
				array(
					'param' => 'post_taxonomy',
					'operator' => '!=',
					'value' => 'wpbc_template_type:slider',
				), 
			),
	); 
	$WPBC_group_builder__flexible_content_locations = apply_filters('wpbc/filter/acf/builder/flexible_content_locations',$WPBC_group_builder__flexible_content_locations);

	$layouts_main_content = WPBC_acf_builder_layouts();
	acf_add_local_field_group(array(
		'key' => 'group_builder__flexible',
		'title' => 'Main Content Builder',
		'fields' => array(
			array(
				'key' => 'key__flexible_content_rows', 
				'label' => 'Content Rows',
				'name' => 'content_rows',
				'type' => 'flexible_content',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layouts' => $layouts_main_content,
				'button_label' => __('Add Layout Row','bootclean'),
				'min' => '',
				'max' => '',
			),
		),
		'location' => $WPBC_group_builder__flexible_content_locations,
		'menu_order' => 3,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	if ( version_compare( $WPBC_VERSION, '9.0.0', '>' ) ) {
		// Secondary Content Builder
		$content_areas = WPBC_get_main_container_max_content_areas();
		//$content_areas = $content_areas -1;

		$group_builder__flexible_secondary__fields = array();

		$group_builder__flexible_secondary__fields[] = array (
			'key' => 'field__secondary_content_rows_message',
			'label' => 'Manange here your secondary content areas.',
			'name' => '',
			'type' => 'message',
			'instructions' => 'Placement > Main Content Template defaults or page settings.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		);
		
		for ($i=1; $i < $content_areas; $i++) { 
			$group_builder__flexible_secondary__fields[] = array(
				'key' => 'key__flexible_secondary_content_rows_'.$i, 
				'label' => 'Secondary Content Area '.$i,
				'name' => 'secondary_content_rows_'.$i,
				'type' => 'flexible_content',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layouts' => WPBC_acf_builder_layouts(),
				'button_label' => 'Add Row',
				'min' => '',
				'max' => '',
			);
		}
	}else{
		$group_builder__flexible_secondary__fields =  array(
			array (
				'key' => 'field__secondary_content_rows_message',
				'label' => 'Manange here your secondary content areas.',
				'name' => '',
				'type' => 'message',
				'instructions' => 'Placement > Main Content Template defaults or page settings.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			),
			array(
				'key' => 'key__flexible_secondary_content_rows', 
				'label' => 'Content Rows',
				'name' => 'secondary_content_rows',
				'type' => 'flexible_content',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layouts' => WPBC_acf_builder_layouts(),
				'button_label' => 'Add Row',
				'min' => '',
				'max' => '',
			),
		);
	}
	
	$WPBC_group_builder__secondary_layout_locations = array( 
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				), 
			),
	); 
	$WPBC_group_builder__secondary_layout_locations = apply_filters('wpbc/filter/acf/builder/secondary_layout_locations',$WPBC_group_builder__secondary_layout_locations);

	acf_add_local_field_group(array(
		'key' => 'group_builder__flexible_secondary',
		'title' => 'Secondary Content Builder',
		'fields' => $group_builder__flexible_secondary__fields,
		'location' => $WPBC_group_builder__secondary_layout_locations,
		'menu_order' => 4,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));


	/*
		Since this position do not exists, this group will be no visible, but the hide_on_screen works! 
		Also needs menu_order to be === 0 

		That´s the main idea for this group in fact.
	*/
	acf_add_local_field_group(array(
		'key' => 'group_builder__settings',
		'title' => 'Content Builder',
		'fields' => array(
			array (
				'key' => 'field_builder__settings_message',
				'label' => 'You are using Content Builder',
				'name' => '',
				'type' => 'message',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			),
		),
		'location' => $WPBC_group_builder__flexible_content_locations,
		'menu_order' => 0,
		'position' => 'aside', 
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'the_content',
		),
		'active' => 1,
		'description' => '',
	));
	
	// #Flexible group <<<
}
// -------------------------------------------------------------------------- // 