<?php

add_filter('WPBC_group_builder__layout_posts_page', function($fields){
	// For post pages (single)

	$fields[] = array (
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
		);

	$fields[] = array(
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
		);

	$fields[] = array(
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
		);

	$fields[] = array(
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
		);

	$fields[] = array(
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
		);

	$fields[] = array(
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
		);

	$fields[] = array(
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
		);

	$fields[] = array(
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
		);
	
	return $fields;

},10,1);