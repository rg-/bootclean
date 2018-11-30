<?php

/*
	Main Navbar
*/
$main_navbar = array( 
	array(
		'name' => __( 'Main Navbar', 'bootclean' ),
		'type' => 'sub-heading', 
	), 
	array( 
		//'name' => __( 'Main Navbar', 'bootclean' ),
		'desc' => __( 'Enable for custom or none.', 'bootclean' ),
		'id' => 'bc-options--layout--main-navbar',
		'std' => '0',
		'type' => 'checkbox',
		'ui' => true,
		'hide-reset'=> true,
		'condition' => array(
			array(
				'target' => '#section-bc-options--layout--main-navbar-template',
				'show' => '1'
			), 
		),
		'width' => '100%'
	),
	array(
		'name' => __( 'Select a Template', 'bootclean' ), 
		'id' => 'bc-options--layout--main-navbar-template',
		'type' => 'select',
		'std' => '0',
		'options' => $options_navbar,
		'width' => '100%',
		'condition' => array(
			array(
				'target' => '.WPBC_layout_builder_preview .header',
				'show' => '1',
				'rule' => '0' // if same as std, could be string
			),
			
			array(
				'target' => '#iframe #main-navbar',
				'show' => '1',
				'rule' => '0' // if same as std, could be string
			),
		)
	), 
	array( 
		'type' => 'sub-heading-end', 
	), 
); 