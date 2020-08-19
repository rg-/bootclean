<?php

function WPBC_is_inview_installed(){
	$use_wpbc_is_inview = apply_filters('wpbc/filter/is_inview/installed', 0);
	return $use_wpbc_is_inview;
}

if( WPBC_is_inview_installed() ){ 

	add_filter('wpbc/filter/dashboard/actived_addons',function($addon){

		$addon[] = array(
			'name' => 'wpbc_is_inview',
			'title' => __('WPBC IsInview (jquery)','bootclean'),
			// 'url' => menu_page_url('wpbc-is-inview-settings',false), // TODO
		);

		return $addon;
	},10,1);


	include('wpbc_is_inview/enqueue.php');

}