<?php

/*
		ui_layout_template
*/
		
	add_filter('wpbc/filter/acf/builder/flexible_content/layouts', 'WPBC_build__ui_layout_template',20,1);  
	
	function WPBC_build__ui_layout_template($layouts){ 

		$layout_name = 'ui_layout_template';

		$layout_label = '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path class="path" fill="#fff" d="M467.3 168.1c-1.8 0-3.5.3-5.1 1l-177.6 92.1h-.1c-7.6 4.7-12.5 12.5-12.5 21.4v185.9c0 6.4 5.6 11.5 12.7 11.5 2.2 0 4.3-.5 6.1-1.4.2-.1.4-.2.5-.3L466 385.6l.3-.1c8.2-4.5 13.7-12.7 13.7-22.1V179.6c0-6.4-5.7-11.5-12.7-11.5zM454.3 118.5L272.6 36.8S261.9 32 256 32c-5.9 0-16.5 4.8-16.5 4.8L57.6 118.5s-8 3.3-8 9.5c0 6.6 8.3 11.5 8.3 11.5l185.5 97.8c3.8 1.7 8.1 2.6 12.6 2.6 4.6 0 8.9-1 12.7-2.7l185.4-97.9s7.5-4 7.5-11.5c.1-6.3-7.3-9.3-7.3-9.3zM227.5 261.2L49.8 169c-1.5-.6-3.3-1-5.1-1-7 0-12.7 5.1-12.7 11.5v183.8c0 9.4 5.5 17.6 13.7 22.1l.2.1 174.7 92.7c1.9 1.1 4.2 1.7 6.6 1.7 7 0 12.7-5.2 12.7-11.5V282.6c.1-8.9-4.9-16.8-12.4-21.4z"/></svg></i> Template'; 
		
		$content_sub_fields = array(); 
		
		$content_sub_fields[] = WPBC_acf_make_post_object_wpbc_template(array( 
			'name' => $layout_name.'__post',  
			'width' => '80%',
		)); 

		$content_sub_fields[] = WPBC_acf_make_true_false_field(array( 
			'name' => $layout_name.'__ajax_load',  
			'label' => __('Ajax load','bootclean'),
			'default_value' => 0,
			'width' => '20%',
		)); 

		$cond_ajax = array (
						array (
							array (
								'field' => 'field_'.$layout_name.'__ajax_load',
								'operator' => '==',
								'value' => '1',
							),
						), 
					);

			$content_sub_fields[] = WPBC_acf_make_select_field(array( 
				'name' => $layout_name.'__ajax_onload',  
				'label' => __('Ajax onload type','bootclean'),
				'choices' => array(
					'button' => 'Load Button',
					'ready' => 'Document Ready',
					'load' => 'Window Load',
					'init' => 'After Body Loader',
					'inview' => 'Inview Lazyload',
				),
				'conditional_logic' => $cond_ajax,
				'default_value' => 'ready',
				'width' => '30%',
			));

			$content_sub_fields[] = WPBC_acf_make_color_picker_field(array( 
				'name' => $layout_name.'__ajax_loading_background_color',  
				'label' => __('Background Color','bootclean'), 
				'conditional_logic' => $cond_ajax, 
				'default_value' => '#fff',
				'width' => '20%',
			));

			$content_sub_fields[] = WPBC_acf_make_number_field(array( 
				'name' => $layout_name.'__ajax_loading_background_opacity',  
				'label' => __('Background Opacity','bootclean'), 
				'conditional_logic' => $cond_ajax, 
				'default_value' => '.1',
				'min' => '0',
				'max' => '1',
				'step' => '.1',
				'width' => '20%',
			));

			$content_sub_fields[] = WPBC_acf_make_color_picker_field(array( 
				'name' => $layout_name.'__ajax_loading_spinner_color',  
				'label' => __('Spinner Color','bootclean'), 
				'conditional_logic' => $cond_ajax, 
				'default_value' => '#000',
				'width' => '20%',
			));


		$layouts = WPBC_acf_make_flex_builder_layout(array(
			'layout_name' => $layout_name,
			'layout_label' => $layout_label,
			'content_sub_fields' => $content_sub_fields,
			//'show_section_title' => false, 
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