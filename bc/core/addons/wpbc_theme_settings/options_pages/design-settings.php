<?php 

$args = WPBC_get_theme_settings_args();

if( function_exists('acf_add_options_page') ) { 
 
		$child_page = acf_add_options_sub_page(array(

			'page_title'  => __('Design Settings','bootclean'),
      'menu_title'  => __('Design','bootclean'), 
      'menu_slug' => 'wpbc-theme-settings-design',
      'parent_slug' => $args['options_page']['menu_slug'],
      'capability' => 'edit_theme_options',

		));  

}  

add_filter('wpbc/filter/theme_settings/design_fields', 'wpbc_theme_settings__layout_tab', 30, 1); 
add_filter('wpbc/filter/theme_settings/design_fields', 'wpbc_theme_settings__layout_locations_header', 35, 1);
add_filter('wpbc/filter/theme_settings/design_fields', 'wpbc_theme_settings__layout_locations', 36, 1);

function wpbc_theme_settings__layout_tab($fields){  
	$icon = '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 5v14h19V5H3zm2 2h15v4H5V7zm0 10v-4h4v4H5zm6 0v-4h9v4h-9z"/></svg>';
	$fields[] = WPBC_acf_make_tab_field(
		array( 
			'key' => 'field_wpbc_theme_settings__layout_tab',
			'label' => $icon.' '._x('Layout','bootclean'),
		)
	);
	return $fields;
}  
function wpbc_theme_settings__layout_locations_header($fields){
	$fields[] = array (
		'key' => 'field_wpbc_theme_settings__locations_header',
		'label' => 'Template layouts',
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
		'message' => 'Customize the Layout used for each template. This will be the default used, but can be changed for specific page/post/category/etc using code filters or admin site. Ex.: You can define specif layout when editing a page.',
		'new_lines' => 'br',
		'esc_html' => '0',
	);
	$fields[] = array (
		'key' => 'field_wpbc_theme_settings__locations_header_2',
		'label' => '', 
		'type' => 'message',  
		'wrapper' => array (
			'width' => '',
			'class' => 'wpbc-acf-no-label',
			'id' => '',
		),
		'message' => 'Each Layout has at least one <u>Primary Area</u> marked with "green".', 
	);
	$fields[] = array (
		'key' => 'field_wpbc_theme_settings__locations_header_3',
		'label' => '', 
		'type' => 'message',  
		'wrapper' => array (
			'width' => '',
			'class' => 'wpbc-acf-no-label',
			'id' => '',
		),
		'message' => '<u>Secondary Areas</u>, like the ones used for widgets, are marked with "orange".', 
	);
	return $fields;
}

function wpbc_theme_settings__layout_locations($fields){

	$locations = WPBC_get_layout_locations(); 
	$count = 0;
	foreach ($locations as $key => $value) {
		$count = $count + 1 ; 
		
		$fields[] = array(
			'key' => 'field_wpbc_theme_settings__layout_location__accordion_'.$key,
			'label' => '<span class="wpbc-badge">'.$key.'</span>',
			'name' => '',
			'type' => 'accordion',
			'instructions' => $value['options']['description'],
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => 'wpbc-acf-accordion-layout',
				'id' => '',
			),
			'open' => 0,
			'multi_expand' => 0,
			'endpoint' => 0,
		);

		$sub_fields = WPBC_acf_make_layout_location_group(
			array(
				'key' => $key
			)
		);
		$fields[] = array(
			'key' => 'field_wpbc_theme_settings__layout_location__'.$key,
			'label' => '',
			'name' => 'layout_location__'.$key,
			'type' => 'group',
			'value' => NULL,
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => 'wpbc-acf-group-no-border wpbc-acf-no-label',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => $sub_fields,
		); 

	} 

	return $fields;
}



if( function_exists('acf_add_local_field_group') ){   

	$fields = WPBC_get_theme_settings_design_fields(); 
	$menu_slug = $child_page['menu_slug'];

	acf_add_local_field_group(array(
		'key' => 'group_wpbc_theme_settings_design',
		'title' => __('Design Settings','bootclean'),
		'fields' => $fields,
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'wpbc-theme-settings-design',
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