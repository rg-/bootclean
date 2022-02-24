<?php WPBC_flex_layout_start(); ?>

<?php  

	$content = WPBC_get_flex_layout_field('content');
	$settings = WPBC_get_flex_layout_field('settings');  
	

	/* 
		settings__options
		Options used to pass via data-slick attributes
		See: https://kenwheeler.github.io/slick/
	*/  

		
	$slick = WPBC_get_slick_options($settings);  

	$slick_class = 'theme-slick-slider';

	$slick_before = '';
	$slick_after = '';
	$slick_content_before = '';
	$slick_content_after = '';

	$slick_colors = array();
	$slick_array = json_decode($slick);

	$slick_colors['default'] = array(
		'dots' => $slick_array->style_options_dots_color,
			'dots_position' => $slick_array->style_options_dots_position,
			'dots_align' => $slick_array->style_options_dots_align,
		'arrows' => $slick_array->style_options_arrows_color,
			'arrows_position' => $slick_array->style_options_arrows_position,
			'arrows_align' => $slick_array->style_options_arrows_align,
	);
	if( !empty($slick_array->responsive) ){
		$slick_colors['responsive'] = array();
		$root_breakpoint = BC_get_root_breakpoint(array('remove_units'=>true)); 
		foreach ($slick_array->responsive as $key => $value) { 

			$set = $value->settings;
			$break = $value->breakpoint; 
			$n = array_keys($root_breakpoint, $break); 
			$slick_colors['responsive'][$n[0]] = array(
				'dots' => $set->style_options_dots_color,
					'dots_position' => $set->style_options_dots_position,
					'dots_align' => $set->style_options_dots_align,
				'arrows' => $set->style_options_arrows_color,
					'arrows_position' => $set->style_options_arrows_position,
					'arrows_align' => $set->style_options_arrows_align,
			); 
		}
	}
	$slick_colors_class = '';
	
	if(!empty($slick_colors['default'])){
		if( $slick_colors['default']['dots'] != 'none' ){
			$slick_colors_class .= 'slick-dots-'.$slick_colors['default']['dots'].' ';
		}
		if( $slick_colors['default']['arrows'] != 'none' ){
			$slick_colors_class .= 'slick-arrows-'.$slick_colors['default']['arrows'].' ';
		}

		$slick_colors_class .= ' slick-dots-position-'.$slick_colors['default']['dots_position'].' ';
		$slick_colors_class .= ' slick-dots-align-'.$slick_colors['default']['dots_align'].' ';
		$slick_colors_class .= ' slick-arrows-position-'.$slick_colors['default']['arrows_position'].' ';
		$slick_colors_class .= ' slick-arrows-align-'.$slick_colors['default']['arrows_align'].' ';

	}
	if(!empty($slick_colors['responsive'])){
		foreach ($slick_colors['responsive'] as $key => $value) {
			if( $value['dots'] != 'none' ){
				$slick_colors_class .= 'slick-dots-'.$key.'-'.$value['dots'].' ';
			}
			if( $value['arrows'] != 'none' ){
				$slick_colors_class .= 'slick-arrows-'.$key.'-'.$value['arrows'].' ';
			}

			$slick_colors_class .= ' slick-dots-position-'.$key.'-'.$value['dots_position'].' ';
			$slick_colors_class .= ' slick-dots-align-'.$key.'-'.$value['dots_align'].' ';
			$slick_colors_class .= ' slick-arrows-position-'.$key.'-'.$value['arrows_position'].' ';
			$slick_colors_class .= ' slick-arrows-align-'.$key.'-'.$value['arrows_align'].' ';

		}
		//_print_code($slick_colors['responsive']);
	} 

	$slick_custom = WPBC_get_slick_custom_options($settings);

	if( !empty($slick_custom['settings__custom_options__rowItemsList']) ){
		$slick_class .= ' slick-rowItemsList ';
	} 
	 
	if( !empty($slick_custom['settings__custom_options__overlapContainerDif']) ){
		$slick_class .= ' slick-overlapContainerDif ';
	} 
	if( !empty($slick_custom['settings__custom_options__overflowSides']) ){ 
		$slick_class .= ' slick-overflowSides '; 
		$overflowSides_type = $slick_custom['settings__custom_options__overflowSides_type']; 
			$slick_class .= ' slick-overflowSides-type-'.$overflowSides_type.' '; 

			if( $overflowSides_type == 'fade-edges' ){

				$fade_style = '';
				if( !empty($slick_custom['settings__custom_options__overflowSides_fade_edges_color']) ){
					$fade_style .= ' fade-edges-'.$slick_custom['settings__custom_options__overflowSides_fade_edges_color'];
				}

				$fade_attrs = '';
				if( !empty($slick_custom['settings__custom_options__overflowSides_fade_edges_plus_size']) ){
					$fade_attrs .= ' data-plus-size="'. $slick_custom['settings__custom_options__overflowSides_fade_edges_plus_size'] .'" ';
				}

				$slick_before = '<div '.$fade_attrs.' class="position-relative fade-edges-wrapper '.$fade_style.'">';
				$slick_before .= '<i class="fade-edge fade-edge-left"></i>';
				$slick_before .= '<i class="fade-edge fade-edge-right"></i>';
				$slick_after .= '</div>';
			}

	}

	$slick_class .= ' '.$slick_colors_class; 
	/* 
		settings__heights
		Settigns for responsive slider heights
	*/
		
	$breakpoint_height = WPBC_get_slick_heights($settings); 
	/*

		Affix offset
		If enabled, will disable the calculation to rest the height of the #main-navbar element to the slider height used.
		This will prevent to overflow slider height on viewport if using as first element on builder
		and navbar is using "affix-simulate".

		Good for page header component

	*/

	$disable_affix_offset = '';
	$affix_offset = true;
	if($affix_offset){
		$disable_affix_offset = 'data-disable-affix-offset="true"';
	}  

	$overlay = WPBC_get_flex_layout_field('overlay');
	$overlay_class = WPBC_get_flex_layout_field('overlay_class');
	$overlay_content = WPBC_get_flex_layout_field('overlay_content');

	if(!empty($overlay) && !empty($overlay_content)){
		$slick_before = '<div class="ui_layout_slick-overlay position-relative">'.$slick_before; 
		$overlay_content = '<div class="ui_layout_slick-overlay_content '.$overlay_class.'">'.$overlay_content.'</div>';
		$slick_after = $slick_after.$overlay_content.'</div>';
	}

	if(!empty($content)){
?>

<?php echo $slick_before; ?>

<div class="<?php echo $slick_class; ?>" data-slick='<?php echo $slick; ?>' data-breakpoint-height='<?php echo $breakpoint_height; ?>' <?php echo $disable_affix_offset; ?>>

	<?php echo $slick_content_before; ?>

	<?php foreach($content as $key=>$value){ ?>

		<?php 
		
		/* Insert more data in the $value, that will be passed as $args on template 
				In this case i will pass the embed by used if and ONLY if it´s not in use the Responsive Heights option.
		*/
		if(empty($settings['settings__use_heights'])){
			$value['settings__embed'] = $settings['settings__embed'];
		}

		$type = $value['content__item_type']; 

		if ( ! current_user_can( 'manage_options' ) ) {
		  echo '<!-- item_type: '.$type.' -->';
		}

		$value['content__item_content'] = apply_filters('wpbc/filter/ui_layout_slick/content__item_content', $value['content__item_content'], $type);

		WPBC_get_template_part('builder/parts/slick/item-'.$type, $value );
		?>

	<?php } ?>

	<?php echo $slick_content_after; ?>

</div>

<?php echo $slick_after; ?> 

<?php } ?>

<?php WPBC_flex_layout_end(); ?>