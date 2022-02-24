<?php


/*

	ui_bs_jumbotron

*/

add_filter('wpbc/filter/flexible_content/layout_title?name=ui_bs_jumbotron', function($title, $value){  
	$title = $value['field_ui_bs_jumbotron__content']['field_ui_bs_jumbotron__content_headline__section-title']; 
	return $title; 
},10,2);

add_filter('wpbc/filter/acf/builder/flexible_content/layouts', 'WPBC_build__ui_bs_jumbotron',20,1);  
	
	function WPBC_build__ui_bs_jumbotron($layouts){ 

		$layout_name = 'ui_bs_jumbotron';

		$layout_label = '<i class="icon-badge">'.WPBC_get_flex_flex_builder_layout_BS_icon().'</i> Jumbotron';  

		$content_sub_fields = array();

			$content_sub_sub_fields = array();
				$content_sub_sub_fields = WPBC_acf_make_section_title_field($content_sub_sub_fields, array(
					'layout_name' => $layout_name.'__content_headline',
					'hide_responsive' => true,
					'hide_align' => false,
					'hide_use' => true,
				)); 

				$content_sub_sub_fields[] = WPBC_acf_make_wysiwyg_field_format(array(
					'label' => __('Content','bootclean'),
					'name' => $layout_name.'__content_lead',
				));

		$content_sub_fields[] = WPBC_acf_make_group_field(array(
			'label' => __('Content','bootclean'),
			'name' => $layout_name.'__content',
			'sub_fields' => $content_sub_sub_fields,
			'width' => '70%',
		)); 

		$content_sub_fields[] = WPBC_acf_make_group_layout_style_field(array(
			'label' => __('Style','bootclean'),
			'name' => $layout_name.'__style', 
			'width' => '30%',
		));

		$layouts = WPBC_acf_make_flex_builder_layout(array(
			'layout_name' => $layout_name,
			'layout_label' => $layout_label,
			'content_sub_fields' => $content_sub_fields,
			'show_section_title' => false,
			'show_section_settings' => true,
			'show_section_styles' => true,
			'section_settings_defaults' => array(  
				'classes' => array(
					'default' => false,
				), 
			),
		), $layouts); 

		return $layouts;  
	}