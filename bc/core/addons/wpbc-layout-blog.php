<?php

/*

	wpbc_layout_blog

	Adjust layout used on Blog pages, that´s when a post_for_page option is defined
	If not, defaults will be used.	

*/

function WPBC_get_layout_posts_post_types(){
	$post_types_used = array('post');
	return apply_filters('wpbc/filter/layout_blog/post_types', $post_types_used);
}

$use_wpbc_layout_blog = apply_filters('wpbc/filter/layout_blog/installed', 0);
 
include('wpbc_layout_blog/functions.php'); 

if( $use_wpbc_layout_blog ){ 

	add_filter('wpbc/filter/masonry/installed', '__return_true',10,1);
	
	include('wpbc_layout_blog/settings.php');

	add_action('init', function(){	
		include('wpbc_layout_blog/back-end.php');
		include('wpbc_layout_blog/font-end.php'); 
	}); 
 
}