<?php

function WPBC_tokko_form_get_encoded_data($args=array()){

	$data = isset($_REQUEST['data']) ? $_REQUEST['data'] : '';

	$current_data = json_decode($bodytag = str_replace("\\", "", $data), true); 

	if(empty($current_data) && !empty($args['search_data'])){
		$current_data = $args['search_data'];
	}

	return $current_data;
}

function WPBC_tokko_form_build_options($select_args = array(
	'options' => null,
	'args' => array(),
)){
	$out = '';
	 if(!empty($select_args['options']) && !empty($select_args['id'])){
	 		$current_data = WPBC_tokko_form_get_encoded_data($select_args['args']);
	 		$show_all = !empty($select_args['args']['show_all']) ? $select_args['args']['show_all'] : __('Show all', 'bootclean');
	 		$id = !empty($select_args['id']) ? $select_args['id'] : '';
	 		$out .= '<select data-tokko-form="change" class="ui-tokko-'.$id.' form-control">';
	 		if(empty($select_args['args']['hide_show_all'])){
	 			$out .= '<option value="0">'.$show_all.'</option>';
	 		}
	 		foreach ($select_args['options'] as $key => $value) {
	 			$selected = '';
	 			if(!empty($current_data) && is_array($current_data[$id]) && in_array($value['id'], $current_data[$id])){
					$selected = 'selected';
				}
	 			$out .= '<option '.$selected.' value="'.$value['id'].'">'. $value['name'] .'</option>';
	 		}
	 		$out .= '</select>';
	 }
	 return $out;
}

function WPBC_tokko_get_available_operation_types(){ 

	$available_operation_types_group = get_option('options_wpbc_tokko_operation_types_available_operation_types_group', '');

	$array_data = explode(PHP_EOL, $available_operation_types_group);
	$final_data = array();
	foreach ($array_data as $data){
	    $format_data = explode(':',$data); 
	    $final_data[] = array(
	    	'id' => trim($format_data[0]),
	    	'name' => trim($format_data[1]),
	    );
	}
	return $final_data;

}

function WPBC_tokko_get_available_property_types(){
 

	$available_property_types_group = get_option('options_wpbc_tokko_property_types_available_property_types_group', '');

	$array_data = explode(PHP_EOL, $available_property_types_group);
	$final_data = array();
	foreach ($array_data as $data){
	    $format_data = explode(':',$data); 
	    $final_data[] = array(
	    	'id' => trim($format_data[0]),
	    	'name' => trim($format_data[1]),
	    );
	}
	return $final_data;

}

/* WPBC_tokko_form_* */

function WPBC_tokko_form_operation_types($args=array()){
	
	$out = '';
	$operations = WPBC_tokko_get_available_operation_types();
	if(!empty($operations)){ 

		$out .= WPBC_tokko_form_build_options(array(
			'options' => $operations,
			'args' => $args,
			'id' => 'operation_types', 
		));

	}
	echo $out; 
}  

function WPBC_tokko_form_property_types($args=array()){
 
	$out = '';
	$property_types = WPBC_tokko_get_available_property_types();
	if(!empty($property_types)){ 

		$out .= WPBC_tokko_form_build_options(array(
			'options' => $property_types,
			'args' => $args,
			'id' => 'property_types', 
		));

	}  
	echo $out; 

}

function WPBC_tokko_get_available_localizations(){

	$available_locations_group = get_option('options_wpbc_tokko_location_types_available_locations_group', '');

	$array_data = explode(PHP_EOL, $available_locations_group);
	$final_data = array();
	foreach ($array_data as $data){
	    $format_data = explode(':',$data); 
	    $final_data[] = array(
	    	'id' => trim($format_data[0]),
	    	'name' => trim($format_data[1]),
	    );
	}
	return $final_data;
}

function WPBC_tokko_form_localization($args=array()){ 
	$out = '';
	$available_locations = WPBC_tokko_get_available_localizations();
	if(!empty($available_locations)){ 
		$out .= WPBC_tokko_form_build_options(array(
			'options' => $available_locations,
			'args' => $args,
			'id' => 'current_localization_id', 
		));
	}
	echo $out; 
}

function WPBC_tokko_form_filter_amount($args=array()){ 
	$out = '';
	if(!empty($args['options'])){
		$out .= WPBC_tokko_form_build_filter_amount_options(array(
			'options' => $args['options'],
			'args' => $args,
			'id' => $args['id'], 
		));
	}
	echo $out; 
	
}

function WPBC_tokko_form_build_filter_amount_options($select_args=array()){
	$out = '';

	$has_selected = false;
	$current_data = WPBC_tokko_form_get_encoded_data($select_args['args']); 
	if(!empty($current_data['filters'])){
		foreach ($current_data['filters'] as $k => $v) {
			if(in_array($select_args['id'], $v)){ 
				$has_selected = $v[2];
			}
		}
	}
	$data = '';
	if(!empty($select_args['args']['submit_on_change'])){
			$data .= ' data-trigger="submit" ';
	} 
	$out .= '<select '.$data.' data-tokko-form="change" data-name="'.$select_args['id'].'" class="ui-tokko-'.$select_args['id'].' ui-tokko-filter form-control">';

		$show_all = !empty($select_args['args']['show_all']) ? $select_args['args']['show_all'] : __('Show all', 'bootclean'); 
 	 
 		if(empty($select_args['args']['hide_show_all'])){
 			$out .= '<option value="0">'.$show_all.'</option>';
 		}
 
		foreach ($select_args['options'] as $key => $value) {
			$selected = '';
			if($has_selected && $value['value'] == $has_selected){ 
				$selected = 'selected';
			} 
			$out .= '<option '.$selected.' data-cond="'.$value['cond'].'" value="'.$value['value'].'">'.$value['name'].'</option>';
		}
		$out .= '</select>';

	return $out; 
}


function WPBC_tokko_form_order_by($args=array()){
	$out = '';

	$data = '';
	if(!empty($args['submit_on_change'])){
			$data .= ' data-trigger="submit" ';
	} 
	$out .= '<select '.$data.' data-tokko-form="change" data-name="order_by" class="ui-tokko-order_by form-control">'; 
	$def_selected = 'price';
	if(!empty($_REQUEST['tk_order_by'])){
		$def_selected = $_REQUEST['tk_order_by'];
	} 
	$options = array(
		'price' => 'Price',
		'id' => 'ID',
		'room_amount' => 'Room amount',
		'suite_amount' => 'Suite amount',
		'bathroom_amount' => 'Bathroom amount',
	);
	foreach ($options as $key => $value) {
		$selected = '';
		if($def_selected == $key){
			$selected = 'selected';
		}
		$out .= '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
	} 
	$out .= '</select>';

	echo $out;
}
function WPBC_tokko_form_order($args=array()){
	$out = '';

	$data = '';
	if(!empty($args['submit_on_change'])){
			$data .= ' data-trigger="submit" ';
	} 
	$out .= '<select '.$data.' data-tokko-form="change" data-name="order" class="ui-tokko-order form-control">'; 
	$def_selected = 'desc';
	if(!empty($_REQUEST['tk_order'])){
		$def_selected = $_REQUEST['tk_order'];
	} 
	$options = array(
		'asc' => 'ASC',
		'desc' => 'DESC',
	);
	foreach ($options as $key => $value) {
		$selected = '';
		if($def_selected == $key){
			$selected = 'selected';
		}
		$out .= '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
	} 
	$out .= '</select>';

	echo $out;
}