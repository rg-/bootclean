<?php

function WPBC_acf_make_group_text_settings_field($args,$is_registered_option=false){

	if(empty($args['name'])) return;

	$sub_fields = array();

	$sub_fields_width = !empty($args['sub_fields_width']) ? $args['sub_fields_width'] : '20%';
	$sub_fields_class = 'wpbc-field-no-label wpbc-field-no-border';


	$root_breakpoint = BC_get_root_breakpoint();

	$responsive_tabs_groups = WPBC_acf_get_breakpoints();

	if( !empty($args['hide_responsive']) ){
		$responsive_tabs_groups = array(

			array(
				'key_prefix' => 'xs',
				'label' => 'XS'
			)

		);
	} 
	
	$reponsive_count = count($responsive_tabs_groups);

	foreach ($responsive_tabs_groups as $key => $value) {
		

		if($reponsive_count>1){

			$sub_fields[] = WPBC_acf_make_tab_field(array(
				'key' => $args['name'].'__tab_'.$value['key_prefix'],
				'placement' => 'top',
				'label' => $value['label'] . ' <small>' . $root_breakpoint[$value['key_prefix']] . '</small>', 
				'class' => '',
			));

		}
 		
 		$conditional_logic = array();
 		$key_prefix = '';
		if( $value['key_prefix'] != 'xs' ){
			$key_prefix = '_'.$value['key_prefix'];
			$sub_fields[] = WPBC_acf_make_true_false_field(array(
				'label' => _x('Enable','bootclean'),
				'name' => $args['name'].'__enable_'.$value['key_prefix'], 
				'class' => 'wpbc-true_false-ui wpbc-ui-mini ui-danger wpbc-field-no-label wpbc-section-heading-use',
				'width' => '10%',
				'default_value' => 0,
				'ui_on_text' => 'ON',
				'ui_off_text' => 'OFF',
			));
			$conditional_logic = array (
					array (
						array (
							'field' => 'field_'.$args['name'].'__enable_'.$value['key_prefix'],
							'operator' => '==',
							'value' => '1',
						),
					), 
				);
		}



		$sub_fields[] = WPBC_acf_make_select_field(
			array(
				'name' => $args['name'].'__heading'.$key_prefix,
				'label'=> __('Level','bootclean'),  
				'width' => $sub_fields_width,
				'class' => $sub_fields_class . ' wpbc-section-heading ',
				'choices' => array(
					'.display-1' => 'Display 1',
					'.display-2' => 'Display 2',
					'.display-3' => 'Display 3',
					'.display-4' => 'Display 4',
					'h1,.h1' => 'h1',
					'h2,.h2' => 'h2',
					'h3,.h3' => 'h3',
					'h4,.h4' => 'h4',
					'h5,.h5' => 'h5',
					'h6,.h6' => 'h6',
				),
				'default_value' => '.display-2',
				'conditional_logic' => $conditional_logic,
			)
		); 

		if(empty($args['hide_align'])){

			$sub_fields[] = WPBC_acf_make_radio_align_field(
				array(
					'name' => $args['name'].'__align'.$key_prefix,
					'label'=> __('Align','bootclean'),
					'class' => $sub_fields_class . ' wpbc-section-align ',
					'width' => '15%',
					'conditional_logic' => $conditional_logic,
					)
			);

		}

		$sub_fields[] = WPBC_acf_make_color_picker_field(
			array(
				'name' => $args['name'].'__color'.$key_prefix,
				'label'=> __('Color','bootclean'),
				'class' => $sub_fields_class . ' wpbc-section-color wpbc-picker-no-label wpbc-picker-absolute',
				'width' => $sub_fields_width,
				'conditional_logic' => $conditional_logic,
				)
		);

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