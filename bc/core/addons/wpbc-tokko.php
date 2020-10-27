<?php
/*

	https://developers.tokkobroker.com/ 

	Api de prueba: 5940ea45eb7cfb55228bec0b958ea9c0be151757 

*/
$use_wpbc_tokko = apply_filters('wpbc/filter/tokko/installed', 0);

if($use_wpbc_tokko){ 
	
	function tokko_config($key=null){ 
		$config = array(
 
			'api_key' => get_option('options_wpbc_tokko_apikey', '5940ea45eb7cfb55228bec0b958ea9c0be151757'),
			
			'property_types' => array(
				1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25
			),

			'templates' => array(
				'ajax_get_properties' => admin_url( 'admin-ajax.php' ) .'?action=get_template&name=wpbc_tokko/ajax/get_properties',
			),

			'pagination' => array(
				'max_show' => 8, // max item-links to show
			),
			
		);

		$config = apply_filters('wpbc/filter/tokko/config', $config);

		if(!empty($key) && !empty($config[$key])){
			return $config[$key];
		}else{
			return $config;
		} 
	}

	add_filter('wpbc/filter/tokko/args',function($args){ 
		$args = array(
			'page_title'  => __('Tokko Broker','bootclean'),
		  'menu_title'  => __('Tokko Broker','bootclean'), 
		  'menu_slug' => 'wpbc-tokko-settings',
			'capability' => 'edit_theme_options', 
		); 
		return $args;
	},10,1);

	include_once('wpbc_tokko/api.php'); 

	function WPBC_is_tokko_enabled(){
		return apply_filters('wpbc/filter/tokko/enabled', 1);
	}
	function WPBC_use_tokko_css(){
		return apply_filters('wpbc/filter/tokko/usecss', 1);
	}
	function WPBC_use_tokko_js(){
		return apply_filters('wpbc/filter/tokko/usejs', 1);
	}

	add_filter('wpbc/filter/dashboard/actived_addons',function($addon){

		$addon[] = array(
			'name' => 'wpbc_tokko',
			'title' => __('WPBC Tokko Broker','bootclean'),
			'url' => menu_page_url('wpbc-tokko-settings', false),
			'has_option_page' => true,
		);

		return $addon;
	},10,1);
 
	include('wpbc_tokko/functions.php');
	include('wpbc_tokko/option_page.php');
	include('wpbc_tokko/enqueue.php');
	include('wpbc_tokko/filters.php');
	include('wpbc_tokko/layout.php'); 
	include('wpbc_tokko/shortcodes.php'); 
	include('wpbc_tokko/builder.php'); 

}