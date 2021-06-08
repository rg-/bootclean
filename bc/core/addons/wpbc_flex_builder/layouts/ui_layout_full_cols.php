<?php

/*
		ui_layout_full_cols
*/
		
add_filter('wpbc/filter/acf/builder/flexible_content/layouts', 'WPBC_build__ui_layout_full_cols',20,1);  
	
	function WPBC_build__ui_layout_full_cols($layouts){ 

		$layout_name = 'ui_layout_full_cols';

		$layout_label = '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#fff" class="svg"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 5v14c0 1.1.89 2 2 2h6V3H5c-1.11 0-2 .9-2 2zm16-2h-6v8h8V5c0-1.1-.9-2-2-2zm-6 18h6c1.1 0 2-.9 2-2v-6h-8v8z"/></svg></i> Full Columns'; 
		
		$content_sub_fields = array();  

		$content_sub_fields[] = WPBC_acf_make_select_field(array(
			'label' => '<span title="Above breakpoint">' . __('Image side','bootclean') . '*</span>',
			'name' => $layout_name.'__image_side',  
			'choices' => array(
				'left'=>'Left',
				'right'=>'Right', 
			),
			'default_value' => 'left',
			'width' => '20%'
		));

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

		$content_sub_fields[] = WPBC_acf_make_number_field(array(
			'label' => '<span title="Above breakpoint">' . __('Image size','bootclean') . '*</span>',
			'name' => $layout_name.'__image_size',   
			'default_value' => '6',
			'min' => '1',
			'max' => '11',
			'prepend' => 'col/s',
			'width' => '20%'
		)); 

		$content_sub_fields[] = WPBC_acf_make_select_field(array(
			'label' => '<span title="Below breakpoint">' . __('Image position','bootclean') . '*</span>',
			'name' => $layout_name.'__image_break_position',  
			'choices' => array(
				'top'=>'Top',
				'bottom'=>'Bottom', 
				'middle'=>'Middle', 
			),
			'default_value' => 'top',
			'width' => '20%',
		));

		$content_sub_fields[] = WPBC_acf_make_select_field(array(
			'label' => '<span title="Below breakpoint">' . __('Image embed size','bootclean') . '*</span>',
			'name' => $layout_name.'__image_embed',  
			'choices' => array(
				'1by1'=>'1by1',
				'4by3'=>'4by3', 
				'16by9'=>'16by9', 
				'21by9'=>'21by9', 
			),
			'default_value' => '16by9',
			'width' => '20%',
		)); 

		$content_sub_fields[] = WPBC_acf_make_text_field(array(
			'label' => __('Content Class','bootclean'),
			'name' => $layout_name.'__content_class',
			'width' => '50%',
		)); 
		$content_sub_fields[] = WPBC_acf_make_text_field(array(
			'label' => __('Image/Gallery Class','bootclean'),
			'name' => $layout_name.'__gallery_class',
			'width' => '50%',
		)); 

		$sub_fields_content = array();

			$sub_fields_content = WPBC_acf_make_section_title_field($sub_fields_content, array(
				'layout_name' => $layout_name,
				'hide_responsive' => true,
				'hide_align' => false,
				'hide_use' => false,
			));  

			$sub_fields_content[] = WPBC_acf_make_wysiwyg_field_format_all(array(
				'label' => __('Content','bootclean'),
				'name' => $layout_name.'__content_wysiwyg',    
				'class' => 'acf-small-wysiwyg',
				'delay' => 0,
			)); 

		$content_sub_fields[] = WPBC_acf_make_group_field(array(
			'label' => __('Content Column','bootclean'),
			'name' => $layout_name.'__content', 
			'sub_fields' => $sub_fields_content,
			'width' => '70%',  
		));

		$content_sub_fields[] = WPBC_acf_make_gallery_advanced_field(array(
			'label' => __('Image/Gallery Column','bootclean'),
			'name' => $layout_name.'__gallery', 
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


if(!function_exists('WPBC_get_ui_layout_full_cols()')){
	function WPBC_get_ui_layout_full_cols(){
		$row = get_row();  
		$row_index = get_row_index();
		$section_settings = WPBC_get_flex_layout($row);

		//
		$breakpoint = WPBC_get_flex_layout_field('breakpoint');  
		
		//		
		$image_side = WPBC_get_flex_layout_field('image_side'); 
		if($image_side == 'left'){
			$content_side = 'right';
		} else {
			$content_side = 'left';
		}  
		
		//
		$image_embed = WPBC_get_flex_layout_field('image_embed');  

		//
		$gallery = WPBC_get_flex_layout_field('gallery'); 
	 
	  //
		$image_size = WPBC_get_flex_layout_field('image_size'); 
			$col_img_class = 'p-0 col-'.$breakpoint.'-'.$image_size;
				$col_size = number_format(12 - $image_size);
			$col_content_class = 'col-'.$breakpoint.'-'.$col_size;

		//

		$content = WPBC_get_flex_layout_field('content');  
		$content_title_settings = $content['section-title-settings']; 
		$content_title_settings = WPBC_get_flex_layout_cleaned($content_title_settings, 'section-title-settings__');
		$use_title = $content['section-title-use'];
		$content_title = $content['section-title']; 
			
		// TODO if field for title is wysiwyg and not textarea like now
		// $content_title = apply_filters('the_content', $content_title); 
			
			$content_title = apply_filters('wpbc/filter/ui_layout_full_cols/content_title', $content_title, $breakpoint, $image_side); 

		$content_wysiwyg = $content['content_wysiwyg'];
		$content_wysiwyg = apply_filters('the_content', $content_wysiwyg);   
		$content_wysiwyg = apply_filters('wpbc/filter/ui_layout_full_cols/content_wysiwyg', $content_wysiwyg, $breakpoint, $image_side); 

		$container_content_class = apply_filters('wpbc/filter/ui_layout_full_cols/container_content_class', 'container', $breakpoint, $image_side);
		$row_content_class = apply_filters('wpbc/filter/ui_layout_full_cols/row_content_class', 'row', $breakpoint, $image_side);

		$content_class = WPBC_get_flex_layout_field('content_class');  
		$col_content_wrap_class = apply_filters('wpbc/filter/ui_layout_full_cols/content_wrap_class', $content_class, $breakpoint, $image_side); 

		$gallery_class = WPBC_get_flex_layout_field('gallery_class');  
		$col_gallery_wrap_class = apply_filters('wpbc/filter/ui_layout_full_cols/gallery_wrap_class', $gallery_class, $breakpoint, $image_side); 

		$col_content_title_wrap_class = apply_filters('wpbc/filter/ui_layout_full_cols/content_title_wrap_class', '', $breakpoint, $image_side); 

		$col_content_wysiwyg_wrap_class = apply_filters('wpbc/filter/ui_layout_full_cols/content_wysiwyg_wrap_class', '', $breakpoint, $image_side); 

		//

		/*
			
		?? $image_break_position = WPBC_get_flex_layout_field('image_break_position');

			Types: 

				default
				title-up
				overlay-content
				overlay-title
		*/

		$layout_settings = WPBC_get_flex_layout_settings();
			$layout = $layout_settings['layout'];
			$layout_ID = $layout_settings['id'];
			$layout_row_index = $layout_settings['row_index'];

		$layout_type = 'title-up';

		$title_attrs = '';

		if($layout_type == 'title-up'){
			$title_attrs = 'data-clone="#'. $layout_ID .'-col-fullside-cloned"'; 
			$col_content_title_wrap_class .= ' d-none d-'.$breakpoint.'-block';
		}

		//
		$settings = array(

			'layout_ID' => $layout_ID,

			'layout_type' => $layout_type,

			'breakpoint' => $breakpoint,
			'content_side' => $content_side,
			'image_embed' => $image_embed,
			'gallery_ids' => $gallery,

			'col_img_class' => $col_img_class, 
			'col_gallery_wrap_class' => $col_gallery_wrap_class,


			'content_wysiwyg' => $content_wysiwyg,
			'container_content_class' => $container_content_class,
			'row_content_class' => $row_content_class,
			'col_content_class' => $col_content_class,
			'col_content_wrap_class' => $col_content_wrap_class,
			'col_content_wysiwyg_wrap_class' => $col_content_wysiwyg_wrap_class,

			'use_title' => $use_title,
			'content_title' => $content_title,
			'title_attrs' => $title_attrs,
			'content_title_settings' => $content_title_settings, 
			'col_content_title_wrap_class' => $col_content_title_wrap_class, 

			'custom_content_title' => $custom_content_title, // ?? 
		);

		return $settings;
	}
} 