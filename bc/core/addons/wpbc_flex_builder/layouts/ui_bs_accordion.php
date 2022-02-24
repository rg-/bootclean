<?php

/*
		ui_bs_accordion
*/
		
add_filter('wpbc/filter/acf/builder/flexible_content/layouts', 'WPBC_build__ui_bs_accordion',20,1);  
	
	function WPBC_build__ui_bs_accordion($layouts){ 

		$layout_name = 'ui_bs_accordion';

		$layout_label = '<i class="icon-badge">'.WPBC_get_flex_flex_builder_layout_BS_icon().'</i> Accordion';
		
		$content_sub_fields = array(); 
			
			$items_sub_fields = array(); 

			// headline
			$headline_sub_fields = array();

				$headline_sub_fields[] = WPBC_acf_make_textarea_field(array(
					'label' => __('Title','bootclean'),
					'name' => $layout_name.'__items_title',
					'width' => '80%',
					'rows' => '1',
				));
				
				$headline_sub_sub_fields = array();

					$headline_sub_sub_fields[] = WPBC_acf_make_true_false_field(array(
						'label' => __('Collapse','bootclean'),
						'name' => $layout_name.'__items_settings_collapsed',
						'default_value' => 0, 
						'class' => 'wpbc-ui-mini w-auto wpbc-field-no-label ',
						'ui_on_text' => __('OPEN','bootclean'),
						'ui_off_text' => __('CLOSED','bootclean'),
					)); 

				$headline_sub_fields[] = WPBC_acf_make_group_field(array(
					'label' => __('Settings','bootclean'),
					'name' => $layout_name.'__items_settings',
					'sub_fields' => $headline_sub_sub_fields,
					'class' => 'wpbc-field-no-label wpbc-field-no-border-fields wpbc-field-no-padding-top',
					'width' => '20%',
				));

			$items_sub_fields[] = WPBC_acf_make_group_field(array(
				'label' => __('Content','bootclean'),
				'name' => $layout_name.'__items_headline',
				'sub_fields' => $headline_sub_fields,
				'class' => 'wpbc-field-no-label',
			));

		// content

			$items_sub_fields[] = WPBC_acf_make_wysiwyg_field_format(array(
				'label' => __('Content','bootclean'),
				'name' => $layout_name.'__items_content',
			));

		// items

		$content_sub_fields[] = WPBC_acf_make_repeater_field(array(
			'label' => __('Accordion Items','bootclean'),
			'name' => $layout_name.'__items',
			'sub_fields' => $items_sub_fields,
			'button_label' => __('Add Item','bootclean'),
			'collapsed' => 'field_'.$layout_name.'__items_headline',
		)); 

		$layouts = WPBC_acf_make_flex_builder_layout(array(
			'layout_name' => $layout_name,
			'layout_label' => $layout_label,
			'content_sub_fields' => $content_sub_fields,
			'show_section_title' => false, 
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