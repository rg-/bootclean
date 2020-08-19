<?php

function WPBC_group_template_landing_fields(){ 
	$fields = array(); 
	$fields = apply_filters('wpbc/filter/template-landing/fields',$fields);  
	return $fields; 
}

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_template_landing',
		'title' => _x('Landing Content','bootclean'),
		'fields' => WPBC_group_template_landing_fields(),
		'location' => array(
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => '_template_landing_builder.php',
				),
			),
		),
		'menu_order' => apply_filters('wpbc/filter/template-landing/group/menu_order', 5),
		'position' => 'normal',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'the_content',
		),
		'active' => true,
		'description' => '',
	));

endif;

/*
	Disable form, since this template has arbitrary content/fields, will not work.
*/
add_filter('wpbc/filter/acf/enable_acf_form',function($enable_acf_form){
	if( is_page_template('_template_landing_builder.php') ){ 
		$enable_acf_form = false;
	} 
	return $enable_acf_form;
}, 10, 1); 