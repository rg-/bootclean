<?php

/*

	wpbc-typography

*/

function WPBC_typography_installed(){
	$use_wpbc_icons = apply_filters('wpbc/filter/wpbc_typography/installed', 1);
	return $use_wpbc_icons;
}

if( WPBC_typography_installed() ){

	add_filter('wpbc/filter/dashboard/actived_addons',function($addon){

		$addon[] = array(
			'name' => 'wpbc_typography',
			'title' => __('WPBC Typography','bootclean'),
			// 'url' => menu_page_url('wpbc-is-inview-settings',false), // TODO
		);

		return $addon;
	},10,1);


	// Disable OLD icomoon icon set 
	add_filter('wpbc/filter/enqueue/iconmoon/uri', '__return_false');

	add_action( 'wp_enqueue_scripts', 'wpbc_typography_enqueue_scripts',0 );

	function wpbc_typography_enqueue_scripts(){

		$wpbc_typography_icons_uri = get_template_directory_uri().'/fonts/wpbc-icons/wpbc-icons.css';
		$wpbc_typography_icons_uri = apply_filters('wpbc/filter/wpbc_typography/enqueue/icons/uri',$wpbc_typography_icons_uri);

		wp_register_style( 'wpbc-icons', $wpbc_typography_icons_uri, array(), __scripts_version() ); 
		wp_enqueue_style( 'wpbc-icons' ); 

	}

}