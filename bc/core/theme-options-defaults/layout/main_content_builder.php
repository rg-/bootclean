<?php

$main_content_builder = array();


$main_content_builder[] = array(
	'name' => __( 'Main Content Builder', 'bootclean' ),
	'type' => 'sub-heading', 
);

$layout_defaults = WPBC_layout_struture__defaults();
$main_container = $layout_defaults['main_container']; 

function _get_info(){

	$layout_defaults = WPBC_layout_struture__defaults();
	$main_container = $layout_defaults['main_container']; 
	$out = '';
	foreach ($main_container as $key => $value) { 
		$out .= $key . '<br>'; 
	}

	$locations = WPBC_get_layout_locations();  
	foreach ($locations as $k=>$v ) {
		//$out .= ' - '. $k . ' - ' .$v . '<br>';
	}

	return $out;
}
$test = _get_info();

/*
$main_content_builder[] = array(
	'id' => 'custom_layout__info',
	'desc' => $test,
	'type' => 'info'
);
*/

/* Custom layout locations here */

function WPBC_get_layout_locations_for_options(){
	$layout_defaults = WPBC_layout_struture__defaults();
	$main_container = $layout_defaults['main_container'];
	$test_array = array();

	foreach ($main_container as $key => $value) { 
		if($key!='defaults'){ 
			//$icon = WPBC_get_option('custom_layout_preview__'.$key);
			$img_path = get_template_directory_uri();
			$icon = $img_path.'/template-parts/layout/structure/'.$key.'.png';
			$test_array[$key] = $icon;
		}
	}
	return $test_array;
}
$layout_locations_for_options = WPBC_get_layout_locations_for_options();

$img_path = get_template_directory_uri();
$layout_locations_container_for_options = array(
	'none' => $img_path.'/bc/core/assets/images/layout_none.png',
	'fixed'=> $img_path.'/bc/core/assets/images/layout_fixed.png',
	'fixed-left'=> $img_path.'/bc/core/assets/images/layout_fixed-left.png',
	'fixed-right'=> $img_path.'/bc/core/assets/images/layout_fixed-right.png',
	'fluid'=> $img_path.'/bc/core/assets/images/layout_fluid.png',
); 


$main_content_builder[] = array(
	'id' => 'custom_layout__group-custom_locations',
	'type' => 'group-start',
	'name' => __('Custom Template Layout Locations', 'bootclean'),
	'desc' => __('Here you can change the layout used for each template, that is posts, pages, archives, when home, when blog, and so on. Also child themes can add more locations and more layout templates using filters.', 'bootclean'),
	'no_esc_html' => true,
	'label_tag' => 'h3',
	'class' => 'custom_layout_location_options',
); 

$condition_location_groups = array(
	array(
		'target' => '.group-custom_layout__group-custom_locations_options',
		'show' => '1',
	)
);

$main_content_builder[] = array(  
	'desc' => __( 'Enable for custom location settings.', 'bootclean' ),
	'id' => 'custom_layout_locations__enable',
	'std' => '0',
	'type' => 'checkbox',
	'ui' => true,
	'hide-reset'=> true,
	'condition' => $condition_location_groups,
	'width' => '100%'
);

$main_content_builder[] = array(
	'id' => 'custom_layout__group-custom_locations_options',
	'type' => 'group-start',
	'name' => __('Layout Locations', 'bootclean'),
	'no_esc_html' => true,
	'label_tag' => 'h4',
	'class' => '',
);  

$locations = WPBC_get_layout_locations(); 

foreach ($locations as $k=>$v ) {
	
	$main_content_builder[] = array(
		'id' => 'group_custom_layout__custom_locations__'.$k,
		'type' => 'group-start',
		//'name' => __('Layout Locations', 'bootclean'),
		'no_esc_html' => true,
		'label_tag' => 'h4',
		'class' => '',
	);  

	$main_content_builder[] = array(
		'name' => !empty($v['options']['label']) ? $v['options']['label'] : '', 
		'id' => 'custom_layout__custom_locations__'.$k,
		'desc' => !empty($v['options']['description']) ? $v['options']['description'] : '', 
		'std' => $v['id'],
		'type' => 'images',
		'class' => '', //mini, tiny, small
		'width' => '100%',
		'options' => $layout_locations_for_options
	);

	$std = 'none'; 
	$locations = WPBC_get_layout_locations();
	if(!empty($locations[$k]['args']['container_type'])){
		$std = $locations[$k]['args']['container_type']; 
	}

	$main_content_builder[] = array(
		'name' => __('Container Type', 'bootclean'), 
		'id' => 'custom_layout__container_type__'.$k, 
		'std' => $std,
		'type' => 'radio',
		'horizontal' => '1', //mini, tiny, small
		'width' => '100%',
		'no_esc_html' => '1',
		'img_label' => '1',
		'options' => $layout_locations_container_for_options
	);

	$main_content_builder[] = array(
		'type' => 'group-end'
	);
	
} 

$main_content_builder[] = array(
	'type' => 'group-end'
);

$main_content_builder[] = array(
	'type' => 'group-end'
);


/* Custom layout settings here */ 

function _start_group($key='', $value='', $name=''){
	$out = array(
		'id' => $name.'__group-'.$key,
		'type' => 'group-start',
		'name' => $value['name'],
		'desc' => $value['desc'],
		'no_esc_html' => true,
		'label_tag' => 'h3',
		'class' => 'custom_layout_options',
	); 
	return $out;
}

function _start_sub_group($k='', $key='', $value='', $count='', $ccount=''){
	if($value['type'] == 'row'){
		$field_info_name = __( 'Row', 'bootclean' );
		$field_name = __( 'Row class', 'bootclean' );
		$field_id = 'row'; 

	} 
	if($value['type'] == 'col'){
		$field_info_name = __( 'Column', 'bootclean' );
		$field_name = __( 'Column class', 'bootclean' );
		$field_id = 'row-'.$ccount.'-col';
	} 

	$is_main = '';
	$class = '';
	if(!empty($value['is-main'])){
		$is_main = '<span class="bg-secondary label">'.__('Main Content Area','bootclean').'</span> ';
		$class = 'option_main_content_area';
	}
	if(!empty($value['content-area']) && empty($value['is-main'])){
		$is_main = '<span class="bg-primary label">'.__('Secondary Content Area','bootclean').'</span> ';
		$class = 'option_secondary_content_area';
	}

	$out = array(
		'id' => $value['id'].'__group-'.$key.'-'.$k,
		'type' => 'group-start',
		'name' => $is_main.$field_info_name.' - '.$field_id.'-'.$count,
		'no_esc_html' => true,
		'label_tag' => 'h4',
		'class' => $class 
	); 
	return $out;
}
 

function _end_group($args, $k='', $key='', $value='', $name='', $count='', $ccount=''){

	$args[] = array(
		'type' => 'group-end',
	); 
	return $args;
}

function _inner_attrs_field($args, $k='', $key='', $value='', $name='', $count='', $ccount=''){ 

	if($value['type'] == 'container'){ 
		$field_name = __( 'Container', 'bootclean' );
		$field_id =  $k.'-'.'container';
	} 
	if($value['type'] == 'row'){ 
		$field_name = __( 'Row', 'bootclean' );
		$field_id =  $k.'-'.'row-'.$count;  
	} 
	if($value['type'] == 'col'){ 
		$field_name = __( 'Column', 'bootclean' );
		$field_id = $k.'-'.'row-'.$ccount.'-col-'.$count;
	}  

	$c_id = $name.'__'.$field_id;
	// custom_layout __ container_row_col _class - area-1

	$args[] = array(
		'name' => $field_name.' ID', 
		'id' => $c_id.'-id',
		'std' => $value['id'],
		'width' => '20%',
		'type' => 'text',
		'label_tag' => 'h5',
		'readonly' => true
	);
	$args[] = array(
		'name' => $field_name.' Class',  
		'id' => $c_id.'-class',
		'std' => $value['class'],
		'width' => '20%',
		'type' => 'text',
		'label_tag' => 'h5',
	);
	$args[] = array(
		'name' => $field_name.' Attrs',  
		'id' => $c_id.'-attrs',
		'std' => $value['attrs'],
		'width' => '20%',
		'type' => 'text',
		'label_tag' => 'h5',
	);

	if(!empty($value['shortcode'])){
		$args[] = array(
			'name' => $field_name.' Content',  
			'id' => $c_id.'-shortcode',
			'std' => $value['shortcode'],
			'width' => '40%',
			'type' => 'text',
			'label_tag' => 'h5',
			'readonly' => true,
			'hide-reset' => true,
		);
	}
	if(!empty($value['content-area']['shortcode'])){
		$args[] = array(
			'name' => $field_name.' Content',  
			'id' => $c_id.'-shortcode',
			'std' => $value['content-area']['shortcode'],
			'width' => '40%',
			'type' => 'text',
			'label_tag' => 'h5',
			'readonly' => true,
			'hide-reset' => true,
		);
	}
	
	
	return $args;
}


$main_content_builder[] = array(
	'id' => 'custom_layout__group-custom_settings',
	'desc' => __('Here you can change settings for each layout, that is id, class, custom attributes, so on. Child themes can filter anything too from functions. ', 'bootclean'),
	'type' => 'group-start',
	'name' => __('Custom Layout Settings', 'bootclean'),
	'no_esc_html' => true,
	'label_tag' => 'h3',
	'class' => 'custom_layout_location_options',
);  

$condition_groups = array(
	array(
		'target' => '.group-custom_layout__group-custom_settings_options',
		'show' => '1',
	),
);
$main_content_builder[] = array(  
	'desc' => __( 'Enable for custom settings.', 'bootclean' ),
	'id' => 'custom_layout__enable',
	'std' => '0',
	'type' => 'checkbox',
	'ui' => true,
	'hide-reset'=> true,
	'condition' => $condition_groups,
	'width' => '100%'
);

$main_content_builder[] = array(
	'id' => 'custom_layout__group-custom_settings_options', 
	'type' => 'group-start',
	'name' => __('Layout Settings', 'bootclean'),
	'no_esc_html' => true,
	'label_tag' => 'h4',
	'class' => 'group-custom_settings_options',
);

foreach ($main_container as $key => $value) {
	
	$options = $value['options'];
	$option_name = 'custom_layout';
	$main_content_builder[] = _start_group($key, $options, $option_name);
		
		$main_content_builder[] = array(
			'type' => 'text',
			'input_type' => 'hidden',
			'id' => $option_name.'_preview__'.$key.'',
			'name' => 'Preview',
			'width' => '20%',
			'label_tag' => 'h5',
			'html_desc'=> !empty($value['options']['icon']) ? '<img src="'.$value['options']['icon'].'" width="150"/>' : '', 
			'std' => !empty($value['options']['icon']) ? $value['options']['icon'] : '',
		);  

		$main_content_builder = _inner_attrs_field($main_content_builder, $key, $key, $value, $option_name);
		
		$content = !empty($value['content']) ? $value['content'] : array();
		$count = 0;
		$ccount = 0;
		foreach ($content as $kkey => $vvalue) {
			
			$main_content_builder[] = _start_sub_group($key, $kkey, $vvalue, $count);

			$main_content_builder = _inner_attrs_field($main_content_builder, $key, $kkey, $vvalue, $option_name, $count);


			$content = $vvalue['content'];
			$ccount = 0;
			foreach ($content as $kkkey => $vvvalue) {
				$main_content_builder[] = _start_sub_group($key, $kkkey, $vvvalue, $ccount, $count);
				$main_content_builder = _inner_attrs_field($main_content_builder, $key, $kkkey, $vvvalue, $option_name, $ccount, $count); 
				$main_content_builder = _end_group($main_content_builder, $key, $kkkey, $vvvalue, $option_name, $ccount, $count);
				$ccount ++;
			}

			$main_content_builder = _end_group($main_content_builder, $key, $kkey, $vvalue, $option_name, $count);

			if($vvalue['type'] == 'row'){  
				$field_id = $key.'-'.'row-'.$count.'-col'; 
 				$c_id = $option_name.'__'.$field_id; 
				$main_content_builder[] = array(
					'name' => 'Columns count',  
					'id' => $c_id.'-count',
					'std' => $ccount,
					'width' => '20%',
					'type' => 'text',
					'label_tag' => 'h5',
					'class' => 'hidden-option'
				);
			}  
			$count ++;
		} 

	if($value['type'] == 'container'){  
		$field_id = $key.'-'.'container-row'; 
			$c_id = $option_name.'__'.$field_id; 
		$main_content_builder[] = array(
			'name' => 'Row count',  
			'id' => $c_id.'-count',
			'std' => ($count),
			'width' => '20%',
			'type' => 'text',
			'label_tag' => 'h5',
			'class' => 'hidden-option'
		);
	}  
	$main_content_builder = _end_group($main_content_builder, $key, $key, $value, $option_name, $count, $ccount);

}

$main_content_builder[] = array( 
	'type' => 'group-end', 
);

$main_content_builder[] = array( 
	'type' => 'group-end', 
);

$main_content_builder[] = array( 
	'type' => 'sub-heading-end', 
);