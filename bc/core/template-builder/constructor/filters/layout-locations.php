<?php

add_filter('wpbc/filter/layout/locations', function($locations){ 
	
	$locations = array(

		'defaults' => array(
			'id' => 'a1',
			'options' => array(
				'label' => 'Defaults',
				'description' => 'Defaults used if none of the rest conditions applys.'
			),
			'args' => array(
				'container_type' => 'fixed'
			)
		),

		'_template_builder' => array(
			'id' => 'a1',
			'options' => array(
				'label' => 'Template Builder',
				'description' => 'Layout for Tempate Builder post template.'
			),
			'args' => array(
				'container_type' => 'none'
			)
		),

		'home' => array(
			'id' => 'a2-ml',
			'options' => array(
				'label' => 'Home',
				'description' => 'Layout for Homepage (Settings -> Reading -> Homepage)'
			),
			'args' => array(
				'container_type' => 'fixed'
			)
		),

		'blog' => array(
			'id' => 'a2-ml',
			'options' => array(
				'label' => 'Blog',
				'description' => 'When page is page for post (Settings -> Reading -> Posts page)'
			),
			'args' => array(
				'container_type' => 'fixed'
			)
		),

		'home-blog' => array(
			'id' => 'a2-ml',
			'options' => array(
				'label' => 'Home Blog',
				'description' => 'When page for post is also home page (Settings -> Reading -> Defaults)'
			),
			'args' => array(
				'container_type' => 'fixed'
			)
		),

		'post' => array(
			'id' => 'a2-ml',
			'options' => array(
				'label' => 'Post',
				'description' => 'For single Post post type.'
			),
			'args' => array(
				'container_type' => 'fixed'
			)
		),

		'page' => array(
			'id' => 'a2-ml',
			'options' => array(
				'label' => 'Page',
				'description' => 'For single Page post type.'
			),
			'args' => array(
				'container_type' => 'fixed'
			)
		),

		'single' => array(
			'id' => 'a2-ml',
			'options' => array(
				'label' => 'Single',
				'description' => 'For single posts.'
			),
			'args' => array(
				'container_type' => 'fixed'
			)
		),

		'archive' => array(
			'id' => 'a2-ml',
			'options' => array(
				'label' => 'Archive',
				'description' => 'For Archive pages.'
			),
			'args' => array(
				'container_type' => 'fixed'
			)
		),

		'category' => array(
			'id' => 'a2-ml',
			'options' => array(
				'label' => 'Category',
				'description' => 'For Category pages.'
			),
			'args' => array(
				'container_type' => 'fixed'
			)
		),

		'tag' => array(
			'id' => 'a2-ml',
			'options' => array(
				'label' => 'Tax',
				'description' => 'For Tax pages.'
			),
			'args' => array(
				'container_type' => 'fixed'
			)
		),

		'tax' => array(
			'id' => 'a2-ml',
			'options' => array(
				'label' => 'Tag',
				'description' => 'For Tag pages.'
			),
			'args' => array(
				'container_type' => 'fixed'
			)
		),

		'404' => array(
			'id' => 'a2-ml',
			'options' => array(
				'label' => '404',
				'description' => 'For 404 pages.'
			),
			'args' => array(
				'container_type' => 'fixed'
			)
		),

		'search' => array(
			'id' => 'a2-ml',
			'options' => array(
				'label' => 'Search',
				'description' => 'For Search pages.'
			),
			'args' => array(
				'container_type' => 'fixed'
			)
		),

	);
	
	return $locations;  
	
}, 10,1 );