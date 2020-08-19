<?php

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