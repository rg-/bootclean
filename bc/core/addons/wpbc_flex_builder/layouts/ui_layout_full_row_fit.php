<?php

/*
		ui_layout_full_row_fit
*/

add_filter('wpbc/filter/flexible_content/layout_title?name=ui_layout_full_row_fit', function($title, $value){ 
 	$title = $value['field_ui_layout_full_row_fit__content']['field_ui_layout_full_row_fit__content__section-title']; 
	return $title; 
},10,2);

add_filter('wpbc/filter/acf/builder/flexible_content/layouts', 'WPBC_build__ui_layout_full_row_fit',20,1);  
	
	function WPBC_build__ui_layout_full_row_fit($layouts){ 

		$layout_name = 'ui_layout_full_row_fit';

		$layout_label = '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-layout-sidebar-inset-reverse svg" viewBox="0 0 16 16">
  <path d="M2 2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h12z"/>
  <path d="M13 4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V4z"/>
</svg></i> Full Row Fit'; 
		
		$content_sub_fields = array();  

		$sub_fields_columns_content = array();

			$sub_fields_columns_content = WPBC_acf_make_section_title_field($sub_fields_columns_content, array(
				'layout_name' => $layout_name.'__content',  
				'label' => __('Use Title?','bootclean'),  
				'hide_responsive' => true,
				'hide_align' => true,
				'hide_color' => true,
				'hide_use' => false,
			));  

			$sub_fields_columns_content[] = WPBC_acf_make_wysiwyg_field_xxmini(array(
				'label' => __('Content','bootclean'),
				'name' => $layout_name.'__content__wysiwyg',    
				'class' => 'acf-small-wysiwyg wpbc-field-no-label',
				'delay' => 0,
			));  
		
		$content_sub_fields[] = WPBC_acf_make_group_field(array(
			'label' => __('Content','bootclean'),
			'name' => $layout_name.'__content',  
			'sub_fields' => $sub_fields_columns_content, 
			'width' => '70%'
		)); 


		$sub_fields_columns_style = array();
				

				$sub_fields_columns_style[] = WPBC_acf_make_select_field(array(
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
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-ui-mini',
					'width' => '50%' 
				)); 

				$sub_fields_columns_style[] = WPBC_acf_make_select_field(array(
					'label' => __('Content Side','bootclean'),
					'name' => $layout_name.'__style_content_side',  
					'choices' => array(
						'left'=>'Left',
						'right'=>'Right', 
					),
					'default_value' => 'left', 
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-ui-mini',
					'width' => '50%' 
				)); 

				$choices = array();
				for ($i=1; $i < 13; $i++) { 
					$choices[$i] = $i;
				}
				$sub_fields_columns_style[] = WPBC_acf_make_select_field(array(
					'label' => '<small>'.__('Content Size','bootclean').'</small>',
					'name' => $layout_name.'__style_content_size',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-ui-mini',  
					'choices' => $choices,  
					'default_value' => '6',
					'width' => '50%' 
				)); 
				
				$sub_fields_columns_style[] = WPBC_acf_make_select_field(array(
					'label' => '<small>'.__('Style Type','bootclean').'</small>',
					'name' => $layout_name.'__style_type',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-ui-mini',  
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
					'name' => $layout_name.'__style_gallery',  
					'class' => 'acf-small-gallery wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-ui-mini', 
					'columns' => 3, 
				));

				$sub_fields_columns_style[] = WPBC_acf_make_message_field(array(
					'label' => '<small>'.__('Colors Breakpoint DOWN','bootclean').'</small>',
					'key' => 'field_'.$layout_name.'__style_background_message_default',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-field-no-padding-bottom',  
				));

				$sub_fields_columns_style[] = WPBC_acf_make_color_picker_field(array(
					'label' => '<small>'.__('Background Color','bootclean').'</small>',
					'name' => $layout_name.'__style_backgrund_color',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-ui-mini',  
				));
				$sub_fields_columns_style[] = WPBC_acf_make_color_picker_field(array(
					'label' => '<small>'.__('Text Color','bootclean').'</small>',
					'name' => $layout_name.'__style_text_color',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-ui-mini',  
				));

				$sub_fields_columns_style[] = WPBC_acf_make_message_field(array(
					'label' => '<small>'.__('Colors Breakpoint UP','bootclean').'</small>',
					'key' => 'field_'.$layout_name.'__style_background_message_breakpoint',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-field-no-padding-bottom',  
				));

				$sub_fields_columns_style[] = WPBC_acf_make_color_picker_field(array(
					'label' => '<small>'.__('Background Color','bootclean').'</small>',
					'name' => $layout_name.'__style_backgrund_color_breakpoint',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-ui-mini',  
				));
				$sub_fields_columns_style[] = WPBC_acf_make_color_picker_field(array(
					'label' => '<small>'.__('Text Color','bootclean').'</small>',
					'name' => $layout_name.'__style_text_color_breakpoint',  
					'class' => 'wpbc-field-no-padding-left wpbc-field-no-padding-top wpbc-ui-mini',  
				));

			$content_sub_fields[] = WPBC_acf_make_group_field(array(
				'label' => __('Style Column','bootclean'),
				'name' => $layout_name.'__style',  
				'sub_fields' => $sub_fields_columns_style, 
				'class' => 'acf-group-seamless',
				'width' => '30%'
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