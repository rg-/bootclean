<?php

/*
		ui_layout_slick 
*/
		
	add_filter('wpbc/filter/acf/builder/flexible_content/layouts', 'WPBC_build__ui_layout_slick',20,1);  
	
	function WPBC_build__ui_layout_slick($layouts){ 

		$layout_name = 'ui_layout_slick';

		$layout_label = '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path class="path" fill="#fff" d="M7.77 6.76L6.23 5.48.82 12l5.41 6.52 1.54-1.28L3.42 12l4.35-5.24zM7 13h2v-2H7v2zm10-2h-2v2h2v-2zm-6 2h2v-2h-2v2zm6.77-7.52l-1.54 1.28L20.58 12l-4.35 5.24 1.54 1.28L23.18 12l-5.41-6.52z"/></svg></i> Slick Slider Layout'; 
		
		$content_sub_fields = array(); 
		
		$content_sub_fields[] = WPBC_acf_make_slick_group_field($layout_name, array(
			'label' => __('Slider Items','bootstrap'),
			'name' => $layout_name.'__content',
		)); 

		$content_sub_fields[] = WPBC_acf_make_true_false_field(array(
			'label' => __('Overlay custom content?','bootclean'),
			'name' => $layout_name.'__overlay', 
			'width' => '30',
			'default_value' => 0,
		)); 
		$content_sub_fields[] = WPBC_acf_make_text_field(array(
			'label' => __('Overlay content class','bootclean'),
			'name' => $layout_name.'__overlay_class', 
			'default_value' => 'position-absolute z-index-30 bottom-0 right-0 left-0 text-center gpb-3',
			'width' => '70',
			'conditional_logic' => array (
					array (
						array (
							'field' => 'field_'.$layout_name.'__overlay',
							'operator' => '==',
							'value' => '1',
						),
					), 
				),
		)); 
		$content_sub_fields[] = WPBC_acf_make_textarea_field(array(
			'label' => __('Overlay content','bootclean'),
			'name' => $layout_name.'__overlay_content',
			//'qtranslate' => true,  
			'conditional_logic' => array (
					array (
						array (
							'field' => 'field_'.$layout_name.'__overlay',
							'operator' => '==',
							'value' => '1',
						),
					), 
				),
		)); 


		$content_sub_fields[] = WPBC_acf_make_tab_field(array(
			'label' => __('Slick Settings','bootstrap'),
			'key' => $layout_name.'__settings_tab',
		));
		$content_sub_fields[] = WPBC_acf_make_slick_settings_group_field(array(
			'label' => __('Slider Settings','bootstrap'),
			'name' => $layout_name.'__settings',
			'class' => 'wpbc-acf-no-label'
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