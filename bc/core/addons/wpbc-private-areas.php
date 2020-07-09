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

	include('wpbc_private_areas/init.php'); 

	include('wpbc_private_areas/options_page.php'); 
	
}