<?php
function WPBC_acf_make_group_navbar($args,$is_registered_option=false){
	$label = $args['label'];
	$name = $args['name']; 
	$field = array (
		'key' => 'field_'.$name,
		'label' => $label,
		'name' => $name,
		'type' => 'group',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => (!empty($args['conditional_logic'])) ? $args['conditional_logic'] : 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => array (

			array (
				'key' => 'field_'.$name.'_navbar_message',
				'label' => '<h4>Navbar</h4>', 
				'type' => 'message', 
				'wrapper' => array ( 
					'class' => 'wpbc-subtitle', 
				),
			),
			array (
				'key' => 'field_'.$name.'_class',
				'label' => 'Navbar Class',
				'name' => 'class',
				'type' => 'text', 
				'default_value' => '', 
			),

			array (
				'key' => 'field_'.$name.'_nav_attrs',
				'label' => 'Navbar Attrs',
				'name' => 'nav_attrs',
				'type' => 'text', 
				'default_value' => '', 
				'placeholder' => ' ej: data-affix-removeclass="something" data-affix-addclass="something-else" '
			),


		),
	);
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field; 
}