<?php
BC_set_bootclean_filters('gutenberg', array( // $arg1 can be any group, will be merged
	
	'WPBC_gutenberg' => array( // filter/function name base ( if same group, should be unique key)
		
		'description' => 'Enable/Disable custom Gutenberg things', 
		'defaults' => '__return_true',
		'inc' => 'C:\xampp\htdocs\_www\_BC_builder_v4\_WPMU\wordpress\wp-content\themes\bootclean\bc\core\gutenberg.php',
		
		'sub_filters' => array( // sub filters/functions name bases
			'supported_types' => array(
				'description' => 'Filter post types',
				'defaults' => 'array( "post" )'
			),
			'color_palette' => array(
				'description' => 'Enable/Disable custom color palette.',
				'defaults' => '__return_true'
			),
		)
	)
	
)); 

BC_set_bootclean_filters('excerpt', array(
	
	'WPBC_excerpt' => array( // filter/function name base
		
		'description' => 'Enable/Disable custom Excerpt', 
		'defaults' => '__return_true',
		'inc' => 'C:\xampp\htdocs\_www\_BC_builder_v4\_WPMU\wordpress\wp-content\themes\bootclean\bc\core\template-tags\parts\WPBC_excerpt.php',
		
		'sub_filters' => array( // sub filters/functions name bases
			'defaults' => array(
				'description' => 'Filter defaults values',
				'defaults' => 'Array() $defaults'
			),
			'args' => array(
				'description' => 'Filter after wp_parse_args defaults',
				'defaults' => 'Array() $defaults'
			)
		
		)
	)
	
));   