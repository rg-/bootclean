<?php


/*

	wpbc-imagesloaded

*/


function WPBC_imagesloaded_installed(){
	$use_wpbc_imagesloaded = apply_filters('wpbc/filter/imagesloaded/installed', 0);
	return $use_wpbc_imagesloaded;
}

if( WPBC_imagesloaded_installed() ){ 

	add_filter('wpbc/filter/dashboard/actived_addons',function($addon){

		$addon[] = array(
			'name' => 'wpbc_imagesloaded',
			'title' => __('WPBC Imagesloaded (jquery)','bootclean'),
			// 'url' => menu_page_url('wpbc-is-inview-settings',false), // TODO
		);

		return $addon;
	},10,1);


	include('wpbc_imagesloaded/enqueue.php');

}