<?php


function WPBC_svg_support_installed(){
	$use_wpbc_is_inview = apply_filters('wpbc/filter/svg_support/installed', 0);
	return $use_wpbc_is_inview;
}

if( WPBC_svg_support_installed() ){ 

	add_filter('wpbc/filter/dashboard/actived_addons',function($addon){

		$addon[] = array(
			'name' => 'wpbc_svg_support',
			'title' => __('SVG MIME type support','bootclean'),
			// 'url' => menu_page_url('wpbc-is-inview-settings',false), // TODO
		);

		return $addon;
	},10,1);


	include('wpbc_svg_support/init.php');

}