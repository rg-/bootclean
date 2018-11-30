<?php
add_filter('WPBC_acf_builder_layouts', function($layouts){

	$layouts['layout_slider_row'] =  array(
		'key' => 'layout_slider_row',
		'name' => 'slider_row',
		'label' => 'Slider Row',
		'display' => 'block',
		'sub_fields' => array(
			array(
				'key' => 'key__layout_slider_row__content',
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
				'clone' => array(
					0 => 'key__r_tab__content',
					1 => 'group_builder__slider',
					2 => 'key__r_tab__settings',
					3 => 'key__r_builder_classes_group'
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