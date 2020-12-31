<?php

/*

	Extended field, see: bc/core/acf/extended

*/

function WPBC_acf_make_gallery_advanced_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Gallery Advanced Field',
		'name' => 'gallery_advanced_field',
		'type' => 'gallery_advanced',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '', // acf-small-gallery
			'id' => '',
		),
		'min' => '',
		'max' => '',
		
		'insert' => 'append',
		'library' => 'all',
		'min_width' => '',
		'min_height' => '',
		'min_size' => '',
		'max_width' => '',
		'max_height' => '',
		'max_size' => '',
		'mime_types' => '',

		'button_label' => 'Add',
		'columns' => 4,
		'preview_size' => 'medium'
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}

function WPBC_acf_make_gallery_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Gallery Field',
		'name' => 'gallery_field',
		'type' => 'gallery',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '', // acf-small-gallery
			'id' => '',
		),
		'min' => '',
		'max' => '',
		
		'insert' => 'append',
		'library' => 'all',
		'min_width' => '',
		'min_height' => '',
		'min_size' => '',
		'max_width' => '',
		'max_height' => '',
		'max_size' => '',
		'mime_types' => '',

		'button_label' => 'Add',
		'columns' => 4,
		'preview_size' => 'medium'
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}