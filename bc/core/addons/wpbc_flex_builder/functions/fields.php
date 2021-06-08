<?php

add_filter('acf/fields/flexible_content/layout_title', function($title, $field, $layout, $i){

		if( is_admin() && defined( 'DOING_AJAX' ) && DOING_AJAX && isset($_POST['value']) ){ 
			// code to handle the AJAX
    	$value = $_POST['value'];  
    }else{
    	// code normal php load
    	$value = !empty($field['value'][$i]) ? $field['value'][$i] : null;
    }

    $check = WPBC_flex_builder_layouts(); 
    $check = apply_filters('wpbc/filter/flexible_content/layout_title/layouts', $check);
   
    if( in_array($layout['name'], $check) ){ 

    	$before = '';
    	$after = '';

    	$section_styles = WPBC_get_flex_layout_field('section_styles', $value); 

    	if( !empty($section_styles) ){
    		$background_color = $section_styles['section_styles_background_color'];
    		$text_color = $section_styles['section_styles_text_color'];

    		$before = '<small title="background-color: '.$background_color.'; text-color: '.$text_color.'" style="background-color:var(--'.$background_color.'); color:var(--'.$text_color.');" class="wpbc-badge wpbc-badge-style bg-'.$background_color.'"><span style="color:var(--'.$text_color.');display: flex;height: 100%;width: 100%;align-items: center;justify-content: center;">a</span></small> ';
    	} 

    	if($layout['name'] == 'ui_layout_template'){
    		$template_id = WPBC_get_flex_layout_field('post', $value);
    		if(!empty($template_id)){ 
	    		$t = get_the_title($template_id);
	    		$edit_link = get_edit_post_link($template_id);
	    		$after = ' <a title="'.__('EDIT','bootclean').': '.$t.'" class="wpbc-btn-small button" href="'.$edit_link.'"><small>'.$t.'</small></a>';
    		}
    	}

    	if($layout['name'] == 'ui_layout_template_part'){
    		$template_file = WPBC_get_flex_layout_field('file', $value); 
    		$after = '&nbsp;&nbsp;<span title="template-parts/theme/'.$template_file.'.php" class="wpbc-badge" style="padding:0 5px;"><small>'.$template_file.'.php</small></span>';
    	}

    	$section_title = WPBC_get_flex_layout_field('section-title', $value);
    	if(empty($section_title)){
    		$section_content = WPBC_get_flex_layout_field('content', $value);
    		$section_title = $section_content['section-title'];
    	}
    	if(!empty($section_title)){
    		$trim_title = wp_trim_words( $section_title, 5, '...' );
    		$title .= ' - <span title="'.__('Section Title','bootclean').'" class="wpbc-badge success" style="padding:0 5px;"><small>'.$trim_title.'</small></span>';
    	}
    	// _print_code($layout);
    	$title = $before.$title.$after;

    }

		return $title;

	}, 10, 4); 

if(!function_exists('WPBC_acf_make_flex_builder_layout')){

	function WPBC_acf_make_flex_builder_layout($args=array(), $layouts=array()){

		if(empty($args)) return; 

		$layout_name = !empty($args['layout_name']) ? $args['layout_name'] : 'ui_layout_test';
		$layout_label = !empty($args['layout_label']) ? $args['layout_label'] : 'Layout Test';

		$args = apply_filters('wpbc/filter/make_flex_builder_layout/pre/args',$args,$layout_name);

		$sub_fields = array();

		$sub_fields[] = WPBC_acf_make_tab_field(
			array(
				'key' => $layout_name.'__content_tab',
				'label' => __('Content','bootclean'),
				'placement' => 'top',
			)
		);

			if(!empty($args['show_section_title'])){

					// hide_responsive_title
					$hide_responsive = false;
					$hide_align = false;
					$hide_use = false;
					if( !empty($args['hide_responsive_title']) ){
						$hide_responsive = true;
					}
					if( !empty($args['hide_align_title']) ){
						$hide_align = true;
					} 
					if( !empty($args['hide_section_title_use']) ){
						$hide_use = true;
					}

					$sub_fields = WPBC_acf_make_section_title_field($sub_fields, array(
						'layout_name' => $layout_name,
						'hide_responsive' => $hide_responsive,
						'hide_align' => $hide_align,
						'hide_use' => $hide_use,
					));  
				}

		
		if(!empty($args['content_sub_fields'])){
			$content_sub_fields = $args['content_sub_fields'];
			foreach ($content_sub_fields as $key => $value) {
				$sub_fields[] = $value;
			}
		}

		if(!empty($args['show_section_settings'])){

			$sub_fields_section_options = WPBC_acf_make_layout_settings_sub_fields($args, $layout_name);

			$sub_fields[] = WPBC_acf_make_tab_field(
				array(
					'key' => $layout_name.'__section_settings_tab',
					'label'=> '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><path d="M0,0h24v24H0V0z" fill="none"/><path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/></g></svg>',
					'placement' => 'top',
				)
			); 

			$sub_fields[] = WPBC_acf_make_group_field(
				array(
					'name' => $layout_name.'__section_settings',
					'label'=>'',  
					'width' => '100%',
					'sub_fields' => $sub_fields_section_options,
					'class' => 'wpbc-group-no-border wpbc-group-no-label',
				)
			); 

			$sub_fields[] = WPBC_acf_make_true_false_field(
					array(
						'name' => $layout_name.'__section_visible',
						'label'=> __('Hide this Layout?','bootclean'),
						'instructions' => __('Enabling this HTML for this layout will not be rendered. This is not same as hidding it using css like "d-none" for example.','bootclean'),  
						'default_value' => 0, 
						'message' => '',
						'width' => '100%', 
					)
				); 
		}

		if(!empty($args['show_section_styles'])){

			$sub_fields_section_styles = WPBC_acf_make_layout_styles_sub_fields($args, $layout_name);

			$sub_fields[] = WPBC_acf_make_tab_field(
				array(
					'key' => $layout_name.'__section_styles_tab',
					'label'=> '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z"/></svg>',
					'placement' => 'top',
					'class' => 'wpbc-tab-float-right',
				)
			);  

			$sub_fields[] = WPBC_acf_make_group_field(
				array(
					'name' => $layout_name.'__section_styles',
					'label'=>'',  
					'width' => '100%',
					'sub_fields' => $sub_fields_section_styles,
					'class' => 'wpbc-group-no-border wpbc-group-no-label',
				)
			); 

		}

		$layouts['layout_'.$layout_name] = array(
			'key' => 'layout_'.$layout_name,
			'name' => $layout_name,
			'label' => $layout_label,
			'display' => 'block',
			'sub_fields' => $sub_fields,
			'min' => '',
			'max' => '',
		); 

		return $layouts; 

	}

}  

function WPBC_acf_make_layout_styles_sub_fields($args, $layout_name){

	$sub_fields_section_styles = array();

	$def_color = 'transparent'; 
	$sub_fields_section_styles[] = WPBC_acf_make_radio_field( array(
			'name' => $layout_name.'__section_styles_background_color',
			'label'=>  __('Background color','bootclean'),
			'choices' => WPBC_get_acf_root_colors_choices($layout_name.'__section_styles_background_color'),
			'default_value' => $def_color,
			'width' => '50%',
			'class' => 'wpbc-radio-as-btn no-padding-radio-label', 
		) );

	$def_color = 'body-color'; 
	$sub_fields_section_styles[] = WPBC_acf_make_radio_field( array(
			'name' => $layout_name.'__section_styles_text_color',
			'label'=>  __('Text color','bootclean'),
			'choices' => WPBC_get_acf_root_colors_choices($layout_name.'__section_styles_text_color'),
			'default_value' => $def_color,
			'width' => '50%',
			'class' => 'wpbc-radio-as-btn no-padding-radio-label', 
		) );


	// NEW V12
	global $WPBC_VERSION;  
	if ( version_compare( $WPBC_VERSION, '12', '>' ) ) {

		$sub_fields_section_styles[] = WPBC_acf_make_gallery_advanced_field( array(
			'name' => $layout_name.'__section_styles_images',
			'label' => __('Background image/s','bootclean'),
			'class' => 'acf-small-gallery',
			'button_label' => __('Add image','bootclean'),
		) );

		$sub_fields_section_styles[] = WPBC_acf_make_codemirror_field( array(
			'name' => $layout_name.'__section_styles_html',
			'label' => __('Background Custom HTML','bootclean'), 
		) );


	}

	return $sub_fields_section_styles;

}

function WPBC_acf_make_layout_settings_sub_fields($args, $layout_name){

	$sub_fields_section_options = array();

	if(empty($args['hide_attributes'])){
				
				$sub_fields__attributes = array();

					$sub_fields__attributes[] = WPBC_acf_make_text_field(array(
						'name' => $layout_name.'__attributes_id', 
						'prepend' => 'ID #',
						'class' => 'wpbc-field-no-label',
						'width' => '40%',
					));  

					$sub_fields__attributes[] = WPBC_acf_make_text_field(array(
						'name' => $layout_name.'__attributes_class', 
						'prepend' => __('Layout Class','bootclean'),
						'class' => 'wpbc-field-no-label',
						'width' => '40%',
					)); 

					$show_classes = true;

					if( isset($args['section_settings_defaults']['classes']) && empty($args['section_settings_defaults']['classes']) ){
						$show_classes = false;
					}

					if( $show_classes ){

						$attributes_classes = isset($args['section_settings_defaults']['classes']['default']) ? $args['section_settings_defaults']['classes']['default'] : true;

						$sub_fields__attributes[] = WPBC_acf_make_true_false_field(array(
							'name' => $layout_name.'__attributes_classes', 
							'message' => __('Bootstrap?','bootclean'),
							'class' => 'wpbc-field-no-label wpbc-true_false-ui',
							'width' => '20%',  
							'default_value' => $attributes_classes,
						));

						$container_class = !empty($args['section_settings_defaults']['classes']['container_class']) ? $args['section_settings_defaults']['classes']['container_class'] : 'container';

						$row_class = !empty($args['section_settings_defaults']['classes']['row_class']) ? $args['section_settings_defaults']['classes']['row_class'] : 'row';

						$column_class = !empty($args['section_settings_defaults']['classes']['column_class']) ? $args['section_settings_defaults']['classes']['column_class'] : 'col-12'; 
  					
						$conditional_logic_classes_fields = array (
									array (
										array (
											'field' => 'field_'.$layout_name.'__attributes_classes',
											'operator' => '==',
											'value' => '1',
										),
									), 
								);

						$sub_fields__attributes[] = WPBC_acf_make_text_field(array(
							'name' => $layout_name.'__attributes_container_class', 
							'prepend' => __('Container','bootclean'),
							'class' => 'wpbc-field-no-label',
							'width' => '33%',
							'default_value' => $container_class,
							'conditional_logic' => $conditional_logic_classes_fields,
						));

						$sub_fields__attributes[] = WPBC_acf_make_text_field(array(
							'name' => $layout_name.'__attributes_row_class', 
							'prepend' => __('Row','bootclean'),
							'class' => 'wpbc-field-no-label',
							'width' => '33%',
							'default_value' => $row_class,
							'conditional_logic' => $conditional_logic_classes_fields,
						));

						$sub_fields__attributes[] = WPBC_acf_make_text_field(array(
							'name' => $layout_name.'__attributes_column_class', 
							'prepend' => __('Column','bootclean'),
							'class' => 'wpbc-field-no-label',
							'width' => '33%',
							'default_value' => $column_class,
							'conditional_logic' => $conditional_logic_classes_fields,
						));

					} // show_classes END  

				$sub_fields__attributes[] = WPBC_acf_make_textarea_field(array(
						'name' => $layout_name.'__attributes_data', 
						'label' => __('Custom Attributes','bootclean'), 
						'instructions' => __('Ex: data-custom="1" data-custom-2="2" ','bootclean'),
						'width' => '100%',
					));

				$sub_fields_section_options[] = WPBC_acf_make_group_field(array(
					'name' =>  $layout_name.'__attributes',
					// 'label' => __('Row attributes'),
					'sub_fields' => $sub_fields__attributes,
					'class' => 'wpbc-field-no-label wpbc-field-no-padding', 
				));

			}	

	return $sub_fields_section_options; 
} 