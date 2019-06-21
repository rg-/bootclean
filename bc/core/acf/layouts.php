<?php

/*

	Related:

	/template-parts/builder/
	bc/core/template-tags/wpbc_template_builder.php (The BRAIN here !!)

	@filter WPBC_acf_builder_layouts

*/ 


include('layouts/html_row.php');
include('layouts/template_row.php'); 
include('layouts/slider_row.php');
include('layouts/widgets_row.php');

// TODO, doing... see acf/layouts/navbar_row and same in template-parts/layouts/navbar_row.php
include('layouts/navbar_row.php'); 


function WPBC_acf_builder_layouts(){
	
	$layouts = array(); 
	
	// Filter here, so i can allways "safe" add a flexible_row by filter, and then, and LAST always, the layout_flexible_row, that in fact has the same layouts defined above and that´s why needs to be last one loaded :)
	$layouts = apply_filters('WPBC_acf_builder_layouts', $layouts);
	
	$flexible_rows = array(
		'layout_flexible_row' => array(
			'key' => 'layout_flexible_row',
			'name' => 'flexible_row',
			'label' => 'Flexible Row',
			'display' => 'block',
			'sub_fields' => array(
			
				array (
					'key' => 'layout_flexible_row__tab_content',
					'label' => 'Content Rows',
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
					'key' => 'key__layout_flexible_row__content',
					'label' => 'Content',
					'name' => 'content',
					'type' => 'flexible_content',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'layouts' => $layouts,
					'button_label' => 'Add Sub Row',
					'min' => '',
					'max' => '',
				),
				
				array (
					'key' => 'layout_flexible_row__tab_settings',
					'label' => 'Settings',
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
					'key' => 'key__layout_flexible_row__classes',
					'label' => 'Classes',
					'name' => 'classes',
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
						1 => 'key__r_builder_classes_group'
					),
					'display' => 'seamless',
					'layout' => 'block',
					'prefix_label' => 0,
					'prefix_name' => 0,
				),
			),
			'min' => '',
			'max' => '',
		),
	);
	$layouts['layout_flexible_row'] = $flexible_rows['layout_flexible_row'];
	
	return $layouts;
}