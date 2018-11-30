<?php

$main_footer = array(
	array(
		'name' => __( 'Main Footer', 'bootclean' ),
		'type' => 'sub-heading', 
	),
	
	array( 
		//'name' => __( 'Main Footer', 'bootclean' ),
		'desc' => __( 'Enable for custom or none.', 'bootclean' ),
		'id' => 'bc-options--layout--main-footer',
		'std' => '0',
		'type' => 'checkbox',
		'ui' => true,
		'hide-reset'=> true,
		'condition' => array(
			array(
				'target' => '#section-bc-options--layout--main-footer-template',
				'show' => '1'
			),
			array(
				'target' => '.WPBC_layout_builder_preview .footer',
				'show' => '0',
			)
		),
		'width' => '100%'
	),
	array(
		'name' => __( 'Select a Template', 'bootclean' ), 
		'desc' => __( 'Needs some Template type "footer" created.', 'bootclean' ),
		'id' => 'bc-options--layout--main-footer-template',
		'type' => 'select',
		'std' => '0',
		'options' => $options_footer,
		'width' => '100%',
		'condition' => array(
			array(
				'target' => '.WPBC_layout_builder_preview .footer',
				'show' => '1',
				'rule' => '0' // if same as std, could be string
			)
		)
	),
	
	array( 
		'type' => 'sub-heading-end', 
	),

);