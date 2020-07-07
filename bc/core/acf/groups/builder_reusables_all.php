<?php

if( function_exists('acf_add_local_field_group') ){ 
	/* 
		#Reusables All Hidden group, just internal use "cloned" fields all arround.
	*/  
	acf_add_local_field_group(array(
		'key' => 'group_reusables_all',
		'title' => '#Reusables All',
		'fields' => WPBC_acf_reusables_fields(),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 0,
		'description' => '# Reusable "anywhere" fields, all here.',
	));
	// #Reusables <<<
}