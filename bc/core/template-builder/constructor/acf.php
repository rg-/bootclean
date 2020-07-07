<?php 
function WPBC_get_layout_locations_for_acf(){
		$layout_defaults = WPBC_layout_struture__defaults();
		$main_container = $layout_defaults['main_container'];
		$test_array = array(); 
		foreach ($main_container as $key => $value) {
			if($key!='defaults'){ 
				//$icon = WPBC_get_option('custom_layout_preview__'.$key);
				$img_path = get_template_directory_uri();
				$icon = $img_path.'/template-parts/layout/structure/'.$key.'.png';
				$test_array[$key] = '<img src="'.$icon.'" width="50" class=""/>';
			}
		}
		return $test_array;
	}

function WPBC_group_builder__layout__custom_layout($fields){

	$fields[] = array (
		'key' => 'field_custom_layout__tab',
		'label' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 5v14h19V5H3zm2 2h15v4H5V7zm0 10v-4h4v4H5zm6 0v-4h9v4h-9z"/></svg> Custom Layout',
		'name' => '',
		'type' => 'tab',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'placement' => 'top',
		'endpoint' => 0,
	);

	$fields[] = array (
		'key' => 'field_custom_layout__enable',
		'label' => 'Enable custom settings',
		'name' => 'custom_layout__enable',
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
		'default_value' => 0,
		'ui' => 1,
		'ui_on_text' => '',
		'ui_off_text' => '',
	);  

 	
	$custom_layout__custom_location_choices = WPBC_get_layout_locations_for_acf();  

	$img_path = get_template_directory_uri();
	// $img_path = get_stylesheet_directory_uri();
	$custom_layout__container_type_choices = array(
		'none' => '<img src="'.$img_path.'/bc/core/assets/images/layout_none.png'.'" width="24" class=""/> none',
		'fixed'=> '<img src="'.$img_path.'/bc/core/assets/images/layout_fixed.png'.'" width="24" class=""/> fixed',
		'fixed-left'=> '<img src="'.$img_path.'/bc/core/assets/images/layout_fixed-left.png'.'" width="24" class=""/> fixed-left',
		'fixed-right'=> '<img src="'.$img_path.'/bc/core/assets/images/layout_fixed-right.png'.'" width="24" class=""/> fixed-right',
		'fluid'=> '<img src="'.$img_path.'/bc/core/assets/images/layout_fluid.png'.'" width="24" class=""/> fluid',
	); 

	$fields[] = array (
		'key' => 'field_custom_layout__custom_location',
		'label' => 'Layout',
		'name' => 'custom_layout__custom_location',
		'type' => 'radio',
		'value' => NULL,
		'instructions' => 'Change Layout for this page. In some cases you will need to adjust also more than one content area depending on the layout used.',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_custom_layout__enable',
					'operator' => '==',
					'value' => '1',
				),
			), 
		),
		'wrapper' => array (
			'width' => '100%',
			'class' => 'radio-as-thumb',
			'id' => '',
		),
		'default_value' => '',
		'choices' => $custom_layout__custom_location_choices,
		'allow_null' => 0,
		'other_choice' => 0,
		'save_other_choice' => 0, 
		'layout' => 'horizontal',
		'return_format' => 'value',
	);
	$fields[] = array (
		'key' => 'field_custom_layout__container_type',
		'label' => 'Container Type',
		'name' => 'custom_layout__container_type',
		'type' => 'radio',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_custom_layout__enable',
					'operator' => '==',
					'value' => '1',
				),
			), 
		),
		'wrapper' => array (
			'width' => '100%',
			'class' => 'radio-with-thumb',
			'id' => '',
		),
		'default_value' => 'none',
		'choices' => $custom_layout__container_type_choices,
		'allow_null' => 0,
		'other_choice' => 0,
		'save_other_choice' => 0, 
		'layout' => 'horizontal',
		'return_format' => 'value',
	);

	return $fields;
}
add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__custom_layout', 40, 1);