<?php
/*

	bc/components/wp-navbar.php

*/
	$row = get_row(); 
	// echo $post_id;
	$params = array();
	//print_r($row);
	
	$navbar = get_sub_field('field_layout_navbar_row_field_r__navbar', $post_id);
	$navbar_settings = get_sub_field('field_layout_navbar_row_field_r__navbar_settings', $post_id); 
	
	$params = array(

		'wp_nav_menu'=> array(
			'theme_location' => '',
			'menu' => $navbar['nav_menu']
		)

	);

	WPBC_get_component('wp-navbar', $params);
?>