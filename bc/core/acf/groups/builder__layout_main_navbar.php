<?php

add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__main_navbar', 10, 1);  

function WPBC_group_builder__layout__main_navbar($fields){
	$fields[] = array (
		'key' => 'field_layout_main_navbar_template__tab',
		'label' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg> Main Navbar',
		'name' => '',
		'type' => 'tab',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'placement' => 'top',
		'endpoint' => 0,
	);

	$fields[] = array (
		'key' => 'field_layout_main_navbar_template',
		'label' => 'Page Navbar Template',
		'name' => 'layout_main_navbar_template',
		'type' => 'select',
		'instructions' => '', 
		'wrapper' => array (
			'width' => '20%', 
		),
		'choices' => array (),
		'default_value' => array (),
		'allow_null' => 1, 
		'ui' => 1, 
		'return_format' => 'value', 
	); 
	return $fields;
}