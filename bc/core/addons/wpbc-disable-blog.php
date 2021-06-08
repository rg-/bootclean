<?php

$use_wpbc_disable_blog = apply_filters('wpbc/filter/disable_blog/installed', 0);

if($use_wpbc_disable_blog){

	add_filter('wpbc/filter/dashboard/actived_addons',function($addon){

		$addon[] = array(
			'name' => 'disable_blog',
			'title' => __('WPBC Disable Blog','bootclean'), 
			'has_option_page' => false,
		);

		return $addon;
	},12,1);

	// Includde class
	include('wpbc_disable_blog/WP_Disable_Posts.php'); 

}