<?php
function WPBC_group_builder__layout_template_row_clone($clone = array()){  

	$clone = array(
		0 => 'key__r_tab__content',
		1 => 'key__r_wpbc_template',
		2 => 'key__r_tab__settings',
		3 => 'key__r_builder_classes_group',
		4 => 'key__r_tab__advanced',
		5 => 'key__r_wpbc__advanced_group_inview', 
	);

	return apply_filters('WPBC_group_builder__layout_template_row_clone', $clone);
}
add_filter('WPBC_acf_builder_layouts', function($layouts){

	$layouts['layout_template_row'] =  array(
		'key' => 'layout_template_row',
		'name' => 'template_row',
		'label' => 'Template Row',
		'display' => 'block',
		'sub_fields' => array(
			array(
				'key' => 'key__layout_template_row__content',
				'label' => 'Content',
				'name' => 'content',
				'type' => 'clone',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'clone' => WPBC_group_builder__layout_template_row_clone(),
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