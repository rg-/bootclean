<?php

/*
	Main Page Header
*/
$main_page_header = array( 
	array(
		'name' => __( 'Main Page Header', 'bootclean' ),
		'type' => 'sub-heading', 
	), 
	array(  
		'desc' => __( 'Enable for custom or none.', 'bootclean' ),
		'id' => 'bc-options--layout--main-page-header',
		'std' => '0',
		'type' => 'checkbox',
		'ui' => true,
		'hide-reset'=> true,
		'condition' => array(
			array(
				'target' => '#section-bc-options--layout--main-page-header-template',
				'show' => '1'
			), 
		),
		'width' => '100%'
	),
	array(
		'name' => __( 'Select a Template', 'bootclean' ),  
		'id' => 'bc-options--layout--main-page-header-template',
		'type' => 'select',
		'std' => '0',
		'options' => $options_page_header,
		'width' => '100%',
		'condition' => array(  
			array(
				'target' => '#iframe #page-header',
				'show' => '1',
				'rule' => '0' // if same as std, could be string
			),
		)
	), 
	array( 
		'type' => 'sub-heading-end', 
	), 
); 