<?php



if( function_exists('acf_add_local_field_group') ):

/*

	This is also part for the Megamenu section, but needs TODO:
	
	Create a function to handle all ACF groups, fields, etc, in separate way, ready to mix, use, or anything later.
	Something like:
	
		acf/groups
		acf/fields
		acf/defaults (here i will use filters for defaults, options, choices, etc and could be then the interaction with theme options)

		
		
		
	Nomeclature keys should be:
	
	For FIELDS
		Keys:
			k_wpbc_field__[field name]
			k_wpbc_field__[field name]_[sub names]
		Names:
			wpbc_field__[field name]
			wpbc_field__[field name]_[sub names]
	
	FOR GROUPS
		Keys:
			k_wpbc_group__[group name] 
		
	
*/

$fields = array(); 

$fields[] = WPBC_acf_make_text_field(array(
	'name' => 'wpbc_field__nav_link_class',
	'label' => __('Nav link class (opcional)','bootclean'),
));

$fields[] = WPBC_acf_make_text_field(array(
	'name' => 'wpbc_field__nav_link_anchor',
	'prepend' => '#',
	'label' => __('Nav link anchor (opcional)','bootclean'),
	'width' => '80',
	'instructions' => __('Element #ID must exists on target link','bootclean'),
));

$fields[] = WPBC_acf_make_true_false_field(array(
	'name' => 'wpbc_field__nav_link_anchor_scroll', 
	'label' => __('Scroll','bootclean'),
	'instructions' => __('Enable','bootclean'),
	'class' => 'wpbc-true_false-ui', 
	'width' => '20',
	'default_value' => 0,
	'conditional_logic' => array(
			array(
				array(
					'field' => 'field_wpbc_field__nav_link_anchor',
					'operator' => '!=',
					'value' => '',
				),
			),
		),
));

$fields[] = array(
	'key' => 'k_wpbc_field__megamenu',
	'label' => __('Dropdown Megamenu', 'bootclean'),
	'name' => 'wpbc_field__megamenu',
	'type' => 'true_false',
	'instructions' => '',
	'required' => 0,
	'conditional_logic' => 0,
	'wrapper' => array(
		'width' => '',
		'class' => 'wpbc-true_false-ui',
		'id' => '',
	),
	'message' => '',
	'default_value' => 0,
	'ui' => 1,
	'ui_on_text' => '',
	'ui_off_text' => '',
);  

$fields[] = WPBC_acf_make_radio_field(array(
	'name' => 'wpbc_field__megamenu_type',
	'label' => __('Megamenu Type','bootclean'),
	'choices' => array (
		'menu' => __('Menu','bootclean'),
		'template' => __('Template','bootclean'),
		'template-part' => __('Template Part','bootclean'),
		'html' => __('Html','bootclean'),
	),
	'default_value' => 'template',
	'conditional_logic' => array(
			array(
				array(
					'field' => 'k_wpbc_field__megamenu',
					'operator' => '==',
					'value' => '1',
				),
			),
		),
));

$fields[] = WPBC_acf_make_select_nav_menu_field(array(
	'name' => 'wpbc_field__megamenu_menu',
	'label' => __('Select the menu','bootclean'),
	'return_format' => 'id',
	'conditional_logic' => array(
			array(
				array(
					'field' => 'k_wpbc_field__megamenu',
					'operator' => '==',
					'value' => '1',
				),
				array(
					'field' => 'field_wpbc_field__megamenu_type',
					'operator' => '==',
					'value' => 'menu',
				),
			), 
		),
));

$fields[] = WPBC_acf_make_post_object_wpbc_template(array(
	'name' => 'wpbc_field__megamenu_template',
	'label' => __('Select the Template','bootclean'),
	'return_format' => 'id',
	'conditional_logic' => array(
			array(
				array(
					'field' => 'k_wpbc_field__megamenu',
					'operator' => '==',
					'value' => '1',
				),
				array(
					'field' => 'field_wpbc_field__megamenu_type',
					'operator' => '==',
					'value' => 'template',
				),
			), 
		),
));

$fields[] = WPBC_acf_make_select_field(array( 
	'name' => 'wpbc_field__megamenu_template_part',
	'label' => __('Select the Template Part','bootclean'),
	'instructions' => __('Files under "template-parts/theme/" folder. (php only)','bootclean'), 
	'allow_null' => 0,
	'multiple' => 0,
	'ui' => 0,
	'ajax' => 0, 
	'conditional_logic' => array(
			array(
				array(
					'field' => 'k_wpbc_field__megamenu',
					'operator' => '==',
					'value' => '1',
				),
				array(
					'field' => 'field_wpbc_field__megamenu_type',
					'operator' => '==',
					'value' => 'template-part',
				),
			), 
		),
)); 

$fields[] = WPBC_acf_make_textarea_field(array( 
	'name' => 'wpbc_field__megamenu_html',
	'label' => __('Custom HTML (Shortcode enabled)','bootclean'),
	'conditional_logic' => array(
			array(
				array(
					'field' => 'k_wpbc_field__megamenu',
					'operator' => '==',
					'value' => '1',
				),
				array(
					'field' => 'field_wpbc_field__megamenu_type',
					'operator' => '==',
					'value' => 'html',
				),
			), 
		),
)); 

add_filter( 'acf/load_field/name=wpbc_field__megamenu_template_part', function ( $field ) { 
		
		$files = array();  
		$temp_folder = 'theme'; 
		$temp_files = glob(MAIN_THEME_PATH.'/template-parts/'.$temp_folder.'/*.php');
	
		foreach($temp_files as $file) { 
			$file_slug = str_replace('.php', '', basename($file));
			$files[] = array('name'=>basename($file),'file'=>$file_slug);
		} 
	
		$field['choices'][0] = 'None';
		foreach($files as $item){  
			$field['choices'][$item['file']] = $item['name'];  
		} 
	  
	  return $field;	
	
	}, 10, 1 );


/*
	Nomeclature should be:
	
	wpbc_group__[group name]
	
*/
acf_add_local_field_group(array(
	'key' => 'wpbc_group__megamenu',
	'title' => 'Megamenu',
	'fields' => $fields,
	'location' => array(
		array(
			array(
				'param' => 'nav_menu_item',
				'operator' => '==',
				'value' => 'all',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;