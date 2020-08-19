<?php

$custom_login_enable = apply_filters('wpbc/filter/custom_login/enable',0);
$custom_login_options_page_enable = apply_filters('wpbc/filter/custom_login/options_page/enable',0);
if(!empty($custom_login_enable)){

	add_filter('wpbc/filter/custom_login/args',function($args){ 
		$args = array(
			'page_title'  => __('Custom Login','bootclean'),
		  'menu_title'  => WPBC_get_svg_icon('login','#ffffff').__('Custom Login','bootclean'), 
		  'menu_slug' => 'wpbc-custom-login-settings',
			'capability' => 'edit_theme_options',
		); 
		return $args;
	},10,1);

	add_filter('wpbc/filter/dashboard/actived_addons',function($addon){

		$addon[] = array(
			'name' => 'custom_login',
			'title' => __('Custom Login','bootclean'),
			'url' => menu_page_url('wpbc-custom-login-settings',false),
			'has_option_page' => true,
		);

		return $addon;
	},10,1);

	include('wpbc_custom_login/init.php'); 

	if($custom_login_options_page_enable){
		include('wpbc_custom_login/options_page.php');  
	}

}