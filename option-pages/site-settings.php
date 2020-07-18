<?php

/* OPTIONS PAGE */

$args = WPBC_get_theme_settings_args();

if( function_exists('acf_add_options_page') ) {  
		acf_add_options_page($args['options_page']);   
}

/* FIELDS */

$site_settings_tabs_fields = array(
	'fields-general',
	'fields-header',
	'fields-footer',
	'fields-typography',
	'fields-custom-code',
);
if(!empty($site_settings_tabs_fields)){
	foreach ($site_settings_tabs_fields as $key) {
		$file_path = 'site_settings/'.$key.'.php';
		$file_path = apply_filters('wpbc/filter/theme_settings/file_path', $file_path, $key);
		if(!empty($file_path)) include($file_path);
	}
} 

/* GROUPS */

if( function_exists('acf_add_local_field_group') ){

	$fields = WPBC_get_theme_settings_fields(); 
	$menu_slug = $args['options_page']['menu_slug'];

	acf_add_local_field_group(array(
		'key' => 'group_wpbc_theme_settings',
		'title' => $args['options_page']['page_title'],
		'fields' => $fields,
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => $menu_slug,
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => $args['options_page']['field_group']['style'], // 'block',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

}  








/* FRONT END FILTERS AND ACTIONS DEPENDING ON SETTINGS HERE */

add_filter('wpbc/filter/layout/main-navbar/defaults', 'WPBC_settings_main_navbar_defaults', 0,1);
function WPBC_settings_main_navbar_defaults($args){
  

	// $args['class'] = '';
	// $args['nav_attrs'] = '';
	// $args['container_class'] = '';
	// $args['container_attrs'] = '';

	// $args['before_nav'] = '';
	// $args['after_nav'] = '';

	// $args['before_nav_container'] = '';
	// $args['after_nav_container'] = '';

	// $args['affix'] = true;
	// $args['affix_defaults'] = array(
	//  'position' => 'top', /* top / bottom */
	//  'simulate' => true, /* top / bottom / false ((default))  */
	//  'simulate_target' => '',
	//  'scrollify' => false, /* true / false */
	//  'breakpoint' => 'sm' /* xs / sm / md / lg / xl */
	//  );

	/*
	$args['aside_expand'] = array(
			'target' => '.aside-expand-content',
		);
	*/

	// $args['navbar_brand']['image'] = '';
	// $args['navbar_brand']['image_class'] = '';
	// $args['navbar_brand']['class'] = '';
	// $args['navbar_brand']['title'] = '';
	// $args['navbar_brand']['href'] = ''; 
	// $args['navbar_brand']['attrs'] = ''; 


	// $args['navbar_toggler'] = []; 
	/* 
	array(
			'class' => '',
			'target' => 'navbar-collapse-'.$collapse_id,
			'expanded' => false,
			'label' => __('Toggle navigation', 'bootclean'), 
			'type' => 'default', 
			'effect' => '', 
			'attrs' => '',
			'data_toggle' => 'data-toggle="collapse"',
		) 
	*/

	/*

	$args['wp_nav_menu']

		'wp_nav_menu' => array(
			'theme_location'  => 'primary',
			'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
			'container'       => 'div',
			'container_class' => 'collapse navbar-collapse flex-row-reverse',
			'container_id'    => 'navbar-collapse-'.$collapse_id,
			'menu_class'      => 'navbar-nav',
			'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
			'walker'          => new WP_Bootstrap_Navwalker(), 
			'before_menu'			=> '',
			'after_menu'			=> '',
		),

	*/

	// $args['wp_nav_menu_custom'] = false;

	// Take fields by ID, not NAME, this will ensure to get the default if not set yet.... i guess

	$logotype_text = WPBC_get_field('field_wpbc_theme_settings__general_logotype_text', 'options');
	$logotype_image = WPBC_get_field('field_wpbc_theme_settings__general_logotype_image', 'options');

	if($logotype_image || $logotype_text){

		if($logotype_image){
			$out = '<img alt="'.$logotype_text.'" src="'.$logotype_image['url'].'"/>';
		}else{
			$out = $logotype_text;
		}
		$args['navbar_brand']['title'] = $logotype_text;
		$args['navbar_brand']['image'] = $logotype_image['url'];
		$args['navbar_brand']['image_width'] = '80';
	}

	return $args;
} 

add_action('wpbc/layout/start', function(){
 
 	$settings_general = WPBC_get_theme_settings_options_by('header');
	// _print_code($settings_general);

}, 20 );