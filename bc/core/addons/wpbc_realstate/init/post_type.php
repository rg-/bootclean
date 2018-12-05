<?php
$property_slug = WPBC_property_get_slug();
$property_slug_rewrite = WPBC_property_get_slug_rewrite();
register_post_type( $property_slug,
	array(
		'labels' => array(
			'name' => __( 'Properties', 'bootclean' ),
			'singular_name' => __( 'Property', 'bootclean' ),
			'edit_item' => __( 'Edit property', 'bootclean' ),
			'new_item' => __( 'New property', 'bootclean' ),
			'view_item' => __( 'View property', 'bootclean' ),
		),
	'public' => true,
	'has_archive' => false,
	'hierarchical' => false,
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'query_var' => true,
	'supports' => array('title','editor','thumbnail'),
	'menu_icon' => 'dashicons-welcome-learn-more', 
	
	/**/
	'rewrite' => array(
		//'slug' => '%listing_operation%',
		'slug' => $property_slug_rewrite,
		'with_front' => false
	), 
	
	//'rewrite' => false,
	)
);