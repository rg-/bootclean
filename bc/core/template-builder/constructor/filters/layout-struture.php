<?php 

add_filter('wpbc/filter/layout/struture', function($args){ 
	
	$new_args = array();
	$template = WPBC_get_template();
	$locations = WPBC_get_layout_locations();
	$layout = WPBC_get_layout_structure_build_layout(); 
	$using_settings = 'from_theme'; // Default state

	/* Theme Options PART */
		$custom_layout_locations__enable = WPBC_get_option('custom_layout_locations__enable'); 
		if(!empty($custom_layout_locations__enable)){ 
			$using_settings = 'from_theme_options_locations';
			if( is_page_template('_template_builder.php') ){ 
				$template = '_template_builder';
				$custom_layout_container_type = WPBC_get_option('custom_layout__container_type__'.$template); 
			}
		}  

	/* Default PART */
		$temp = $args['main_container'][$layout]; // save before next
		$args['main_container'] = ''; // Unset first 
		$new_args['main_container'][$layout] = $temp;  


	/* NEW v 11.00 */
	$using_theme_settings = false;
	$theme_settings_location = WPBC_get_option('layout_location__'.$template ); 
	if( isset($theme_settings_location['layout_container_type__'.$template]) && $theme_settings_location['layout_container_type__'.$template]){ 
		$using_settings = 'from_theme_settings_v11';
		$using_theme_settings = true;
		$custom_layout_container_type = $theme_settings_location['layout_container_type__'.$template];
	} 
	/* NEW v 11.00 */

	/* ACF PART */ 

		$using_page_settings = false;
		$custom_layout__enable = WPBC_get_field('custom_layout__enable');  // TODO all the subfields
		 

		if(!empty($custom_layout__enable)){ 

			$using_settings = 'from_acf_options'; 
			$using_page_settings = true;
			$custom_layout_container_type = WPBC_get_field('custom_layout__container_type'); 
		}

	/* Theme Options PART custom_layout__enable */
	$custom_layout_options__enable = WPBC_get_option('custom_layout__enable');
	if(!empty($custom_layout_options__enable)){  
		$new_args['main_container'][$layout] = WPBC_get_layout_structure__custom_main_container($temp, $layout, 'WPBC_get_option');
		$using_settings = 'from_theme_options'; 
		$custom_layout_container_type = WPBC_get_option('custom_layout__container_type__'.$template);
		 
	} 
 
 
	if( is_page_template('_template_builder.php') ){ 
		$template = '_template_builder';
	}
	if(!empty($locations[$template]['args']['container_type'])){ 
		$container_type = $locations[$template]['args']['container_type'];
	}else{
		$container_type = $locations['defaults']['args']['container_type'];
	}
	if(!empty($custom_layout_container_type)){
		$container_type = $custom_layout_container_type;
	}

	$container_type = apply_filters('wpbc/filter/layout/container_type', $container_type, $template, $using_theme_settings, $using_page_settings);
	 

	$new_args['main_container'][$layout]['using_settings'] = $using_settings;
	$new_args['main_container'][$layout]['container_type'] = $container_type;

	/* MIX THEM ALL */
	$args = wp_parse_args( $new_args, $args );
	
	return $args;

},10,1); 