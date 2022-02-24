<?php

/*
 *
 *	FRONT END for this settings
 *  see core/template-tags/wpbc_layouts/defaults.php
*/


add_filter('wpbc/filter/theme_settings/fields/header', 'wpbc_theme_settings__header__main_navbar_', 10, 1); 
 
function wpbc_theme_settings__header__main_navbar_($fields){ 

	$base_name = 'wpbc_theme_settings__';

	$fields[] = WPBC_acf_make_true_false_field(
			array( 
				'name' => 'header_main_navbar__use',
				'label' => _x('Visble','bootclean'), 
				'default_value' => 1,
				'width' => '15'
			)
		); 

	$fields[] = WPBC_acf_make_radio_field(
		array( 
			'name' => 'header_main_navbar_type',
			'label' => _x('Header Type','bootclean'), 
			'default_value' => 'default',
			'choices' => array (
				
				'default' => 'Default',
				'template' => 'Template',
				'template-part' => 'Template Part (php)',
				'custom' => 'Custom HTML', 

			),
			'class' => 'wpbc-radio-as-btn as-btn-danger',
			'width' => '85'
		)
	);    


	$default_fields = array(); 

	$default_fields = WPBC_acf_build_navbar_group($default_fields, 'header_main_navbar_default_'); 
	
	$default_fields = apply_filters('wpbc/filter/theme_settings/header_main_navbar_default', $default_fields); 

	$enable = WPBC_theme_settings_if_header_main_navbar_default();

	if(!empty($enable)){
		$fields[] =  WPBC_acf_make_group_field(
			array( 
				'name' => 'header_main_navbar_default',
				'label' => _x('Navbar Default Template Type','bootclean'),
				'sub_fields' => $default_fields,
				'class' => 'acf-group-seamless',
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_header_main_navbar_type',
							'operator' => '==',
							'value' => 'default',
						),
					), 
				),
			)
		);  
	}else{
		$fields[] = WPBC_acf_make_message_field(
			array( 
				'key' => 'field_header_main_navbar_default__message',
				'label' => _x('Main Navbar Settings','bootclean'), 
				'message' => _x('Defined on theme´s functions code.','bootclean'), 
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_header_main_navbar_type',
							'operator' => '==',
							'value' => 'default',
						),
					), 
				),
			)
		); 
	}


 	$fields[] =  WPBC_acf_make_post_object_wpbc_template(
			array( 
				'name' => 'header_main_navbar_template',
				'label' => _x('Main Navbar template','bootclean'),
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_header_main_navbar_type',
							'operator' => '==',
							'value' => 'template',
						),
					), 
				),
			)
		); 

	$fields[] =  WPBC_acf_make_select_template_part_field(
		array( 
			'name' => 'header_main_navbar_template_part',
			'label' => _x('Main Navbar template part','bootclean'),
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_header_main_navbar_type',
						'operator' => '==',
						'value' => 'template-part',
					),
				), 
			),
		)
	); 

	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'header_main_navbar_custom_html',
			'label' => _x('Main Navbar Custom Html','bootclean'),
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_header_main_navbar_type',
						'operator' => '==',
						'value' => 'custom',
					),
				), 
			),
		)
	); 

	return $fields;
}  


function WPBC_theme_settings_if_header_main_navbar_default(){

	$enable = apply_filters('wpbc/filter/theme_settigs/show/header_main_navbar_default', '__return_true');
	return $enable;

}

$enable = WPBC_theme_settings_if_header_main_navbar_default();
if( !empty($enable) ){

	// apply if addon in use... 
	add_filter('wpbc/filter/layout/main-navbar/_defaults', function($params, $post_id){

		// get defaults from theme settings if used
		$defaults = WPBC_get_theme_settings('header_main_navbar_default');
		$defaults = WPBC_clean_array_prefix( $defaults, 'header_main_navbar_default__' );
		//_print_code($defaults);
		
		// default, fixed-top, absolute-top, fixed-scroll-up
		$navbar_type = !empty($defaults['navbar_type']) ? $defaults['navbar_type'] : 'default';

		$navbar_class = '';
		$nav_attrs = '';
		$navbrand_title = get_bloginfo('name');
			
			$navbar_affix = false;
				$navbar_affix_position = '';
				$navbar_affix_target = '#main-content-wrap'; // #main-content-wrap 
				$navbar_affix_simulate = true;
				$navbar_affix_simulate_target = '#main-content';  // simulate append to element  

			if( $navbar_type == 'default' ){
				$navbar_class .= ' wpbc-navbar-default';
			}

			if( $navbar_type == 'absolute-top' ){
				$navbar_class .= ' wpbc-navbar-absolute-top position-absolute top-0 left-0 right-0 ';
				$navbar_affix = true;
				$navbar_affix_position = 'top'; // top, fixed-top 
				$navbar_affix_simulate = !empty($defaults['affix_simulate']) ? true : false;
			} 

			if( $navbar_type == 'fixed-top' ){ 
				$navbar_class .= ' wpbc-navbar-fixed-top';
				$navbar_affix = true;
				$navbar_affix_position = 'fixed-top'; // top, fixed-top 
				$navbar_affix_simulate = !empty($defaults['affix_simulate']) ? true : false;
			} 

			if( $navbar_type == 'fixed-scroll-up' ){
				$navbar_class .= ' wpbc-navbar-fixed-scroll-up';
				$navbar_affix = true;
				$navbar_affix_position = 'fixed-top'; // top, fixed-top 
				$navbar_affix_simulate = !empty($defaults['affix_simulate']) ? true : false;
				$nav_attrs .= ' data-affix-show="scroll-up" ';
			}
		
		if(!empty($defaults)){  
		  
			// navbrand

			if( !empty($defaults['navbrand_url']) ){

				$navbrand_url = $defaults['navbrand_url'];
				$width = $defaults['navbrand_width'];
				$height = $defaults['navbrand_height']; 

				if( !empty( $defaults['affix_navbrand_url'] && $navbar_affix ) ){
					$affix_navbrand_url = $defaults['affix_navbrand_url'];
					$affix_width = !empty($defaults['affix_navbrand_width']) ? $defaults['affix_navbrand_width'] : $width;
					$affix_height =!empty($defaults['affix_navbrand_height']) ? $defaults['affix_navbrand_height'] : $height;
					
					$navbrand_title = '<img class="affix-navbrand" width="'.$width.'" height="'.$height.'" src="'.$navbrand_url.'" alt=" " data-affix-addclass="d-none"/><img class="affix-navbrand d-none" width="'.$affix_width.'" height="'.$affix_height.'" src="'.$affix_navbrand_url.'" alt=" " data-affix-removeclass="d-none"/>';
				}else{
					$navbrand_title = '<img width="'.$width.'" height="'.$height.'" src="'.$navbrand_url.'" alt=" "/>';
				}
			}

			$affix_navbar_addclass = '';
			$affix_navbar_removeclass = '';
			if( !empty( $defaults['affix_nav_background'] && $navbar_affix ) ){
				$affix_navbar_addclass .= 'bg-' . $defaults['affix_nav_background'];
			}
			if( !empty( $defaults['affix_nav_color'] && $navbar_affix ) ){
				$affix_navbar_addclass .= ' text-' . $defaults['affix_nav_color'];
			}
			if( !empty( $defaults['nav_background'] && $navbar_affix ) ){
				$affix_navbar_removeclass .= 'bg-' . $defaults['nav_background'];
			}
			if( !empty( $defaults['nav_color'] && $navbar_affix ) ){
				$affix_navbar_removeclass .= ' text-' . $defaults['nav_color'];
			}
			if($navbar_type != 'absolute-top'){
				if( !empty($affix_navbar_addclass) && $affix_navbar_addclass != $affix_navbar_removeclass ){
					$nav_attrs .= ' data-affix-addclass="'. $affix_navbar_addclass .'"';
				}
				if( !empty($affix_navbar_removeclass) && $affix_navbar_addclass != $affix_navbar_removeclass ){
					$nav_attrs .= ' data-affix-removeclass="'. $affix_navbar_removeclass .'"';
				}
			}
			   

			// Menu

			if( $defaults['nav_menu'] == 'none' ){
				$params['navbar_toggler'] = ''; 
			}else{
				$params['wp_nav_menu']['theme_location'] = '';
				$params['wp_nav_menu']['menu'] = $defaults['nav_menu'];
			}

			// Colors
			
			if( !empty($defaults['nav_background']) ){
				$navbar_class .= ' bg-'.$defaults['nav_background'];
			}
			if( !empty($defaults['nav_color']) ){
				$navbar_class .= ' text-'.$defaults['nav_color'];
			}
			 
		
		}

		if( is_page() ){

			$layout_main_navbar__use = WPBC_get_field('layout_main_navbar__use', $post_id); 
			if( isset($layout_main_navbar__use) ){
				$params['visible'] = $layout_main_navbar__use;
			}
			
			$layout_main_navbar__customize = WPBC_get_field('layout_main_navbar__customize', $post_id);
			if(!empty($layout_main_navbar__customize )){
				$layout_main_navbar__type = WPBC_get_field('layout_main_navbar__type', $post_id);
				$layout_main_navbar__nav_menu = WPBC_get_field('layout_main_navbar__nav_menu', $post_id);
				if($layout_main_navbar__type == 'default'){
					if( $layout_main_navbar__nav_menu == 'none' ){
						$params['navbar_toggler'] = ''; 
					}else{
						$params['wp_nav_menu']['theme_location'] = '';
						$params['wp_nav_menu']['menu'] = $layout_main_navbar__nav_menu;
					}
				}
				if($layout_main_navbar__type == 'template'){
					$layout_main_navbar__template = WPBC_get_field('layout_main_navbar__template', $post_id);
					$params['template'] = $layout_main_navbar__template; 
				}
				if($layout_main_navbar__type == 'template_part'){
					$layout_main_navbar__template_part = WPBC_get_field('layout_main_navbar__template_part', $post_id);
					$params['template_part'] = $layout_main_navbar__template_part; 
				}
				if($layout_main_navbar__type == 'custom_html'){
					$layout_main_navbar__custom_html = WPBC_get_field('layout_main_navbar__custom_html', $post_id);
					$params['custom_html'] = $layout_main_navbar__custom_html; 
				}

				 
			} 
	 		

		}


		$params['class'] = 'navbar '.$navbar_class;
		
		$params['nav_attrs'] = ' data-test="" '. $nav_attrs; 

			$params['navbar_brand']['title'] = $navbrand_title;

			$params['affix'] = $navbar_affix; 
			$params['affix_defaults']['target'] = $navbar_affix_target;
			$params['affix_defaults']['simulate'] = $navbar_affix_simulate;
			$params['affix_defaults']['simulate_target'] = $navbar_affix_simulate_target;
			$params['affix_defaults']['position'] = $navbar_affix_position; 
			

		return $params;

	},10,2);

}