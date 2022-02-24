<?php

/**
 * Add custom settings page for this child theme
 *
 * @package Bootclean
 * @subpackage Child Theme Settings
 * @since 11.0.00
 * 
 */ 

$use_wpbc_theme_settings = apply_filters('wpbc/filter/theme_settings/installed', 0);

define( 'WPBC_THEME_SETTINGS_ACTIVE', $use_wpbc_theme_settings ); 

// Leave outside since functions here can be used outside addon

include('wpbc_theme_settings/functions.php');

if($use_wpbc_theme_settings){

	add_filter('wpbc/filter/theme_settings/args',function($args){
		$args['options_page'] = array(
			'page_title' => __('Site Settings','bootclean'),
			'menu_title'  => __('Site Settings','bootclean'), 
			'menu_slug' => 'wpbc-site-settings',
			'capability' => 'edit_theme_options',
			'position' => '2.2',
			'icon_url' => get_template_directory_uri().'/images/theme/bootclean-iso-color-@2.png',
			'redirect'    => false,  

			'field_group' => array(
				'style' => 'seamless',
			),
		); 
		return $args;
	},10,1);

	
 
	

	/* Make addon be able to see over dashboard status 
	I did this so i can controll over each addon init file if it´s actived or not
	and not the reverse way on doing this on the dashboard code for each addon used.

	Maybe another idea is of course create a class and so on...
	But classes and filters are another world !!
	
	Call this after the existence of WPBC_get_theme_settings_args() so arguemns filtered above are shared like menu title.

	*/
	add_filter('wpbc/filter/dashboard/actived_addons',function($addon){

		$settings = WPBC_get_theme_settings_args('options_page');

		$addon[] = array(
			'name' => $settings['menu_slug'],
			'title' => $settings['menu_title'],
			'url' => menu_page_url('wpbc-site-settings',false),
		);

		return $addon;
	},10,1);

	include('wpbc_theme_settings/enqueue.php');

	// include('wpbc_theme_settings/options_pages/site-settings.php'); 
	WPBC_include_option_page('site-settings');

	$enable_design = apply_filters('wpbc/filter/theme_settings/enable/design',0);
	if(!empty($enable_design)) {
		include('wpbc_theme_settings/options_pages/design-settings.php');
	} 

}