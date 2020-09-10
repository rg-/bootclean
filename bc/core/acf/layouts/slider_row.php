<?php
function WPBC_group_builder__layout_slider_row_clone($clone = array()){  

	$clone = array(
		0 => 'key__r_tab__content',
		1 => 'group_builder__slider',
		2 => 'key__r_tab__settings',
		3 => 'key__r_builder_classes_group'
	);

	return apply_filters('WPBC_group_builder__layout_slider_row_clone', $clone);
}
add_filter('WPBC_acf_builder_layouts', function($layouts){

	$layouts['layout_slider_row'] =  array(
		'key' => 'layout_slider_row',
		'name' => 'slider_row',
		'label' => '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path fill="#fff" d="M7.77 6.76L6.23 5.48.82 12l5.41 6.52 1.54-1.28L3.42 12l4.35-5.24zM7 13h2v-2H7v2zm10-2h-2v2h2v-2zm-6 2h2v-2h-2v2zm6.77-7.52l-1.54 1.28L20.58 12l-4.35 5.24 1.54 1.28L23.18 12l-5.41-6.52z"/></svg></i>'.' Slider Row',
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
				'clone' => WPBC_group_builder__layout_slider_row_clone(),
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