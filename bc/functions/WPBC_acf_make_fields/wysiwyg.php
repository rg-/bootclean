<?php
function WPBC_acf_make_wysiwyg_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Wysiwyg Editor Field',
		'name' => 'wysiwyg_editor_field',
		'type' => 'wysiwyg',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
		'tabs' => 'all', // 'all',
		'toolbar' => 'basic', // 'full', 'basic','wpbc-basic' 
		'media_upload' => 0,
		'delay' => 0,
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}

// SEE bc\core\addons\wpbc-tinymce.php

function WPBC_acf_make_wysiwyg_field_xxmini($args,$is_registered_option=false){
	$args['toolbar'] = 'wpbc_xxmini';
	$args['tabs'] = 'visual';
	return WPBC_acf_make_wysiwyg_field($args,$is_registered_option);
}
function WPBC_acf_make_wysiwyg_field_xxmini_html($args,$is_registered_option=false){
	$args['toolbar'] = 'wpbc_xxmini';
	$args['tabs'] = 'all';
	return WPBC_acf_make_wysiwyg_field($args,$is_registered_option);
}

function WPBC_acf_make_wysiwyg_field_xmini($args,$is_registered_option=false){
	$args['toolbar'] = 'wpbc_xmini';
	$args['tabs'] = 'visual';
	return WPBC_acf_make_wysiwyg_field($args,$is_registered_option);
}
function WPBC_acf_make_wysiwyg_field_xmini_html($args,$is_registered_option=false){
	$args['toolbar'] = 'wpbc_xmini';
	$args['tabs'] = 'all';
	return WPBC_acf_make_wysiwyg_field($args,$is_registered_option);
}
function WPBC_acf_make_wysiwyg_field_mini($args,$is_registered_option=false){
	$args['toolbar'] = 'wpbc_mini';
	$args['tabs'] = 'visual';
	return WPBC_acf_make_wysiwyg_field($args,$is_registered_option);
}
function WPBC_acf_make_wysiwyg_field_mini_html($args,$is_registered_option=false){
	$args['toolbar'] = 'wpbc_mini';
	$args['tabs'] = 'all';
	return WPBC_acf_make_wysiwyg_field($args,$is_registered_option);
}
function WPBC_acf_make_wysiwyg_field_basic($args,$is_registered_option=false){
	$args['toolbar'] = 'wpbc_basic';
	$args['tabs'] = 'visual';
	return WPBC_acf_make_wysiwyg_field($args,$is_registered_option);
}
	function WPBC_acf_make_wysiwyg_field_basic_all($args,$is_registered_option=false){
		$args['toolbar'] = 'wpbc_basic';
		$args['tabs'] = 'all';
		return WPBC_acf_make_wysiwyg_field($args,$is_registered_option);
	}
function WPBC_acf_make_wysiwyg_field_format($args,$is_registered_option=false){
	$args['toolbar'] = 'wpbc_format';
	$args['tabs'] = 'visual';
	return WPBC_acf_make_wysiwyg_field($args,$is_registered_option);
}
	function WPBC_acf_make_wysiwyg_field_format_all($args,$is_registered_option=false){
		$args['toolbar'] = 'wpbc_format';
		$args['tabs'] = 'alll';
		return WPBC_acf_make_wysiwyg_field($args,$is_registered_option);
	}