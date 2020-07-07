<?php


	/*
		Group Fields
	*/

	if( function_exists('acf_add_local_field_group') ){ 
		
		$fields = WPBC_get_theme_settings_fields();
		$menu_slug = WPBC_get_theme_settings_args('menu_slug'); 
		acf_add_local_field_group(array(
			'key' => 'group_wpbc_theme_settings',
			'title' => __('Theme Settings','bootclean-child'),
			'fields' => $fields,
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => $menu_slug,
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		));

	} 