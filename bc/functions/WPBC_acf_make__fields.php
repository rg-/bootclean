<?php

/*
 * WPBC_acf_make_* functions
 * Helpers for fast coding....
*/

/*

	Every time a new function created, add it here so it´s easy to find

	WPBC_acf_make_tab_field
	WPBC_acf_make_accordion_field
	WPBC_acf_make_email_field
	WPBC_acf_make_text_field
	WPBC_acf_make_post_object_wpcf7_field
	WPBC_acf_make_wysiwyg_field
	WPBC_acf_make_true_false_field
	WPBC_acf_make_textarea_field
	WPBC_acf_make_codemirror_field
	WPBC_acf_make_radio_field
	WPBC_acf_make_image_field
	WPBC_acf_make_group_navbar 
	WPBC_acf_make_subtitle_field
	WPBC_acf_make_preloaders_field
	WPBC_acf_make_repeater_field
	WPBC_acf_make_select_field
*/

/*
	
	HOW TO USE
	Base function

	function WPBC_acf_make_[FIELD_TYPE]_field($args){
		if(empty($args['key'])) return;
		$defaults = array (
		
			[FIELD_ARGUMENTS]

		);
		$field = array_merge($defaults, $args); 
		return $field;
	}


*/

function WPBC_acf_make_fields__filter($field, $args){
	if(!empty($args['class']) && !empty($args['wrapper']['class'])){
		$field['wrapper']['class'] .= ' '.$args['class'];
	}
	if(!empty($args['class']) && empty($args['wrapper']['class'])){
		$field['wrapper']['width'] = $args['width'];
	}
	return apply_filters('wpbc/filter/acf_make_fields/field', $field, $field['type']);
}


function WPBC_acf_make_tab_field($args){
	if(empty($args['key'])) return;
	$defaults = array(
		'key' => 'field_key',
		'label' => 'Tab Label',
		'name' => '',
		'type' => 'tab',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'placement' => 'left',
		'endpoint' => 0,
	);
	// Here is where i can use any param or not
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}

function WPBC_acf_make_accordion_field($args){
	if(empty($args['key'])) return;
	$defaults = array(
		'key' => 'field_key',
		'label' => 'Tab Label',
		'name' => '',
		'type' => 'accordion',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'open' => 0,
		'multi_expand' => 0,
		'endpoint' => 0,
	);
	// Here is where i can use any param or not
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}

function WPBC_acf_make_preloaders_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => '',
		'name' => $args['name'],
		'type' => 'radio',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '100%',
			'class' => 'radio-as-thumb advanced',
			'id' => '',
		),
		'default_value' => 'tail-spin',
		'choices' => array(
			'material' => '<span class="radio-as-thumb-svg">'.WPBC_get_svg_icon('loader-material').'</span>',
			'tail-spin' => '<span class="radio-as-thumb-svg">'.WPBC_get_svg_icon('loader-tail-spin').'</span>',
			'circles' => '<span class="radio-as-thumb-svg">'.WPBC_get_svg_icon('loader-circles').'</span>',
			'rings' => '<span class="radio-as-thumb-svg">'.WPBC_get_svg_icon('loader-rings').'</span>',
			'spinning-circles' => '<span class="radio-as-thumb-svg">'.WPBC_get_svg_icon('loader-spinning-circles').'</span>',
		),
		'allow_null' => 0,
		'other_choice' => 0,
		'save_other_choice' => 0, 
		'layout' => 'horizontal',
		'return_format' => 'value',
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}

function WPBC_acf_make_message_field($args){
	if(empty($args['key'])) return;
	$defaults = array (
		'key' => 'field_key',
		'label' => 'Message Field',
		'name' => '',
		'type' => 'message',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'message' => '',
		'new_lines' => 'wpautop',
		'esc_html' => 0,
	);
	$field = array_merge($defaults, $args);  
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}

function WPBC_acf_make_subtitle_field($args){
	if(empty($args['key'])) return;
	$defaults = array (
		'key' => 'field_key',
		'label' => 'Message Field',
		'name' => '',
		'type' => 'message',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => 'wpbc-subtitle',
			'id' => '',
		),
		'message' => '',
		'new_lines' => 'wpautop',
		'esc_html' => 0,
	);
	$field = array_merge($defaults, $args); 
	$field['label'] = '<h4>'.$field['label'].'</h4>';
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}

function WPBC_acf_make_email_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Email Field',
		'name' => 'email_field',
		'type' => 'email',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}

function WPBC_acf_make_text_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Text Field',
		'name' => 'text_field',
		'type' => 'text',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}


function WPBC_acf_make_select_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
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
		'choices' => array (),
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

function WPBC_acf_make_post_object_wpcf7_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array(
		'key' => 'field_'.$args['name'],
		'label' => '',
		'name' => '',
		'type' => 'post_object',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'post_type' => array(
			0 => 'wpcf7_contact_form',
		),
		'taxonomy' => array(
		),
		'allow_null' => 0,
		'multiple' => 0,
		'return_format' => 'id',
		'ui' => 1,
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}  

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
		'toolbar' => 'basic', // 'full',
		'media_upload' => 0,
		'delay' => 1,
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}

function WPBC_acf_make_true_false_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'True False',
		'name' => 'true_false_field',
		'type' => 'true_false',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => 'wpbc-true_false-ui',
			'id' => '',
		),
		'message' => '',
		'default_value' => 1,
		'ui' => 1,
		'ui_on_text' => '',
		'ui_off_text' => '',
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}


function WPBC_acf_make_textarea_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Textarea Field',
		'name' => 'textarea_field',
		'type' => 'textarea',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
		'width' => '',
		'class' => '',
		'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'maxlength' => '',
		'rows' => '3',
		'new_lines' => '',
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}
function WPBC_acf_make_codemirror_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Codemirror Field',
		'name' => 'codemirror_field',
		'type' => 'textarea',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
		'width' => '',
		'class' => ' codemirror-custom-field md',
		'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'maxlength' => '',
		'rows' => '',
		'new_lines' => '',
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}

function WPBC_acf_make_repeater_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Repeater Field',
		'name' => 'repeater_field',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => 0,
		'max' => 0,
		'layout' => 'block',
		'button_label' => '',
		'sub_fields' => array (
		),
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}

function WPBC_acf_make_radio_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Radio field',
		'name' => 'name_radio',
		'type' => 'radio',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'choices' => array (),
		'allow_null' => 0,
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => '',
		'layout' => 'horizontal',
		'return_format' => 'value',
		);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}

function WPBC_acf_make_image_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Image',
		'name' => 'wpbc_theme_settings__general_logotype_image',
		'type' => 'image',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'return_format' => 'array',
		'preview_size' => 'thumbnail',
		'library' => 'all',
		'min_width' => '',
		'min_height' => '',
		'min_size' => '',
		'max_width' => '',
		'max_height' => '',
		'max_size' => '',
		'mime_types' => '', 
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}

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
			'class' => 'acf-small-gallery',
			'id' => '',
		),
		'min' => '1',
		'max' => '5',
		'button_label' => 'Add',
		'insert' => 'append',
		'library' => 'all',
		'min_width' => '',
		'min_height' => '',
		'min_size' => '',
		'max_width' => '',
		'max_height' => '',
		'max_size' => '',
		'mime_types' => '',
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}





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

/*
 * WPBC_acf_make_* functions END
 */