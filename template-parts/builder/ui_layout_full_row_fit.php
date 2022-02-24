<?php WPBC_flex_layout_start(); ?>

<?php  

	$row = get_row();   

	$section_settings = WPBC_get_flex_layout($row); 

	$content = WPBC_get_flex_layout_field('content'); 
		$content = WPBC_get_flex_layout_cleaned($content, 'content__');
	
		$content_settings = $content['section-title-settings'];
			$content_settings = WPBC_get_flex_layout_cleaned($content_settings, 'section-title-settings__');
	
	$style = WPBC_get_flex_layout_field('style');   

	$full_row_fit = array(

		'id' => $section_settings['id'],

		'class' => '',
		'attrs' => '',
		
		'breakpoint' => !empty($style['breakpoint']) ? $style['breakpoint'] : 'lg',
		'content_side' => !empty($style['style_content_side']) ? $style['style_content_side'] : 'left',
		'content_size' => !empty($style['style_content_size']) ? $style['style_content_size'] : 6,
		'background__size' => !empty($style['style_content_size']) ? ( 12 - intval($style['style_content_size'])  )  : 6,
		'type' => !empty($style['style_type']) ? $style['style_type'] : 'default',

		'content' => array(
			
			'class' => '',
			'attrs' => '',

			'headline' =>  !empty($content['section-title-use']) ? $content['section-title'] : '',
			'headline_class' => '',
			'headline_attrs' => '',
			'headline_title_class' => !empty($content_settings['heading']) ? str_replace('.', '', $content_settings['heading']) : '',   
			
			'wysiwyg' => !empty($content['wysiwyg']) ? $content['wysiwyg'] : '',
			'wysiwyg_class' => '',
			'wysiwyg_attrs' => '',

			'before' => '',
			'after' => '',

			'overlap_holder_attrs' => '',
			'overlap_class' => '',
			'overlap_attrs' => '',
			'overlap_content' => '',
		
		),

		'overlap_content' => array(

			'class' => '',
			'attrs' => '',

			'overlap_images' => !empty($style['style_gallery']) ? $style['style_gallery'] : array(),
			'overlay_slick_args' => array(),

			'overlap_class' => '',
			'overlap_attrs' => '',

			'before' => '',
			'after' => '',
		),

	);

	$full_row_fit = apply_filters('wpbc/filter/ui_layout_full_row_fit/args', $full_row_fit);
 	
	$breakpoint_colors = array();
	$breakpoint_text_colors = array();

	$style_backgrund_color = $style['style_backgrund_color'];
	$style_text_color = $style['style_text_color'];
	$style_backgrund_color_breakpoint = $style['style_backgrund_color_breakpoint'];
	$style_text_color_breakpoint = $style['style_text_color_breakpoint'];

	if( !empty($style_backgrund_color) ){
		$breakpoint_colors['default']['background-color'] = $style_backgrund_color;
	}
	if( !empty($style_backgrund_color_breakpoint) ){
		$breakpoint_colors[$full_row_fit['breakpoint']]['background-color'] = $style_backgrund_color_breakpoint;
	}
	if( !empty($style_text_color) ){
		$breakpoint_text_colors['default']['color'] = $style_text_color;
	}
	if( !empty($style_text_color_breakpoint) ){
		$breakpoint_text_colors[$full_row_fit['breakpoint']]['color'] = $style_text_color_breakpoint;
	} 

	$full_row_fit['content']['overlap_attrs'] .= ' style="';
	if(!empty($style_backgrund_color)){
		$full_row_fit['content']['overlap_attrs'] .= 'background-color:'.$style_backgrund_color.';';
	} 
	$full_row_fit['content']['overlap_attrs'] .= '" '; 

	$full_row_fit['overlap_content']['overlap_attrs'] .= ' style="';
	if(!empty($style_backgrund_color)){
		$full_row_fit['overlap_content']['overlap_attrs'] .= 'background-color:'.$style_backgrund_color.';';
	} 
	$full_row_fit['overlap_content']['overlap_attrs'] .= '" '; 

	$overlap_attrs = '';   
	if(!empty($breakpoint_colors['default']) && !empty($breakpoint_colors[ $full_row_fit['breakpoint'] ])){  
		$overlap_attrs .= ' data-breakpoint-style="'.$full_row_fit['breakpoint'].'" ';
		$overlap_attrs .= ' data-style-default=\''. json_encode($breakpoint_colors['default']) .'\'';  
		$overlap_attrs .= ' data-style-breakpoint=\''. json_encode($breakpoint_colors[$full_row_fit['breakpoint']]) .'\'';
	}
	$full_row_fit['content']['overlap_attrs'] .= $overlap_attrs;
	$full_row_fit['overlap_content']['overlap_attrs'] .= $overlap_attrs;


	$full_row_fit['content']['attrs'] .= 'style="';
	if(!empty($style_text_color)){
		$full_row_fit['content']['attrs'] .= 'color:'.$style_text_color.';';
	}
	$full_row_fit['content']['attrs'] .= '" ';

	$content_attrs = '';  
	if(!empty($breakpoint_text_colors['default']) && !empty($breakpoint_text_colors[ $full_row_fit['breakpoint'] ])){  
		$content_attrs .= ' data-breakpoint-style="'.$full_row_fit['breakpoint'].'" ';
		$content_attrs .= ' data-style-default=\''. json_encode($breakpoint_text_colors['default']) .'\''; 
		$content_attrs .= ' data-style-breakpoint=\''. json_encode($breakpoint_text_colors[$full_row_fit['breakpoint']]) .'\'';
		}
	$full_row_fit['content']['attrs'] .= $content_attrs;

	$content_order = '2';
	$content_order_breakpoint = '1';
	$background_order = '1';
	$background_order_breakpoint = '2';

	if($full_row_fit['content_side']=='right'){
		$content_order = '1';
		$content_order_breakpoint = '2';
		$background_order = '1';
		$background_order_breakpoint = '2';
	}


	if( $full_row_fit['type'] == 'content-up' ){
		$content_order = '1';
		$background_order = '2';
	}

	$col_content_class = ' col-'.$full_row_fit['breakpoint'].'-'.$full_row_fit['content_size']; 

		$col_content_class .= ' order-'.$content_order;
		$col_content_class .= ' order-'.$full_row_fit['breakpoint'].'-'.$content_order_breakpoint;  

		$full_row_fit['content']['class'] .= $col_content_class;

	$col_background_class = ' col-'.$full_row_fit['breakpoint'].'-'.$full_row_fit['background__size']; 

		$col_background_class .= ' order-'.$background_order;
		$col_background_class .= ' order-'.$full_row_fit['breakpoint'].'-'.$background_order_breakpoint;

		$full_row_fit['overlap_content']['class'] .= $col_background_class;

	/* filter if type, side, etc... */
	if( $full_row_fit['type'] == 'title-up' ){
		$headline_class = $full_row_fit['content']['headline_class'];
		$full_row_fit['content']['headline_class'] .= ' d-none d-'.$full_row_fit['breakpoint'].'-block ';
		$full_row_fit['content']['headline_attrs'] .= 'data-clone="#cloned-'. $full_row_fit['id'] .'-title" ';
		
		$overlap_content_style = '';
		if(!empty($style_text_color)){
			$overlap_content_style .= 'color:'.$style_text_color.';';
		}
		$full_row_fit['overlap_content']['before'] .= '<div class="position-relative" style="'.$overlap_content_style.'">';
		
		$full_row_fit['overlap_content']['before'] .= '<div id="cloned-'. $full_row_fit['id'] .'-title" class="d-'.$full_row_fit['breakpoint'].'-none position-relative z-index-10 '.$headline_class.'"></div>';
		$full_row_fit['overlap_content']['before'] .= '<div id="cloned-'. $full_row_fit['id'] .'-bg" class="d-'.$full_row_fit['breakpoint'].'-none position-absolute-full z-index-0 '.$headline_class.'"></div>';
		$full_row_fit['overlap_content']['before'] .= '</div>';

		$full_row_fit['content']['overlap_holder_attrs'] .= ' data-clone="#cloned-'. $full_row_fit['id'] .'-bg" ';
 		
 		$content_attrs = '';  
		 if(!empty($breakpoint_text_colors['default']) && !empty($breakpoint_text_colors[ $full_row_fit['breakpoint'] ])){ 
			$content_attrs .= ' data-breakpoint-style="'.$full_row_fit['breakpoint'].'" ';
			$content_attrs .= ' data-style-default=\''. json_encode($breakpoint_text_colors['default']) .'\'';  
			$content_attrs .= ' data-style-breakpoint=\''. json_encode($breakpoint_text_colors[$full_row_fit['breakpoint']]) .'\'';
		}
		$full_row_fit['content']['overlap_holder_attrs'] .= $content_attrs;

	}

	if( $full_row_fit['type'] == 'content-overlap' ){
		$full_row_fit['content']['class'] .= ' position-absolute-full position-'.$full_row_fit['breakpoint'].'-inherit z-index-10 ';
	}

	// Just in case (not recomended)

	$full_row_fit = apply_filters('wpbc/filter/ui_layout_full_row_fit/filtered_args', $full_row_fit);

	WPBC_get_full_row_fit($full_row_fit);

	?>

<?php WPBC_flex_layout_end(); ?>