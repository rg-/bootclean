<?php 

include('option_page/admin_scripts.php');
include('option_page/admin_functions.php');
include('option_page/admin_acf_groups.php'); 

$tokko_options_page = apply_filters('wpbc/filter/tokko/args', array());

if( function_exists('acf_add_options_page') ) { 

	if(defined('WPBC_THEME_SETTINGS_ACTIVE') && WPBC_THEME_SETTINGS_ACTIVE==1){  
		$args = WPBC_get_theme_settings_args();
		$child_page = acf_add_options_sub_page(array(

			'page_title'  => $args['options_page']['page_title'] .' > '. $tokko_options_page['page_title'],
      'menu_title'  => $tokko_options_page['menu_title'], 
      'menu_slug' => $tokko_options_page['menu_slug'],
      'parent_slug' => $args['options_page']['menu_slug'],
      'capability' => $tokko_options_page['capability'],

		)); 

		add_filter('admin_body_class',function($classes){  
			if(!empty($_GET['page'] && 'wpbc-tokko-settings' == $_GET['page'] )){ 
				$classes = "$classes wpbc_site_settings wpbc_loading"; 
			}
			return $classes;
		},10,1);

	} else {

		$args = array(
			'page_title'  => $tokko_options_page['page_title'],
      'menu_title'  => $tokko_options_page['menu_title'], 
      'menu_slug' => $tokko_options_page['menu_slug'],
			'capability' => $tokko_options_page['capability'],
			'icon_url' => 'dashicons-home',
		);
		
		acf_add_options_page($args);

	}

}  