<?php 

if( WPBC_masonry_installed() ){ 

	add_filter('wpbc/filter/dashboard/actived_addons',function($addon){

		$addon[] = array(
			'name' => 'wpbc_masonry',
			'title' => __('WPBC Masonry (jquery)','bootclean'),
			// 'url' => menu_page_url('wpbc-masonry-settings',false), // TODO
		);

		return $addon;
	},10,1);


	include('wpbc_masonry/enqueue.php');

}