<?php
/**
 * @package   Options_Framework
 * @author    Devin Price <devin@wptheming.com>
 * @license   GPL-2.0+
 * @link      http://wptheming.com
 * @copyright 2010-2014 WP Theming
 */

class Options_Framework_Interface {

	/**
	 * Generates the tabs that are used in the options menu
	 */
	static function optionsframework_tabs() {
		$counter = 0;
		$sub_counter = 0;
		$options = & Options_Framework::_optionsframework_options();
		
		$menu = '';
		$sub_ref = '';
		if($options){
			$menu .= '<div class="of-menu">';
		}
		foreach ( $options as $value ) {
			
			$sub_menu = '';
			 
			// Heading for Navigation
			if ( $value['type'] == "heading" ) {
				$counter++;
				$class = '';
				$icon_name =  ! empty( $value['icon-name'] ) ? $value['icon-name'] : '';
				$class = ! empty( $value['id'] ) ? $value['id'] : $value['name'];
				$class = preg_replace( '/[^a-zA-Z0-9._\-]/', '', strtolower($class) ) . '-tab'; 
				$menu .= '<div class="of-menu-item" id="options-group-'.  $counter . '-menu"><a id="options-group-'.  $counter . '-tab" class="nav-tab ' . $class .'" title="' . esc_attr( $value['name'] ) . '" href="' . esc_attr( '#options-group-'.  $counter ) . '">' . $icon_name . '<span class="t">' . esc_html( $value['name'] ) . '</span></a></div>'; 
				$sub_ref = 'options-group-'.  $counter . '-menu';
			}
			
			if ( $value['type'] == "sub-heading___XXX" ) { 
				$class = '';
				$icon_name =  ! empty( $value['icon-name'] ) ? $value['icon-name'] : '';
				$class = ! empty( $value['id'] ) ? $value['id'] : $value['name'];
				$class = preg_replace( '/[^a-zA-Z0-9._\-]/', '', strtolower($class) ) . '-tab';
				$sub_menu .= '<a id="options-sub-group-'.  $sub_counter . '-tab" class="nav-tab sub-nav-tab ' . $class .'" title="' . esc_attr( $value['name'] ) . '" href="' . esc_attr( '#options-sub-group-'.  $sub_counter ) . '">' . $icon_name . esc_html( $value['name'] ) . '</a>';
				
				if($sub_menu!=''){
					$s = $sub_menu;
					$sub_menu = '<div data-ref="#'.$sub_ref.'" class="of-menu-sub-menu">';
					$sub_menu .= $s;
					$sub_menu .= '</div>';
				}
				$menu .= $sub_menu;
				$sub_counter++;
			}
			
			
		}
		if($options){
			$menu .= '</div>';
		}
		return $menu;
	}

	/**
	 * Generates the options fields that are used in the form.
	 */
	 
	static function optionsFramework_filter_type($value){
		if ( ( $value['type'] != "heading" ) && ( $value['type'] != "heading-end" ) && ( $value['type'] != "info" ) && ( $value['type'] != "sub-heading" ) && ( $value['type'] != "sub-heading-end" ) && ( $value['type'] != "group-start" ) && ( $value['type'] != "group-end" ) ) {
			return true;
		}else{
			return false;
		}
	} 
	 
	static function optionsframework_fields() {

		global $allowedtags;

		$options_framework = new Options_Framework;
		$option_name = $options_framework->get_option_name();
		$settings = get_option( $option_name );
		$options = & Options_Framework::_optionsframework_options();

		$counter = 0;
		$sub_counter = 0;
		$group_counter = 0;
		$menu = '';
		$width_break = 0;
		foreach ( $options as $value ) {

			$val = '';
			$select_value = '';
			$output = '';

			// Wrap all options
			$icon_name = isset ( $value['icon-name'] ) ? $value['icon-name'] : ''; 
			 
			if ( Options_Framework_Interface::optionsFramework_filter_type( $value ) ) {

				// Keep all ids lowercase with no spaces
				$value['id'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['id']) );

				$id = 'section-' . $value['id'];

				$class = 'section';
				if ( isset( $value['type'] ) ) {
					$class .= ' section-' . $value['type'];
				}
				if ( isset( $value['class'] ) ) {
					$class .= ' ' . $value['class'];
				}
				if ( isset( $value['ui'] ) ) {
					$class .= ' of-ui';
				}
				
				$width = isset( $value['width'] ) ? $value['width'] : '100%';
				if($width!='100%'){
					$class .= ' section-column';
				} 
				
				$output .= '<div id="' . esc_attr( $id ) .'" class="' . esc_attr( $class ) . '" style="width:' . esc_attr( $width ) . ';">'."\n";
				
				$reset_button_html = '';
				if( !isset($value['hide-reset']) ){
					
					$reset_button = isset($value['reset-button']) ? $value['reset-button'] : __('Reset','bootclean'); 

					$reset_button = apply_filters('wpbc/theme-options/interface/reset-button', $reset_button);
					$reset_button_class = apply_filters('wpbc/theme-options/interface/reset-button/class', 'of-default-value');
					
					$reset_button_html = '<span class="reset_button"> <a href="#section-'.$value['id'].'" title="Reset to default, needs to Save." class="'.$reset_button_class.'" data-type="'.$value['type'].'" data-default="'.esc_attr($value['std']).'">'.$reset_button.'</a></span>';
				}

				if ( isset( $value['name'] ) ) { 
					
					$tag = !empty($value['label_tag']) ? $value['label_tag'] : 'h4';

					$output .= '<'.$tag.' class="heading">' . $icon_name . '<span class="t">' . esc_html( $value['name'] ) . '</span>'.$reset_button_html.'</'.$tag.'>' . "\n";
				}
				if ( $value['type'] != 'editor' ) {
					$output .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
				}
				else {
					$output .= '<div class="option">' . "\n" . '<div>' . "\n";
				}
			}

			// Set default value to $val
			if ( isset( $value['std'] ) ) {
				$val = $value['std'];
			}

			// If the option is already saved, override $val
			if ( Options_Framework_Interface::optionsFramework_filter_type( $value ) ) {
				if ( isset( $settings[($value['id'])]) ) {
					$val = $settings[($value['id'])];
					// Striping slashes of non-array options
					if ( !is_array($val) ) {
						$val = stripslashes( $val );
					}
				}
			}

			// If there is a description save it for labels
			$explain_value = '';
			if ( isset( $value['desc'] ) ) {
				$explain_value = $value['desc'];
			}

			// Set the placeholder if one exists
			$placeholder = '';
			if ( isset( $value['placeholder'] ) ) {
				$placeholder = ' placeholder="' . esc_attr( $value['placeholder'] ) . '"';
			}
			
			if ( has_filter( 'optionsframework_' . $value['type'] ) ) {
				$output .= apply_filters( 'optionsframework_' . $value['type'], $option_name, $value, $val );
			}
			
			//$output .= apply_filters( 'extend_options_fields__' . $value['type'], $option_name, $value, $val );
			  
			switch ( $value['type'] ) { 
				
			// Basic text input
			case 'text':

				$attrs = !empty($value['readonly']) ? ' readonly="readonly" ' : '';
				$type = !empty($value['input_type']) ? $value['input_type'] : 'text';

				$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="'.$type.'" value="' . esc_attr( $val ) . '"' . $placeholder . ' '.$attrs.' />';
				break;
			
			// Basic number input
			case 'number':
				$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="number" value="' . esc_attr( $val ) . '"' . $placeholder . ' min="0" />';
				break;

			// Password input
			case 'password':
				$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="password" value="' . esc_attr( $val ) . '" />';
				break;

			// Textarea
			case 'textarea':
				$rows = '8';

				if ( isset( $value['settings']['rows'] ) ) {
					$custom_rows = $value['settings']['rows'];
					if ( is_numeric( $custom_rows ) ) {
						$rows = $custom_rows;
					}
				}

				$val = stripslashes( $val );
				$output .= '<textarea id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" rows="' . $rows . '"' . $placeholder . '>' . esc_textarea( $val ) . '</textarea>';
				break;

			// Select Box
			case 'select':
				$data_condition = _get_data_condition($value); 
				$output .= '<select '.$data_condition.' class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '">';

				foreach ($value['options'] as $key => $option ) {
					$output .= '<option'. selected( $val, $key, false ) .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
				}
				$output .= '</select>';
				break;


			// Radio Box
			case "radio":
				$name = $option_name .'['. $value['id'] .']';
				if( !empty($value['horizontal']) ){
					$output .= '<div class="of-input-flex">';
				} 
				foreach ($value['options'] as $key => $option) {
					$id = $option_name . '-' . $value['id'] .'-'. $key;
					$options_class = !empty($value['options_class']) ? $value['options_class'] : '';
					if( empty($value['no_esc_html']) ){
						$label = esc_html( $option );
					}else{
						$label = $option;
					} 

					if( !empty($value['horizontal']) ){
						$output .= '<span class="of-input-inliner flex-item">';
					} 
					$output .= '<span class="of-input-wrapper '.$options_class.'">';
					
					$input = '<input class="of-input of-radio" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $key ) . '" '. checked( $val, $key, false) .' />';

					if( empty($value['input_label']) ){ 
						$output .= $input; 
					}else{ 
						$label = $input.'<span class="inner-label">'.$label.'</span>'; 
					} 
					$label_class = '';
					if( !empty($value['img_label']) ){ 
						$selected = '';
						if ( $val != '' && ($val == $key) ) {
							$selected = 'of-radio-label-img-selected';
						}  
						$label = '<img width="24" src="'.$label.'" class="of-radio-label-img ' . $selected .'"/> <span class="inner-label">'.esc_attr( $key ).'</span>';
						$label_class = 'of-radio-label-label';
					} 

					$output .= '<label data-value="'. esc_attr( $key ) .'" class="'.$label_class.'" for="' . esc_attr( $id ) . '">' . $label . '</label>';
					
					$output .= '</span>';
					if( !empty($value['horizontal']) ){
						$output .= '</span>';
					} 
				}
				if( !empty($value['horizontal']) ){
					$output .= '</div>';
				} 
				break;

			// Image Selectors
			case "images":
				$name = $option_name .'['. $value['id'] .']';
				foreach ( $value['options'] as $key => $option ) {
					$selected = '';
					if ( $val != '' && ($val == $key) ) {
						$selected = ' of-radio-img-selected';
					}
					$output .= '<label for="' . esc_attr( $value['id'] .'_'. $key) . '" class="of-radio-img-input-wrap" data-parent="#section-'.$value['id'].'">';
					$output .= '<input type="radio" id="' . esc_attr( $value['id'] .'_'. $key) . '" class="of-radio-img-radio" value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. checked( $val, $key, false ) .' />';
					$output .= '<div class="of-radio-img-label"><span>' . esc_html( $key ) . '</span></div>';
					$output .= '<img data-value="'. esc_attr( $key ) .'" src="' . esc_url( $option ) . '" alt="' . $option .'" class="of-radio-img-img' . $selected .'" onclick="document.getElementById(\''. esc_attr($value['id'] .'_'. $key) .'\').checked=true;" />';
					$output .= '</label>';
				}
				break;

			// Checkbox
			case "checkbox": 
				$disabled = !empty($value['disabled']) ? ' disabled="disabled" ' : '';
				$data_condition = _get_data_condition($value); 
				$output .= '<input '.$data_condition.' id="' . esc_attr( $value['id'] ) . '" class="checkbox of-checkbox" type="checkbox" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" '. checked( $val, 1, false) .' '.$disabled.' />';
				$output .= '<label class="explain" for="' . esc_attr( $value['id'] ) . '">' . wp_kses( $explain_value, $allowedtags) . '</label>';
				break;

			// Multicheck
			case "multicheck":
				foreach ($value['options'] as $key => $option) {
					$checked = '';
					$label = $option;
					$option = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($key));

					$id = $option_name . '-' . $value['id'] . '-'. $option;
					$name = $option_name . '[' . $value['id'] . '][' . $option .']';

					if ( isset($val[$option]) ) {
						$checked = checked($val[$option], 1, false);
					}

					$output .= '<input id="' . esc_attr( $id ) . '" class="checkbox of-input" type="checkbox" name="' . esc_attr( $name ) . '" ' . $checked . ' /><label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label>';
				}
				break;

			// Color picker
			case "color":
				$default_color = '';
				if ( isset($value['std']) ) {
					if ( $val !=  $value['std'] )
						$default_color = ' data-default-color="' .$value['std'] . '" ';
				}
				$output .= '<input name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '" class="of-color"  type="text" value="' . esc_attr( $val ) . '"' . $default_color .' />';

				break;

			// Uploader
			case "upload":
				$output .= Options_Framework_Media_Uploader::optionsframework_uploader( $value['id'], $val, null ); 
				break;

			// Typography
			case 'typography':

				unset( $font_size, $font_style, $font_face, $font_color );

				$typography_defaults = array(
					'size' => '',
					'face' => '',
					'style' => '',
					'color' => ''
				);

				$typography_stored = wp_parse_args( $val, $typography_defaults );

				$typography_options = array(
					'sizes' => of_recognized_font_sizes(),
					'faces' => of_recognized_font_faces(),
					'styles' => of_recognized_font_styles(),
					'color' => true
				);

				if ( isset( $value['options'] ) ) {
					$typography_options = wp_parse_args( $value['options'], $typography_options );
				}

				// Font Size
				if ( $typography_options['sizes'] ) {
					$font_size = '<select class="of-typography of-typography-size" name="' . esc_attr( $option_name . '[' . $value['id'] . '][size]' ) . '" id="' . esc_attr( $value['id'] . '_size' ) . '">';
					$sizes = $typography_options['sizes'];
					foreach ( $sizes as $i ) {
						$size = $i . 'px';
						$font_size .= '<option value="' . esc_attr( $size ) . '" ' . selected( $typography_stored['size'], $size, false ) . '>' . esc_html( $size ) . '</option>';
					}
					$font_size .= '</select>';
				}

				// Font Face
				if ( $typography_options['faces'] ) {
					$font_face = '<select class="of-typography of-typography-face" name="' . esc_attr( $option_name . '[' . $value['id'] . '][face]' ) . '" id="' . esc_attr( $value['id'] . '_face' ) . '">';
					$faces = $typography_options['faces'];
					foreach ( $faces as $key => $face ) {
						$font_face .= '<option value="' . esc_attr( $key ) . '" ' . selected( $typography_stored['face'], $key, false ) . '>' . esc_html( $face ) . '</option>';
					}
					$font_face .= '</select>';
				}

				// Font Styles
				if ( $typography_options['styles'] ) {
					$font_style = '<select class="of-typography of-typography-style" name="'.$option_name.'['.$value['id'].'][style]" id="'. $value['id'].'_style">';
					$styles = $typography_options['styles'];
					foreach ( $styles as $key => $style ) {
						$font_style .= '<option value="' . esc_attr( $key ) . '" ' . selected( $typography_stored['style'], $key, false ) . '>'. $style .'</option>';
					}
					$font_style .= '</select>';
				}

				// Font Color
				if ( $typography_options['color'] ) {
					$default_color = '';
					if ( isset($value['std']['color']) ) {
						if ( $val !=  $value['std']['color'] )
							$default_color = ' data-default-color="' .$value['std']['color'] . '" ';
					}
					$font_color = '<input name="' . esc_attr( $option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" class="of-color of-typography-color  type="text" value="' . esc_attr( $typography_stored['color'] ) . '"' . $default_color .' />';
				}

				// Allow modification/injection of typography fields
				$typography_fields = compact( 'font_size', 'font_face', 'font_style', 'font_color' );
				$typography_fields = apply_filters( 'of_typography_fields', $typography_fields, $typography_stored, $option_name, $value );
				$output .= implode( '', $typography_fields );

				break;

			// Background
			case 'background':

				$background = $val;

				// Background Color
				$default_color = '';
				if ( isset( $value['std']['color'] ) ) {
					if ( $val !=  $value['std']['color'] )
						$default_color = ' data-default-color="' .$value['std']['color'] . '" ';
				}
				$output .= '<input name="' . esc_attr( $option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" class="of-color of-background-color"  type="text" value="' . esc_attr( $background['color'] ) . '"' . $default_color .' />';

				// Background Image
				if ( !isset($background['image']) ) {
					$background['image'] = '';
				}

				$output .= Options_Framework_Media_Uploader::optionsframework_uploader( $value['id'], $background['image'], null, esc_attr( $option_name . '[' . $value['id'] . '][image]' ) );

				$class = 'of-background-properties';
				if ( '' == $background['image'] ) {
					$class .= ' hide';
				}
				$output .= '<div class="' . esc_attr( $class ) . '">';

				// Background Repeat 
				$output .= '<select class="of-background of-background-repeat" name="' . esc_attr( $option_name . '[' . $value['id'] . '][repeat]'  ) . '" id="' . esc_attr( $value['id'] . '_repeat' ) . '">';
				$repeats = of_recognized_background_repeat();

				foreach ($repeats as $key => $repeat) {
					$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['repeat'], $key, false ) . '>'. esc_html( $repeat ) . '</option>';
				}
				$output .= '</select>';

				// Background Position
				$output .= '<select class="of-background of-background-position" name="' . esc_attr( $option_name . '[' . $value['id'] . '][position]' ) . '" id="' . esc_attr( $value['id'] . '_position' ) . '">';
				$positions = of_recognized_background_position();

				foreach ($positions as $key=>$position) {
					$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['position'], $key, false ) . '>'. esc_html( $position ) . '</option>';
				}
				$output .= '</select>';

				// Background Attachment
				
				$output .= '<select class="of-background of-background-attachment" name="' . esc_attr( $option_name . '[' . $value['id'] . '][attachment]' ) . '" id="' . esc_attr( $value['id'] . '_attachment' ) . '">';
				$attachments = of_recognized_background_attachment();

				foreach ($attachments as $key => $attachment) {
					$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['attachment'], $key, false ) . '>' . esc_html( $attachment ) . '</option>';
				}
				$output .= '</select>';
				
				// Background Size
				
				$output .= '<input id="' . esc_attr( $option_name . '[' . $value['id'] . '][size]' ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . '][size]' ) . '" type="text" value="' . esc_attr( $value['std']['size'] ) . '" />';
				  
				
				$output .= '</div>';

				break;

			// Editor
			case 'editor':
				$output .= '<div class="explain">' . wp_kses( $explain_value, $allowedtags ) . '</div>'."\n";
				echo $output;
				$textarea_name = esc_attr( $option_name . '[' . $value['id'] . ']' );
				$default_editor_settings = array(
					'textarea_name' => $textarea_name,
					'media_buttons' => false,
					'tinymce' => array( 'plugins' => 'wordpress,wplink' )
				);
				$editor_settings = array();
				if ( isset( $value['settings'] ) ) {
					$editor_settings = $value['settings'];
				}
				$editor_settings = array_merge( $default_editor_settings, $editor_settings );
				wp_editor( $val, $value['id'], $editor_settings );
				$output = '';
				break;

			// Info
			case "info":
				$id = '';
				$class = 'section';
				$style = '';
				if ( isset( $value['id'] ) ) {
					$id = 'id="' . esc_attr( $value['id'] ) . '" ';
				}
				if ( isset( $value['type'] ) ) {
					$class .= ' section-' . $value['type'];
				}
				if ( isset( $value['class'] ) ) {
					$class .= ' ' . $value['class'];
				}
				if ( isset( $value['width'] ) ) {
					$class .= ' section-column';
					$style .= ' style="width:'. $value['width'] .';"';
				}

				$output .= '<div ' . $id . 'class="' . esc_attr( $class ) . '" '.$style.'>' . "\n";

				if( empty($value['label_tag']) ){
					$label_tag = 'h4';
				}else{
					$label_tag = $value['label_tag'];
				}

				if ( isset($value['name']) ) {
					$output .= '<'.$label_tag.' class="heading">' . $icon_name . '<span class="t">' . esc_html( $value['name'] ) . '</span></'.$label_tag.'>' . "\n";
				}
				if ( isset( $value['desc'] ) ) {
					$output .= $value['desc'] . "\n";
				}
				$output .= '</div>' . "\n";
				break; 
				
			// sub-heading
			case "sub-heading":
				$id = '';
				$class = 'section';
				if ( isset( $value['id'] ) ) {
					$id = 'id="' . esc_attr( $value['id'] ) . '" ';
				}else{
					$id = 'id="options-sub-group-'.$counter.'-'.$sub_counter.'"';
				}
				if ( isset( $value['type'] ) ) {
					$class .= ' section-' . $value['type'];
				}
				if ( isset( $value['class'] ) ) {
					$class .= ' ' . $value['class'];
				}

				$output .= '<div ' . $id . ' class="' . esc_attr( $class ) . '">' . "\n";
				if ( isset($value['name']) ) {
					$output .= '<h3 class="heading sub-heading">' . $icon_name . '<span class="t">' . esc_html( $value['name'] ) . '</span></h3>' . "\n";
				}
				if ( isset( $value['desc'] ) ) {
					$output .= $value['desc'] . "\n";
				}
				$sub_counter ++;
				break;  
			case "sub-heading-end": 
				$output .= '</div>'."\n"; 
				
				break;
			
			
			// Heading for Navigation
			case "heading":

				$counter++;
				if ( $counter >= 2 ) {
					if ( $group_counter >= 1 ) {
						//$output .= '</div>'."\n";
					}
					//$output .= '</div><!-- #options-group-'.$counter.' END -->'."\n";
				}
				$class = '';
				$class = ! empty( $value['id'] ) ? $value['id'] : $value['name'];
				$class = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($class) );
				$output .= '<div id="options-group-' . $counter . '" class="group ' . $class . '">'. "\n";
				$output .= '<h3 class="of-group-heading">' . $icon_name . '<span class="t">' . esc_html( $value['name'] ) . '</span></h3>' . "\n"; 
				break;

			case "heading-end":

				$output .= '</div><!-- #options-group-'.$counter.' END -->'."\n";

				break;
			
			case "group-start": 
				$class = '';
				$in_group = true;
				$name = ! empty($value['name']) ? $value['name'] : 'group-start-'.$group_counter;
				
				$class = ! empty( $value['id'] ) ? $value['id'] : ( !empty($value['name']) ? $value['name'] : $group_counter );
				$class = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($class) );
				
				$style = '';
				if ( isset( $value['width'] ) ) {
					$class .= ' section-column';
					$style .= ' style="width:'. $value['width'] .';"';
				}
				if ( isset( $value['class'] ) ) {
					$class .= ' ' . $value['class'];
				}
				$output .= '<div id="options-group-fields-' . $group_counter . '" class="group-fields group-' . $class . '" '.$style.'>' . "\n";

				if( empty($value['no_esc_html']) ){
						$label = esc_html( $value['name'] );
					}else{
						$label = !empty($value['name']) ? $value['name'] : '';
					} 

				if( empty($value['label_tag']) ){
						$label_tag = 'h4';
					}else{
						$label_tag = !empty($value['label_tag']) ? $value['label_tag'] : '';
					}

				if ( isset( $value['name'] ) )  $output .= '<'.$label_tag.' class="of-grouped-fields-heading">' . $icon_name . $label . '</'.$label_tag.'>' . "\n";
				if ( isset( $value['desc'] ) ) {
					$output .= "<div class='of-grouped-fields-desc'>".$value['desc'] ."</div>". "\n";
				}
				$output .= '<div class="group-fields-wrap">' . "\n";
				break;

			case "group-end": 
				$output .= '</div></div>'."\n";
				$group_counter++;
				$in_group = false;
				break;
			
			} // Switch END
			
			if( has_filter('optionsframework_all') ){
				$output .= apply_filters( 'optionsframework_all', $option_name, $value, $val );
			}
			
			// All but not heading info, etc.....
			if ( Options_Framework_Interface::optionsFramework_filter_type( $value ) ) {
				 
				$output .= '</div><!-- controls END -->';

				if ( ( $value['type'] != "checkbox" ) && ( $value['type'] != "editor" ) ) {
					if( isset($value['html_desc']) ){
						$output .= '<div class="explain">' . $value['html_desc'] . '</div>'."\n";
					}else{
						$output .= '<div class="explain">' . wp_kses( $explain_value, $allowedtags) . '</div>'."\n";
					}
					
				}
				$output .= '</div><!-- option END -->'."\n";
				
				
				
				
				if( BC_get_option('develope-show-option-names') ){
					$output .= '<small class="of-debug-field-id">'.$value['id'].'</small>';
				}
				
				$output .= '</div><!-- section section-# END -->'."\n";
				
				if(!$in_group){
					$width = ! empty( $value['width'] ) ? $value['width'] : '100%';
					$w_b = str_replace(array('%','em','px','rem'),'',$width);
					$width_break = number_format($width_break + $w_b);
					if($width_break>=100 || !$width_break){
						$output .= '<div class="of-section-br" style="width:100%;"></div>';
						$width_break = 0;
					}
				}
			} 

			
			echo $output;
		}

		// Outputs closing div if there tabs
		if ( Options_Framework_Interface::optionsframework_tabs() != '' ) {
			echo '<!-- Options Interface END -->';
		}
	}

}