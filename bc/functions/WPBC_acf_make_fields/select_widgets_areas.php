<?php
function WPBC_acf_make_select_widgets_areas_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;
	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Select Field',
		'name' => 'select_field',
		'type' => 'select',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'choices' => array (),
		'default_value' => array (),
		'allow_null' => 0,
		'multiple' => 0,
		'ui' => 0,
		'ajax' => 0,
		'return_format' => 'value',
		'placeholder' => '',

		'as_widgets_area' => 1,
	); 

	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}

function WPBC_acf_select_as_widgets_area( $field ) { 
	if( !empty( $field['as_widgets_area'] ) ){  
		$field['choices'][0] = 'None'; 
		$test = $GLOBALS['wp_registered_sidebars']; 
		foreach($test as $k=>$v){
			if($v['id'] != 'default_widget_area'){ 
				$field['choices'][$v['id']] = $v['name'];
			}
		}
	}
  return $field;	
} 
add_filter( 'acf/load_field/type=select', 'WPBC_acf_select_as_widgets_area', 10, 4 );