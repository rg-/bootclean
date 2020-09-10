<?php

function WPBC_group_builder__layout_html_row_clone($clone = array()){  

	$clone = array(
		0 => 'key__r_tab__content',
		1 => 'key__r_html_code',
		2 => 'key__r_tab__settings',
		3 => 'key__r_builder_classes_group',
	);

	return apply_filters('WPBC_group_builder__layout_html_row_clone', $clone);
}

add_filter('WPBC_acf_builder_layouts', function($layouts){

	$layouts['layout_html_row'] =  array(
		'key' => 'layout_html_row',
		'name' => 'html_row',
		'label' => '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path fill="#fff" d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/></svg></i>'.' HTML Row',
		'display' => 'block',
		'sub_fields' => array(
			array(
				'key' => 'key__layout_html_row__content',
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
				'clone' => WPBC_group_builder__layout_html_row_clone(),
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