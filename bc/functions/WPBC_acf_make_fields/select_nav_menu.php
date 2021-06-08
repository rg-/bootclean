<?php

function WPBC_acf_make_select_nav_menu_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;

	$choices = array();  
	$choices[0] = 'None'; 

	$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		
		foreach( $menus as $menu ) {
		
			$choices[ $menu->term_id ] = $menu->name;
			
		}

	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Select Field',
		'name' => 'select_field',
		'type' => 'select',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'choices' => $choices,
		'default_value' => array (),
		'allow_null' => 0,
		'multiple' => 0,
		'ui' => 0,
		'ajax' => 0,
		'return_format' => 'value',
		'placeholder' => '',
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}