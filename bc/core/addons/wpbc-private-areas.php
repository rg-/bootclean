<?php
/**
 * Add Private Areas for this child theme
 *
 * @package Bootclean
 * @subpackage Private Areas Addon
 * @since 11.0.00
 * 
 */ 

/*

	Enable private pages or content by user "suscriptor" role

*/
$use_wpbc_private_areas = apply_filters('wpbc/filter/private_areas/installed', 0); 

define( 'WPBC_PRIVATE_AREAS_ACTIVE', $use_wpbc_private_areas ); 

if($use_wpbc_private_areas){ 

	add_filter('wpbc/filter/private_area/args',function($args){ 
		$args = array(
			'page_title'  => __('Private Areas','bootclean'),
		  'menu_title'  => WPBC_get_svg_icon('lock','#ffffff').__('Private Areas','bootclean'), 
		  'menu_slug' => 'wpbc-private-areas-settings',
			'capability' => 'edit_theme_options',
		); 
		return $args;
	},10,1);

	add_filter('wpbc/filter/dashboard/actived_addons',function($addon){

		$addon[] = array(
			'name' => 'private_areas',
			'title' => __('Private Areas','bootclean'),
			'url' => menu_page_url('wpbc-private-areas-settings',false),
		);

		return $addon;
	},10,1);

	include('wpbc_private_areas/init.php'); 

	include('wpbc_private_areas/options_page.php'); 
	
}