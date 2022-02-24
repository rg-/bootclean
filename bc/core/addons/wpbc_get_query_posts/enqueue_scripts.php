<?php

/*

	TODO, filter path or make template_part include for child js file

*/

if( apply_filters( 'wpbc/filter/wpbc_get_query_posts/enqueue', false ) ){

	add_action( 'wp_enqueue_scripts', 'wpbc_get_query_posts__enqueue_scripts', 998 ); 
	function wpbc_get_query_posts__enqueue_scripts(){

		$js_path = get_template_directory_uri() . '/js/wpbc_get_query_posts.js';

		wp_enqueue_script(
			'wpbc-get-query-posts',
			$js_path,
			array( 'jquery' ),
			'1.0',
			true );

		/*

		wp_enqueue_script(
			'wpbc-get-query-posts',
			WPBC_GET_QUERY_POSTS_URI . '/wpbc_get_query_posts.js',
			array( 'jquery' ),
			'1.0',
			true );

		*/  
	} 

}