<?php

/*
	
	The idea here is to use the filter to append fields unsig 10, 20, 30, into priority.
	This will let child filters to append in between those fields without re-build the entire group.
	
	
	This group is placed on poast, pages, and son on. See how template uses this values.
	
	Related
	
		enqueue
		WPBC_template_builder
		WPBC_layout

*/

function WPBC_group_builder__layout_posts_page($fields = array()){ 
	$fields = array(
		
		// For post pages (single)
		array (
			'key' => 'field_layout_posts_page_posts__tab',
			'label' => 'Posts Pages',
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
		),

		array(
			'key' => 'field_layout_header_template_posts_page',
			'label' => 'Page Header Template',
			'name' => 'layout_header_template_posts_page',
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
		),
		
		// Cats
		array (
			'key' => 'field_layout_posts_page_category__tab',
			'label' => 'Category Pages',
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
		),

		array(
			'key' => 'field_layout_header_template_category',
			'label' => 'Page Header Template',
			'name' => 'layout_header_template_category',
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
		),
		
		// Tags
		array (
			'key' => 'field_layout_posts_page_tag__tab',
			'label' => 'Tag Pages',
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
		),

		array(
			'key' => 'field_layout_header_template_tag',
			'label' => 'Page Header Template',
			'name' => 'layout_header_template_tag',
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
		),
		
		// Archive
		array (
			'key' => 'field_layout_posts_page_archive__tab',
			'label' => 'Archive Pages',
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
		),
			
		array(
			'key' => 'field_layout_header_template_archive',
			'label' => 'Page Header Template',
			'name' => 'layout_header_template_archive',
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
		),
	
	);
	
	return apply_filters('WPBC_group_builder__layout_posts_page', $fields);
}
 

/*

	Add choices into select for wpbc_template post type

*/
add_filter('acf/load_field', 'field_layout_header_template__load_defaults');

function field_layout_header_template__load_defaults($field){ 

	$check = array(
		'layout_header_template_posts_page',
		'layout_header_template_category',
		'layout_header_template_tag',
		'layout_header_template_archive',

		'layout_main_navbar_template',
		'layout_header_template',
		'layout_footer_template',
	);
	if( $field['type'] == 'select' && in_array($field["name"], $check)){

		$field['choices'] = array(); 
		$field['choices']['none'] = 'None'; 
		$query = new WP_Query(array(
		    'post_type' => 'wpbc_template',
		    'post_status' => 'publish',
		    'posts_per_page' => -1,
		));  
		while ($query->have_posts()) {
		    $query->the_post();
		    $post_id = get_the_ID();
		    $field['choices'][$post_id] = get_the_title(); 
		} 
		wp_reset_query(); 

	}

	
	return $field;
}

function WPBC_group_builder__layout($fields = array()){  
	return apply_filters('WPBC_group_builder__layout', $fields);
} 

add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__main_navbar', 10, 1);  

function WPBC_group_builder__layout__main_navbar($fields){
	$fields[] = array (
		'key' => 'field_layout_main_navbar_template__tab',
		'label' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg> Main Navbar',
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

	$fields[] = array (
		'key' => 'field_layout_main_navbar_template',
		'label' => 'Page Navbar Template',
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
	return $fields;
}

add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__main_header', 20, 1);

function WPBC_group_builder__layout__main_header($fields){
	$fields[] = array (
		'key' => 'field_layout_header__tab',
		'label' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 11h-8v6h8v-6zm4 8V4.98C23 3.88 22.1 3 21 3H3c-1.1 0-2 .88-2 1.98V19c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2zm-2 .02H3V4.97h18v14.05z"/></svg> Page Header',
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

	$fields[] = array (
		'key' => 'field_layout_header_template_type',
		'label' => __('Choose Type','bootclean'),
		'name' => 'layout_header_template_type',
		'type' => 'select',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '20%',
			'class' => '',
			'id' => '',
		),
		'choices' => array ( 
			'none' => __('None','bootclean'),
			'template' => __('Template','bootclean'),
			'html' => __('HTML','bootclean'),
		),
		'default_value' => array (
			'none' => 'None',
		),
		'allow_null' => 0,
		'multiple' => 0,
		'ui' => 0,
		'ajax' => 0,
		'return_format' => 'value',
		'placeholder' => '',
	); 

	$fields[] = array (
		'key' => 'field_layout_header_template',
		'label' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 12h-2v3h-3v2h5v-5zM7 9h3V7H5v5h2V9zm14-6H3c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16.01H3V4.99h18v14.02z"/></svg> Page Header Template',
		'name' => 'layout_header_template',
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
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_layout_header_template_type',
					'operator' => '==',
					'value' => 'template',
				),
			), 
		),
	);   
	return $fields;
} 

add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__main_header_class', 20.5, 1); 

function WPBC_group_builder__layout__main_header_class($fields){
	$fields[] = array (
		'key' => 'field_layout_header_template_class',
		'label' => 'Page Header Class',
		'name' => 'layout_header_template_class',
		'type' => 'text',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_layout_header_template_type',
					'operator' => '!=',
					'value' => 'none',
				),
			), 
		),
		'wrapper' => array (
			'width' => '50%',
			'class' => '',
			'id' => '',
		), 
	); 
	return $fields;
} 

add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__main_header_template_html', 21, 1); 

function WPBC_group_builder__layout__main_header_template_html($fields){
	$fields[] = array (
		'key' => 'field_layout_header_template_html',
		'label' => 'Page Header Custom HTML',
		'name' => 'layout_header_template_html',
		'type' => 'textarea',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_layout_header_template_type',
					'operator' => '==',
					'value' => 'html',
				),
			), 
		),
		'wrapper' => array (
			'width' => '100%',
			'class' => 'codemirror-custom-field md',
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'maxlength' => '',
		'rows' => '',
		'new_lines' => '',
	);

	return $fields;
} 

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

	return $fields;
}

add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__code', 99, 1); 

function WPBC_group_builder__layout__code($fields){
	$fields[] = array (
		'key' => 'field_layout_code__tab',
		'label' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg> Custom Styles',
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

	$fields[] = array (
		'key' => 'field_layout_code__body_class',
		'label' => 'Body CLASS',
		'name' => 'layout_code_body_class',
		'type' => 'text',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
	);

	$fields[] = array (
		'key' => 'field_layout_code__clone',
		'label' => 'Item',
		'name' => 'layout_code_styles',
		'type' => 'clone',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'clone' => array(
			0 => 'field_group_code_styles',
		),
		'display' => 'seamless',
		'layout' => 'block',
		'prefix_label' => 0,
		'prefix_name' => 0,
	);

	$fields[] = array (
		'key' => 'field_layout_code__tab_end',
		'label' => '',
		'name' => '',
		'type' => 'tab', 
		'placement' => 'top',
		'endpoint' => 1,
	);

	return $fields;
}  