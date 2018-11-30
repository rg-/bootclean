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

add_filter('WPBC_group_builder__layout', function($fields){
	
	$fields[] = array (
		'key' => 'field_layout_main_navbar_template__tab',
		'label' => 'Main Navbar',
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
}, 10, 1); 

add_filter('WPBC_group_builder__layout', function($fields){

	$fields[] = array (
		'key' => 'field_layout_header__tab',
		'label' => 'Page Header',
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
		'key' => 'field_layout_header_template',
		'label' => 'Page Header Template',
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
	);

	return $fields;

}, 20, 1); 

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

add_filter('WPBC_group_builder__layout', function($fields){

	$fields[] = array (
		'key' => 'field_layout_footer__tab',
		'label' => 'Main Footer',
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

}, 30, 1); 

add_filter('WPBC_group_builder__layout', function($fields){
	
	$fields[] = array (
		'key' => 'field_layout_code__tab',
		'label' => 'Custom Styles',
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

}, 99, 1); 


/*

	WPBC_group_builder__slider

*/


function WPBC_group_builder__slider($fields = array()){  
	return apply_filters('WPBC_group_builder__slider', $fields);
}

add_filter('WPBC_group_builder__slider', function($fields){

	$fields[] = array(
		'key' => 'key__slider__slider_items',
		'label' => 'Items',
		'name' => 'slider_items',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => 0,
		'max' => 0,
		'layout' => 'block',
		'button_label' => 'Add item',
		'sub_fields' => array(
			array(
				'key' => 'key__slider__slider_items__item',
				'label' => 'Item',
				'name' => 'item',
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
					//0 => 'key__r_html_code',
					0 => 'key__r_slider_item',
				),
				'display' => 'seamless',
				'layout' => 'block',
				'prefix_label' => 0,
				'prefix_name' => 0,
			),
		),
	);

	return $fields;
}, 10, 1); 

add_filter('WPBC_group_builder__slider', function($fields){

	$fields[] = array (
		'key' => 'key__slider__classes',
		'label' => 'Slider Classes',
		'name' => 'slider__classes',
		'type' => 'group',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => array (
		
			array (
				'key' => 'key__slider__classes_item_container',
				'label' => 'Slider Class',
				'name' => 'slider__classes_item_container',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50%',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '> +',
				'append' => '',
				'maxlength' => '',
			),
			
			array (
				'key' => 'key__slider__classes_item_content',
				'label' => 'Item > Container > Caption class',
				'name' => 'slider__classes_item_content',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50%',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'd-flex justify-content-center align-items-center',
				'placeholder' => '',
				'prepend' => '> +',
				'append' => '',
				'maxlength' => '',
			),
		
		),
	);

	return $fields;
}, 20, 1); 

add_filter('WPBC_group_builder__slider', function($fields){

	$fields[] = array(
		'key' => 'key__slider__slider_items__slider_settings',
		'label' => 'Settings',
		'name' => 'slider_settings',
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
			0 => 'key__r_slider_settings',
		),
		'display' => 'seamless',
		'layout' => 'block',
		'prefix_label' => 0,
		'prefix_name' => 0,
	);

	return $fields;
}, 30, 1); 

add_filter('WPBC_group_builder__slider', function($fields){
	
	$fields[] = array(
		'key' => 'key__slider__slider_items__slider_breakpoint_heights',
		'label' => 'Breakpoint Sizes',
		'name' => 'slider_breakpoint_heights',
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
			0 => 'key__r_slider_breakpoint_heights',
		),
		'display' => 'seamless',
		'layout' => 'block',
		'prefix_label' => 0,
		'prefix_name' => 0,
	);
	return $fields;
}, 40, 1); 

add_filter('WPBC_group_builder__slider', function($fields){

	$fields[] = array(
		'key' => 'key__slider__slider_items__slider_breakpoint_enable',
		'label' => 'Breakpoint Enable',
		'name' => 'slider_breakpoint_enable',
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
			0 => 'key__r_slider_breakpoint_enable',
		),
		'display' => 'seamless',
		'layout' => 'block',
		'prefix_label' => 0,
		'prefix_name' => 0,
	);
	return $fields;
}, 50, 1); 