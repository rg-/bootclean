<?php WPBC_flex_layout_start(); ?>

<?php  

	$row = get_row();   

	$section_settings = WPBC_get_flex_layout($row);  
 
	$breakpoint = WPBC_get_flex_layout_field('breakpoint'); 

	$columns = WPBC_get_flex_layout_field('columns');  
	
	$temp_cols = array();
	foreach ($columns as $key => $value) {
		$columns_content = WPBC_get_flex_layout_cleaned($value['columns_content'], 'columns_content__');
		$columns_style = WPBC_get_flex_layout_cleaned($value['columns_style'], 'columns_style__');

		//_print_code($columns_style);

		$content_title = '';
		if(!empty($columns_content['section-title-use'])){
			$settings = $columns_content['section-title-settings'];
			$class = str_replace('.','', $settings['section-title-settings__heading']);
			$content_title = '<h2 class="'. $class .'">'.$columns_content['section-title'].'</h2>';
		}

		$breakpoint_colors = array();
		$breakpoint_text_colors = array();

		$content_background_attrs = ' style="';

			if( !empty($columns_style['columns_style_backgrund_color']) ){ 
				$content_background_attrs .= 'background-color:'. $columns_style['columns_style_backgrund_color'] .';';
				$breakpoint_colors['default']['background-color'] = $columns_style['columns_style_backgrund_color'];
			}
			if( !empty($columns_style['columns_style_text_color']) ){
				$content_background_attrs .= 'color:'. $columns_style['columns_style_text_color'] .';';
				$breakpoint_colors['default']['color'] = $columns_style['columns_style_text_color'];
				$breakpoint_text_colors['default']['color'] = $columns_style['columns_style_text_color'];
			} 
			
			if( !empty($columns_style['columns_style_backgrund_color_breakpoint']) ){ 
				$breakpoint_colors[$breakpoint]['background-color'] = $columns_style['columns_style_backgrund_color_breakpoint'];
			}
			if( !empty($columns_style['columns_style_text_color_breakpoint']) ){  
				$breakpoint_colors[$breakpoint]['color'] = $columns_style['columns_style_text_color_breakpoint'];
				$breakpoint_text_colors[$breakpoint]['color'] = $columns_style['columns_style_text_color_breakpoint'];
			}

		$content_background_attrs .= '" '; 

		if(!empty($breakpoint_colors['default'])){  
			$content_background_attrs .= ' data-breakpoint-style="'.$breakpoint.'" ';
			$content_background_attrs .= ' data-style-default=\''. json_encode($breakpoint_colors['default']) .'\'';
			$content_background_attrs .= ' data-style-breakpoint=\''. json_encode($breakpoint_colors[$breakpoint]) .'\'';
		}
		//_print_code(json_encode($breakpoint_colors[$breakpoint]));

		$content_attrs = 'style="';
		if( !empty($columns_style[$breakpoint]['columns_style_text_color']) ){
			$content_attrs .= 'color:'. $columns_style['columns_style_text_color'] .';';
		}
		$content_attrs .= '" ';
		if(!empty($breakpoint_text_colors['default'])){
			$content_attrs .= ' data-breakpoint-style="'.$breakpoint.'" ';
			$content_attrs .= ' data-style-default=\''. json_encode($breakpoint_text_colors['default']) .'\'';
			$content_attrs .= ' data-style-breakpoint=\''. json_encode($breakpoint_text_colors[$breakpoint]) .'\'';
		}

		$temp_cols[] = array(
			'col_type' => $columns_style['columns_style_type'],  
			'col_size' => $columns_style['columns_style_size'], 
			//'col_order' => '3',
			//'col_order_breakpoint' => '3', 
			//'col_class' => 'p-0', 

			'content' => array(
				
				'content_class' => '', 
				
				'content_background_class' => '',

				'content_background_attrs' => $content_background_attrs,
				'content_attrs' => $content_attrs,
				'title' => $content_title,
				'wysiwyg' => $columns_content['wysiwyg'],

				'content_before' => '',
				'content_after' => '',
			),

			'overlap_content' => array(
				'overlap_embed' => '21by9',
				'overlap_class' => '',
				'overlap_attrs' => '',
				'overlap_images' => $columns_style['columns_style_gallery'], 
				'overlay_slick_args' => array(),

				'overlap_before' => '',
				'overlap_after' => '',
			),

		); 
	}
	// _print_code($temp_cols);

	$auto_fit = 'full'; // full, center
	
	if( $auto_fit ){ 
		$temp = $temp_cols;
		foreach ($temp as $key => $col) {
			$temp[$key]['col_side'] = 'center';
		}
		if( $auto_fit == 'full' ){
			$temp[0]['col_side'] = 'left';
			$temp[ ( count($temp)-1 ) ]['col_side'] = 'right';
		}
		$cols = $temp;
	}    

	$full_content_fit = array(
		'layout_id' => $section_settings['id'],
		'breakpoint' => $breakpoint,  
		'cols' => $cols,
	);

	$args = apply_filters('wpbc/filter/ui_layout_full_content_fit/args',$args);

	WPBC_get_full_content_fit( $full_content_fit ); 

?>

<?php WPBC_flex_layout_end(); ?>