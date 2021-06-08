<?php

/*
		ui_layout_full_cols
*/
		
add_filter('wpbc/filter/acf/builder/flexible_content/layouts', 'WPBC_build__ui_layout_columns',20,1);  
	
	function WPBC_build__ui_layout_columns($layouts){ 

		$layout_name = 'ui_layout_columns';

		$layout_label = '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#fff" class="svg"><rect fill="none" height="24" width="24"/><g><path d="M14.67,5v14H9.33V5H14.67z M15.67,19H21V5h-5.33V19z M8.33,19V5H3v14H8.33z"/></g></svg></i> Columns'; 
		
		$content_sub_fields = array();  
 
		$col_sub_fields = array();  

			$col_sub_fields[] = WPBC_acf_make_text_field(array(
				'label' => __('Class','bootclean'),
				'name' => $layout_name.'__columns_class',
				'class' => 'wpbc-field-no-label',
				'default_value' => 'col-md-6',
			)); 
			$col_sub_fields[] = WPBC_acf_make_wysiwyg_field_format_all(array(
				'label' => __('Content','bootclean'),
				'name' => $layout_name.'__columns_wysiwyg',    
				'class' => 'acf-small-wysiwyg wpbc-field-no-label',
				'delay' => 0,
			)); 

			$content_sub_fields[] = WPBC_acf_make_repeater_field(array(
				'name' => $layout_name.'__columns',
				'label' => _x('Columns','bootclean'),
				'button_label' => _x('Add column','bootclean'),
				'sub_fields' => $col_sub_fields,
				'collapsed' => 'field_'.$layout_name.'__columns_class',
			));


		$layouts = WPBC_acf_make_flex_builder_layout(array(
			'layout_name' => $layout_name,
			'layout_label' => $layout_label,
			'content_sub_fields' => $content_sub_fields,
			'show_section_title' => true, 
				'hide_responsive_title' => true,
				//'hide_align_title' => true,

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


if(!function_exists('WPBC_get_ui_layout_columns()')){
	function WPBC_get_ui_layout_columns(){
		$row = get_row();  
		$row_index = get_row_index();
		$section_settings = WPBC_get_flex_layout($row); 

		//
		$settings = array(

			'layout_ID' => $layout_ID,

			'layout_type' => $layout_type, 

		);

		return $settings;
	}
} 