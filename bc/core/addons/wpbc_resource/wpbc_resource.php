<?php

/*

	wpbc_resource

*/ 

add_action('init', 'wpbc_create_post_type_resource' ); 

function wpbc_create_post_type_resource(){

	$slug = 'wpbc_resource';
	$rewrite_slug = 'wpbc_resource';

	register_post_type( $slug,
		array(
			'labels' => array(
				'name' => __( 'Resources', 'bootclean' ),
				'singular_name' => __( 'Resource', 'bootclean' ),
				'edit_item' => __( 'Edit Resource', 'bootclean' ),
				'new_item' => __( 'New Resource', 'bootclean' ),
				'view_item' => __( 'View Resource', 'bootclean' ),
			),
		'public' => true,
		'has_archive' => false,
		'hierarchical' => false,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'supports' => array('title','editor','thumbnail'),
		'menu_icon' => 'dashicons-admin-multisite',  // Icon Path
		
		/**/
		'rewrite' => array( 
			'slug' => $rewrite_slug,
			'with_front' => false
		), 
		
		//'rewrite' => false,
		)
	);


	// Template part

	add_filter('wpbc/filter/layout/locations', function($locations){ 
		
		$post_type = get_post_type();

		if( $post_type  == 'wpbc_resource' ){ 
			$locations['single']['id'] = 'a1'; 
		}

		return $locations;

	},10,1);

}