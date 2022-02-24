<?php

function WPBC_acf_make_slick_group_field($layout_name, $args, $is_registered_option=false){

	if(empty($args['name'])) return;

	$sub_fields = array();

	$sub_items_fields = array(); 

	$sub_items_fields[] = WPBC_acf_make_image_field(array(
		'label' => __('Image','bootclean'),
		'name' => $args['name'].'__item_image',
		'return_format' => 'id',
		'width' => '30',
		'preview_size' => 'medium',
		'conditional_logic' => array (
				array (
					array (
						'field' => 'field_'.$args['name'].'__item_type',
						'operator' => '==',
						'value' => 'image-cover',
					),
				),
				array (
					array (
						'field' => 'field_'.$args['name'].'__item_type',
						'operator' => '==',
						'value' => 'image-inline',
					),
				),
				array (
					array (
						'field' => 'field_'.$args['name'].'__item_type',
						'operator' => '==',
						'value' => 'image-cover-content',
					),
				),
			),
	));	 

	// content

	$item_content_type = apply_filters('wpbc/filter/slick_group/item_content_type', 'textarea', $layout_name);
	$item_conditional_logic = array (
			array (
				array (
					'field' => 'field_'.$args['name'].'__item_type',
					'operator' => '==',
					'value' => 'image-cover-content',
				),
			),
			array (
				array (
					'field' => 'field_'.$args['name'].'__item_type',
					'operator' => '==',
					'value' => 'content',
				),
			),
		);
		if($item_content_type=='textarea'){
			$sub_items_fields[] = WPBC_acf_make_textarea_field(array(
				'label' => __('Content','bootclean'),
				'name' => $args['name'].'__item_content', 
				'width' => '70',
				'conditional_logic' => $item_conditional_logic,

				'qtranslate' => true,
			));	 
		}
	 	if($item_content_type=='wysiwyg'){
			$sub_items_fields[] = WPBC_acf_make_wysiwyg_field_format(array(
				'label' => __('Content','bootclean'),
				'name' => $args['name'].'__item_content', 
				'width' => '70',
				'conditional_logic' => $item_conditional_logic,

				'qtranslate' => true,
			));	 
		}

	// content END

	$sub_items_fields[] = WPBC_acf_make_post_object_wpbc_template(array(
		'label' => __('Choose Template','bootclean'),
		'name' => $args['name'].'__item_template',
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_'.$args['name'].'__item_type',
					'operator' => '==',
					'value' => 'template',
				),
			), 
		),
	));	 
 	
 	$sub_items_fields[] = WPBC_acf_make_select_template_part_field(array(
		'label' => __('Choose Template Part','bootclean'),
		'name' => $args['name'].'__item_template_part',
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_'.$args['name'].'__item_type',
					'operator' => '==',
					'value' => 'template-part',
				),
			), 
		),
	));	  



	$sub_items_fields[] = WPBC_acf_make_color_styles_group_field(array(
		'label' => __('Item Style','bootclean'),
		'name' => $args['name'].'__item_styles', 
		'class' => 'wpbc-tabsless-group acf-group-seamless wpbc-acf-no-label', 
		'width' => '70%', 
	));
	$sub_items_fields[] = WPBC_acf_make_text_field(array(
		'label' => __('Item Class','bootclean'),
		'name' => $args['name'].'__item_class',
		'width' => '30%', 
	));

	$item_type_choices = WPBC_acf_get_slick_types_choices();

	$sub_items_fields[] = WPBC_acf_make_radio_field( array(
		'name' => $args['name'].'__item_type',
		'label'=>  __('Slide Type','bootclean'),
		'width' => '100%', 
		'choices' => $item_type_choices,
		'default_value' => 'image-inline',
		'class' => 'wpbc-radio-as-btn as-btn-sm as-btn-danger wpbc-acf-left-label', 
	) );

	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Slick Group Field',
		'name' => 'slick_group_field',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => 0,
		'max' => 0,
		'layout' => 'block',
		'button_label' => __('Add Slide','bootclean'),
		'sub_fields' => $sub_items_fields,
	);

	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;

}



function WPBC_acf_get_slick_types_choices(){

	$item_type_choices = array(
 		'image-inline' => __('Image Inline','bootclean'),
		'image-cover' => __('Image Cover','bootclean'),
		'image-cover-content' => __('Image Cover + Content','bootclean'),
		'content' => __('Just Content','bootclean'),
		'template' => __('Template','bootclean'),
		'template-part' => __('Template Part','bootclean'),
 	);

 	return $item_type_choices;

}