<?php

/* Front end function */ 

function WPBC_get_acf_call_to_action_group($field, $prefix='', $echo=true){ 

	$f = $prefix.'call_to_action_';

	$call_to_action_type = $field[$f.'type'];
	
	$out = '';

	if($call_to_action_type!='none'){
		
		if($call_to_action_type=='btn'){
			
			$type_content = $field[$f.'type_btn'];

			$label = $type_content[$f.'type_btn_label'];
			$color_class = $type_content[$f.'type_btn_color_class'];
			$style = $type_content[$f.'type_btn_style'];
			$href = $type_content[$f.'type_btn_href'];
			$page = $type_content[$f.'type_btn_page'];
			$url = $type_content[$f.'type_btn_url'];
			$target = $type_content[$f.'type_btn_target'];

			$permalink = '';
			$attrs = '';
			if($target=='blank'){
				$attrs = 'target="blank"';
			}
			$attrs = apply_filters('wpbc/filter/acf/call_to_action_group/btn/attrs', $attrs, $field);
			if($style=='outline'){
				$color_class = 'outline-'.$color_class;
			}
			$class = 'btn btn-'.$color_class.'';
			$class = apply_filters('wpbc/filter/acf/call_to_action_group/btn/class', $class, $field);
			
			if($href=='page' && !empty($page)){
				$permalink = get_permalink($page);
			}
			if($href=='url' && !empty($url)){
				$permalink = $url;
			}
			if(!empty($permalink) && !empty($label)){ 
			$out = '<a href="'.$permalink.'" class="btn-call-to-action '.$class.'" '.$attrs.'>'.$label.'</a>';
			}
		}
		if($call_to_action_type=='html'){ 
			$type_content = $field[$f.'type_html'];
			$out = $type_content[$f.'type_html_html'];
		}
	} 

	if($echo){
		echo $out;
	}else{
		return $out;
	}

}



/* The field itself */

function WPBC_acf_make_call_to_action_group_field($args, $is_registered_option=false){
	if(empty($args['name'])) return;
	
	$sub_fields = array(); 

	$sub_fields_prefix = 'call_to_action';

	$sub_fields[] = WPBC_acf_make_radio_field( array(
				'name' => $sub_fields_prefix.'_type',
				'label'=>'', 
				'choices' => array (
					'none' => _x('Disabled','bootclean'), 
					'btn' => _x('Button','bootclean'), 
					'html'=> _x('HTML','bootclean'),
				),
				'default_value' => !empty($args['default_type']) ? $args['default_type'] : 'none',
				'width' => '100%',
				'class' => 'wpbc-radio-as-btn wpbc-field-no-padding wpbc-field-no-label show-radio'
			) );


		$sub_fields_type_btn = array();

		$sub_fields_type_btn[] = WPBC_acf_make_text_field( array(
				'name' => $sub_fields_prefix.'_type_btn_label',
				'label'=> _x('Button label','bootclean'), 
				'prepend'=> '',
				'width' => '40%',
				'class' => '', 
			) ); 

		$def_color = apply_filters('wpbc/filter/acf/call_to_action_group/color_choices/default_value', 'primary', $sub_fields_prefix.'_type_btn_color_class');

		$sub_fields_type_btn[] = WPBC_acf_make_radio_field( array(
				'name' => $sub_fields_prefix.'_type_btn_color_class',
				'label'=>  _x('Button Color','bootclean'),
				'choices' => WPBC_get_acf_root_colors_choices($sub_fields_prefix.'_type_btn_color_class'),
				'default_value' => $def_color,
				'width' => '35%',
				'class' => 'wpbc-radio-as-btn no-padding-radio-label'
			) );
 	

 		//$def_style = apply_filters('wpbc/filter/acf/call_to_action_group/style/default_value', 'fill', $$sub_fields_prefix.'_type_btn_style');

		$sub_fields_type_btn[] = WPBC_acf_make_radio_field( array(
				'name' => $sub_fields_prefix.'_type_btn_style',
				'label'=>  _x('Button Style','bootclean'),
				'width' => '20%', 
				'choices' => array(
					'fill' => 'fill', 'outline' => 'outline'
				),
				'default_value' => 'fill',
				'class' => 'wpbc-radio-as-btn as-btn-sm as-btn-secondary'
			) ); 

		$sub_fields_type_btn[] = WPBC_acf_make_radio_field( array(
				'name' => $sub_fields_prefix.'_type_btn_href',
				'label'=> _x('Button Link','bootclean'), 
				'choices' => array (
					'page' => 'Página', 
					'url' => 'URL', 
				),
				'default_value' => 'page',
				'width' => '20%',
				'class' => 'wpbc-radio-as-btn as-btn-sm as-btn-secondary'
			) );

		$sub_fields_type_btn[] = WPBC_acf_make_post_object_field( array(
				'name' => $sub_fields_prefix.'_type_btn_page',
				'label'=> _x('Select Page','bootclean'),  
				'post_type' => array('page'),
				'multiple' => 0,
				'width' => '55%',
				'conditional_logic' => array (
						array (
							array (
								'field' => 'field_'.$sub_fields_prefix.'_type_btn_href',
								'operator' => '==',
								'value' => 'page',
							),
						), 
					),
			) );

		$sub_fields_type_btn[] = WPBC_acf_make_text_field( array(
				'name' => $sub_fields_prefix.'_type_btn_url',
				'label'=> _x('Custom URL','bootclean'),  
				'width' => '55%',
				'conditional_logic' => array (
						array (
							array (
								'field' => 'field_'.$sub_fields_prefix.'_type_btn_href',
								'operator' => '==',
								'value' => 'url',
							),
						), 
					),
			) );

		$sub_fields_type_btn[] = WPBC_acf_make_true_false_field( array(
				'name' => $sub_fields_prefix.'_type_btn_target',
				'label'=> _x('Open new window?','bootclean'),  
				'default_value' => 0,
				'width' => '25%',  
			) );

		$sub_fields[] = WPBC_acf_make_group_field( array(
					'name' => $sub_fields_prefix.'_type_btn',
					'label'=>'',  
					'width' => '100%',  
					'sub_fields' => $sub_fields_type_btn, 
					'class' => 'wpbc-field-no-padding wpbc-field-no-label',
					'conditional_logic' => array (
							array (
								array (
									'field' => 'field_'.$sub_fields_prefix.'_type',
									'operator' => '==',
									'value' => 'btn',
								),
							), 
						),
				) );

	$sub_fields_type_html = array();

		$sub_fields_type_html[] = WPBC_acf_make_codemirror_field(array(
			'name' => $sub_fields_prefix.'_type_html_html',
			'label'=> _x('Custom HTML','bootclean'),  
			'width' => '100%',
		));

	$sub_fields[] = WPBC_acf_make_group_field( array(
				'name' => $sub_fields_prefix.'_type_html',
				'label'=>'',  
				'width' => '100%', 
				'sub_fields' => $sub_fields_type_html, 
				'class' => 'wpbc-field-no-padding wpbc-field-no-label',
				'conditional_logic' => array (
						array (
							array (
								'field' => 'field_'.$sub_fields_prefix.'_type',
								'operator' => '==',
								'value' => 'html',
							),
						), 
					),
			) ); 
 
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
			'class' => 'acf-group-call-to-action',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => $sub_fields,
	);
	$field = array_merge($defaults, $args); 
 	$field = WPBC_acf_make_fields__filter($field, $args);
	return $field;
}