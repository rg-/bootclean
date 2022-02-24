<?php

function WPBC_acf_make_respnsive_field($args,$is_registered_option=false){
	
	if(empty($args['name'])) return;

	$sub_fields = array();

	$responsive_tabs_groups = WPBC_acf_get_breakpoints();

	$reponsive_count = count($responsive_tabs_groups);

	$temp = array();
	$temp_subfields = $args['sub_fields'];

	foreach ($responsive_tabs_groups as $key => $value) {

		if($reponsive_count>1){

			$sub_fields[] = WPBC_acf_make_tab_field(array(
				'key' => $args['name'].'__tab_'.$value['key_prefix'], 
				'placement' => 'top',
				'label' => $value['label'], 
				'class' => 'wpbc-tab-small',
			));

			if( !empty($temp_subfields) ){

				foreach ($temp_subfields as $k => $v ) {
					$v['key'] = $v['key'].'_'.$value['key_prefix']; 
					$v['name'] = $v['name'].'_'.$value['key_prefix']; 
					$v['label'] = $v['label'].'_'.$value['key_prefix']; 
					$sub_fields[] = $v;
				}

			}

		}

	} 

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
			'class' => 'wpbc-tab-small',
			'id' => '',
		),
		'layout' => 'block', 
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 

	$field['sub_fields'] = $sub_fields;

	return $field;

}