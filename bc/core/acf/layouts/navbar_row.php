<?php


// field_r__navbar

function WPBC_acf_post_object_as_nav_menu( $field ) { 
	if( !empty( $field['as_nav_menu'] ) ){ 
		$nav_menus = wp_get_nav_menus();
		$field['choices'][0] = 'None';
		foreach($nav_menus as $menu){  
			$field['choices'][$menu->term_id] = $menu->name;  
		} 
	}
    return $field;	
} 
add_filter( 'acf/load_field/type=select', 'WPBC_acf_post_object_as_nav_menu', 10, 4 );

/*

	Adding the reusables fields

*/

function _get_field_r__navbar_sub_fields(){
	$f = array(
		  
		array(
			'key' => 'field_field_r__navbar__nav_menu',
			'label' => 'Nav Menu',
			'name' => 'nav_menu',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => 'nav_menu',
				'id' => '',
			),
			'choices' => array (),
			'default_value' => array (),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'return_format' => 'value',
			'placeholder' => '',

			'as_nav_menu' => 1 // Custom not ACF part
		) 
	); 
	
	return $f;
}

add_filter('WPBC_acf_reusables_fields', function($fields){ 

	/* 
	UNIQUE key please!! 
	*/
	$field_r__navbar_sub_fields = _get_field_r__navbar_sub_fields(); 

	$fields[] = array(
		'key' => 'field_r__navbar',
		// 'label' => 'Content', // I dont need label, it´s a tab
		'name' => 'content',
		'type' => 'group',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => $field_r__navbar_sub_fields,
	); 

	return $fields;

}, 10, 1);


/*

	Adding the flexible layout

*/
add_filter('WPBC_acf_builder_layouts', function($layouts){

	// navbar_row > row > ...

	$layouts['layout_navbar_row'] =  array(
		'key' => 'layout_navbar_row',
		'name' => 'navbar_row',
		'label' => 'Navbar',
		'display' => 'block',
		'sub_fields' => array(
			array(
				'key' => 'field_layout_navbar_row',
				'label' => 'Row',
				'name' => 'row',
				'type' => 'clone',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'clone' => array( 
					//0 => 'key__r_tab__content',
					1 => 'field_r__navbar',
					//2 => 'key__r_tab__settings',
					// 3 => 'field_r__navbar_settings',
				),
				'display' => 'seamless',
				'layout' => 'block',
				'prefix_label' => 0,
				'prefix_name' => 0,
			),
		),
		'min' => '',
		'max' => '',
	);

	return $layouts;

},10,1); 