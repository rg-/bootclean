<?php

/*
		ui_layout_full_content_fit
*/
		
add_filter('wpbc/filter/acf/builder/flexible_content/layouts', 'WPBC_build__ui_layout_full_content_fit',20,1);  
	
	function WPBC_build__ui_layout_full_content_fit($layouts){ 

		$layout_name = 'ui_layout_full_content_fit';

		$layout_label = '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#fff" class="svg"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 5v14c0 1.1.89 2 2 2h6V3H5c-1.11 0-2 .9-2 2zm16-2h-6v8h8V5c0-1.1-.9-2-2-2zm-6 18h6c1.1 0 2-.9 2-2v-6h-8v8z"/></svg></i> Full Content Fit'; 
		
		$content_sub_fields = array();  
 

		$content_sub_fields[] = WPBC_acf_make_select_field(array(
			'label' => __('Breakpoint','bootclean'),
			'name' => $layout_name.'__breakpoint',  
			'choices' => array(
				'xs'=>'xs',
				'sm'=>'sm',
				'md'=>'md',
				'lg'=>'lg',
				'xl'=>'xl',
			),
			'default_value' => 'lg',
			'width' => '20%'
		)); 

		$sub_fields_columns = array(); 

			$sub_fields_columns_content = array();

				$sub_fields_columns_content = WPBC_acf_make_section_title_field($sub_fields_columns_content, array(
					'layout_name' => $layout_name.'__columns_content',  
					'label' => __('Use Title?','bootclean'),  
					'hide_responsive' => true,
					'hide_align' => true,
					'hide_color' => true,
					'hide_use' => false,
				));  

				$sub_fields_columns_content[] = WPBC_acf_make_wysiwyg_field_xxmini(array(
					'label' => __('Content','bootclean'),
					'name' => $layout_name.'__columns_content__wysiwyg',    
					'class' => 'acf-small-wysiwyg',
					'delay' => 0,
				)); 
			
			$sub_fields_columns[] = WPBC_acf_make_group_field(array(
				'label' => __('Content Column','bootclean'),
				'name' => $layout_name.'__columns_content',  
				'sub_fields' => $sub_fields_columns_content, 
				'width' => '70%'
			)); 

			$sub_fields_columns_style = array();
				
				$choices = array();
				for ($i=1; $i < 12; $i++) { 
					$choices[$i] = $i;
				}
				$sub_fields_columns_style[] = WPBC_acf_make_select_field(array(
					'label' => '<small>'.__('Column Size','bootclean').'</small>',
					'name' => $layout_name.'__columns_style_size',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top', 
					// default, title-up, content-up, content-overlap, image-overlap
					'choices' => $choices,  
					'default_value' => '6',
				));

				$sub_fields_columns_style[] = WPBC_acf_make_select_field(array(
					'label' => '<small>'.__('Style Type','bootclean').'</small>',
					'name' => $layout_name.'__columns_style_type',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top', 
					// default, title-up, content-up, content-overlap, image-overlap
					'choices' => array(
						'default' => 'Default',
						'title-up' => 'Title Up * (if Section Title)',
						'content-up' => 'Content up',
						'content-overlap' => 'Content overlap',
						'image-overlap' => 'Image overlap',
					),  
				));  

				$sub_fields_columns_style[] = WPBC_acf_make_gallery_advanced_field(array(
					'label' => __('Background Image/Gallery','bootclean'),
					'name' => $layout_name.'__columns_style_gallery',  
					'class' => 'acf-small-gallery wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-ui-mini', 
					'columns' => 3, 
				));

				$sub_fields_columns_style[] = WPBC_acf_make_message_field(array(
					'label' => '<small>'.__('Colors Breakpoint DOWN','bootclean').'</small>',
					'key' => 'field_'.$layout_name.'__columns_style_background_message_default',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-field-no-padding-bottom',  
				));

				$sub_fields_columns_style[] = WPBC_acf_make_color_picker_field(array(
					'label' => '<small>'.__('Background Color','bootclean').'</small>',
					'name' => $layout_name.'__columns_style_backgrund_color',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-ui-mini',  
				));
				$sub_fields_columns_style[] = WPBC_acf_make_color_picker_field(array(
					'label' => '<small>'.__('Text Color','bootclean').'</small>',
					'name' => $layout_name.'__columns_style_text_color',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-ui-mini',  
				));

				$sub_fields_columns_style[] = WPBC_acf_make_message_field(array(
					'label' => '<small>'.__('Colors Breakpoint UP','bootclean').'</small>',
					'key' => 'field_'.$layout_name.'__columns_style_background_message_breakpoint',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-field-no-padding-bottom',  
				));

				$sub_fields_columns_style[] = WPBC_acf_make_color_picker_field(array(
					'label' => '<small>'.__('Background Color','bootclean').'</small>',
					'name' => $layout_name.'__columns_style_backgrund_color_breakpoint',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-ui-mini',  
				));
				$sub_fields_columns_style[] = WPBC_acf_make_color_picker_field(array(
					'label' => '<small>'.__('Text Color','bootclean').'</small>',
					'name' => $layout_name.'__columns_style_text_color_breakpoint',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-ui-mini',  
				));

			$sub_fields_columns[] = WPBC_acf_make_group_field(array(
				'label' => __('Style Column','bootclean'),
				'name' => $layout_name.'__columns_style',  
				'sub_fields' => $sub_fields_columns_style, 
				'class' => 'acf-group-seamless',
				'width' => '30%'
			));  

		$content_sub_fields[] = WPBC_acf_make_repeater_field(array(
			'label' => __('Columns','bootclean'),
			'name' => $layout_name.'__columns',  
			'sub_fields' => $sub_fields_columns, 
			'button_label' => __('Add Column','bootclean'),
			'width' => '100%'
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