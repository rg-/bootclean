<?php
/*

	https://swup.js.org/

	Ajax load between pages and css transitions (like pjax but...)

*/
$use_wpbc_swup = apply_filters('wpbc/filter/swup/installed', 0);

if($use_wpbc_swup){

	function WPBC_is_swup_enabled(){
		return apply_filters('wpbc/filter/swup/enabled', 1);
	}
	function WPBC_is_swup_option_page(){
		return apply_filters('wpbc/filter/swup/option_page', 1);
	}
	function WPBC_use_swup_css(){
		return apply_filters('wpbc/filter/swup/usecss', 1);
	}
	function WPBC_use_swup_js(){
		return apply_filters('wpbc/filter/swup/usejs', 1);
	}

	add_filter('wpbc/filter/wpbc_swup/args',function($args){ 
		$args = array(
			'page_title'  => __('Swup','bootclean'),
		  'menu_title'  => __('WPBC Swup','bootclean'), 
		  'menu_slug' => 'wpbc-swup-settings',
			'capability' => 'edit_theme_options',
		); 
		return $args;
	},10,1);

	add_filter('wpbc/filter/dashboard/actived_addons',function($addon){

		$addon[] = array(
			'name' => 'wpbc_swup',
			'title' => __('WPBC Swup','bootclean'),
			'url' => menu_page_url('wpbc-swup-settings',false),
			'has_option_page' => true,
		);

		return $addon;
	},10,1);

	include('wpbc_swup/enqueue.php');
	include('wpbc_swup/filters.php');
	include('wpbc_swup/layout.php'); 
	if(WPBC_is_swup_option_page()){
		include('wpbc_swup/options_page.php'); 
	}
}