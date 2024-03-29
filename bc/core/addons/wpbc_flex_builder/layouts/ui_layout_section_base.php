<?php

/*
		ui_layout_base
*/
		
add_filter('wpbc/filter/acf/builder/flexible_content/layouts', 'WPBC_build__ui_layout_section_base',20,1);  
	
	function WPBC_build__ui_layout_section_base($layouts){ 

		$layout_name = 'ui_layout_section_base';

		$layout_label = '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#fff" class="svg"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 4v3h5.5v12h3V7H19V4z"/></svg></i> Section Base'; 
		
		$content_sub_fields = array(); 
		
		$content_sub_fields[] = WPBC_acf_make_wysiwyg_field(array(
			'label' => __('Content','bootclean'),
			'name' => $layout_name.'__code',
			'qtranslate' => true,  
		)); 

		$layouts = WPBC_acf_make_flex_builder_layout(array(
			'layout_name' => $layout_name,
			'layout_label' => $layout_label,
			'content_sub_fields' => $content_sub_fields,
			'show_section_title' => true, 
			'show_section_settings' => true,
			'show_section_styles' => true,
			'section_settings_defaults' => array( 

				/**/
				'classes' => array(
					'default' => false,
				),

				/*
				'classes' => array(
					'default' => true,
					'container_class' => 'container',
					'row_class' => 'row',
					'column_class' => 'col-12',
				),
				*/
				// 'classes' => array(),
			),
		), $layouts); 

		return $layouts;  
	}