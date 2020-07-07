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

if($use_wpbc_theme_settings){
 
	include('wpbc_theme_settings/functions.php');
	include('wpbc_theme_settings/enqueue.php'); 
	include('wpbc_theme_settings/fields.php'); 
	include('wpbc_theme_settings/options_page.php');
	include('wpbc_theme_settings/groups.php'); 

}