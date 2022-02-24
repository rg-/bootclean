<?php

/*

	WPBC_acf_make_group_layout_style_field

*/
function WPBC_acf_make_group_layout_style_field($args, $is_registered_option=false){  

	if(empty($args['name'])) return;
	
	$layout_name = $args['name'];

	$sub_fields = array();

		if( !empty($args['sub_fields_before']) ){
			$sub_fields = $args['sub_fields_before'];
		}

		$sub_fields[] = WPBC_acf_make_color_picker_field(array(
			'label' => '<small>'.__('Background Color','bootclean').'</small>',
			'name' => $layout_name.'_background-color',  
			'class' => 'wpbc-ui-mini',  
		));
		$sub_fields[] = WPBC_acf_make_color_picker_field(array(
			'label' => '<small>'.__('Text Color','bootclean').'</small>',
			'name' => $layout_name.'_color',  
			'class' => 'wpbc-ui-mini',  
		));

		$sub_fields[] = WPBC_acf_make_gallery_advanced_field(array(
				'label' => __('Background Image/Gallery','bootclean'),
				'name' => $layout_name.'_gallery', 
				'class' => 'acf-small-gallery wpbc-ui-mini', 
				'columns' => 3, 
			));

		$sub_fields[] = WPBC_acf_make_number_field(array(
			'label' => '<small>'.__('Autoplay Speed','bootclean').'</small>',
			'name' => $layout_name.'_gallery_autoplaySpeed', 
			'default_value' => '5000',
			'class' => 'wpbc-ui-mini',  
		));

	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Group Field',
		'name' => 'group_field',
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
		'sub_fields' => $sub_fields,
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}