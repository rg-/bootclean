<?php  
	
	function WPBC_build__ui_layout_subflexible($layouts){ 

		$layout_name = 'ui_layout_subflexible';

		$layout_label = '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/></g><g><g/><g><path class="path" fill="#fff" d="M8,8H6v7c0,1.1,0.9,2,2,2h9v-2H8V8z"/><path class="path" fill="#fff" d="M20,3h-8c-1.1,0-2,0.9-2,2v6c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V5C22,3.9,21.1,3,20,3z M20,11h-8V7h8V11z"/><path class="path" fill="#fff" d="M4,12H2v7c0,1.1,0.9,2,2,2h9v-2H4V12z"/></g></g><g display="none"><g display="inline"/><g display="inline"><path class="path" fill="#fff" d="M8,8H6v7c0,1.1,0.9,2,2,2h9v-2H8V8z"/><path class="path" fill="#fff"d="M20,3h-8c-1.1,0-2,0.9-2,2v6c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V5C22,3.9,21.1,3,20,3z M20,11h-8V7h8V11z"/><path class="path" fill="#fff" d="M4,12H2v7c0,1.1,0.9,2,2,2h9v-2H4V12z"/></g></g></svg></i> Sub Flexible Layout'; 
		
		$content_sub_fields = array();  

		$sub_layouts = array();
		$sub_layouts = apply_filters('wpbc/filter/acf/builder/flexible_content/layouts', $sub_layouts);
		
		//unset($sub_layouts['ui_layout_subflexible']);

		$content_sub_fields[] = WPBC_acf_make_flexible_content(array(
			'label' => '',
			'name' => $layout_name.'__sub_content',
			'layouts' => $sub_layouts,
			'button_label' => __('Add Sub Row','bootclean'),
			'max' => 10,
		)); 

		$flexible_layouts = WPBC_acf_make_flex_builder_layout(array(
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
		), array());
		$layouts['layout_'.$layout_name] = $flexible_layouts['layout_'.$layout_name];

		return $layouts;  
	
	}

add_filter('WPBC_acf_builder_layouts', 'WPBC_build__ui_layout_flexible',9999,1);  
	
	function WPBC_build__ui_layout_flexible($layouts){ 

		$layout_name = 'ui_layout_flexible';

		$layout_label = '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/></g><g><g/><g><path class="path" fill="#fff" d="M8,8H6v7c0,1.1,0.9,2,2,2h9v-2H8V8z"/><path class="path" fill="#fff" d="M20,3h-8c-1.1,0-2,0.9-2,2v6c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V5C22,3.9,21.1,3,20,3z M20,11h-8V7h8V11z"/><path class="path" fill="#fff" d="M4,12H2v7c0,1.1,0.9,2,2,2h9v-2H4V12z"/></g></g><g display="none"><g display="inline"/><g display="inline"><path class="path" fill="#fff" d="M8,8H6v7c0,1.1,0.9,2,2,2h9v-2H8V8z"/><path class="path" fill="#fff"d="M20,3h-8c-1.1,0-2,0.9-2,2v6c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V5C22,3.9,21.1,3,20,3z M20,11h-8V7h8V11z"/><path class="path" fill="#fff" d="M4,12H2v7c0,1.1,0.9,2,2,2h9v-2H4V12z"/></g></g></svg></i> Flexible Layout'; 
		
		$content_sub_fields = array();  

		$sub_layouts = array();
		$sub_layouts = apply_filters('wpbc/filter/acf/builder/flexible_content/layouts', $sub_layouts);
		
		//$sub_layouts = WPBC_build__ui_layout_subflexible($sub_layouts);
		//unset($sub_layouts['ui_layout_subflexible']);

		$content_sub_fields[] = WPBC_acf_make_flexible_content(array(
			'label' => '',
			'name' => $layout_name.'__sub_content',
			'layouts' => $sub_layouts,
			'button_label' => __('Add Sub Row','bootclean'),
			'max' => 10,
		)); 

		$flexible_layouts = WPBC_acf_make_flex_builder_layout(array(
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
		), array());
		$layouts['layout_'.$layout_name] = $flexible_layouts['layout_'.$layout_name];

		return $layouts;  
	
	}